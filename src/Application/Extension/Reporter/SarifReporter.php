<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension\Reporter;

use Bartlett\CompatInfo\Application\Collection\SniffCollectionInterface;
use Bartlett\CompatInfo\Application\DataCollector\VersionDataCollector;
use Bartlett\CompatInfo\Application\Event\AfterAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\AfterFileAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\AfterFileAnalysisInterface;
use Bartlett\CompatInfo\Application\Extension\Reporter;
use Bartlett\CompatInfo\Application\Profiler\Profile;
use Bartlett\CompatInfo\Application\Sniffs\SniffInterface;
use Bartlett\CompatInfo\Presentation\Console\Style;
use Bartlett\Sarif\Definition\ArtifactLocation;
use Bartlett\Sarif\Definition\Invocation;
use Bartlett\Sarif\Definition\Location;
use Bartlett\Sarif\Definition\Message;
use Bartlett\Sarif\Definition\MultiformatMessageString;
use Bartlett\Sarif\Definition\PhysicalLocation;
use Bartlett\Sarif\Definition\PropertyBag;
use Bartlett\Sarif\Definition\ReportingDescriptor;
use Bartlett\Sarif\Definition\Result;
use Bartlett\Sarif\Definition\Run;
use Bartlett\Sarif\Definition\Tool;
use Bartlett\Sarif\Definition\ToolComponent;
use Bartlett\Sarif\Definition\VersionControlDetails;
use Bartlett\Sarif\SarifLog;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Serializer;

use Generator;
use function array_shift;
use function explode;
use function file_put_contents;
use function get_class;
use function getcwd;
use function implode;
use function is_array;
use function key;
use function parse_url;
use function realpath;
use function rtrim;
use function sprintf;
use function str_replace;
use function str_starts_with;
use function strlen;
use function strrchr;
use function substr;
use function trim;
use const DIRECTORY_SEPARATOR;
use const JSON_PRETTY_PRINT;
use const JSON_UNESCAPED_SLASHES;
use const PHP_URL_SCHEME;

/**
 * @author Laurent Laville
 * @since Release 6.1.0
 */
final class SarifReporter extends Reporter implements
    FormatterInterface,
    AfterFileAnalysisInterface
{
    protected const NAME = 'sarif';
    /** @var Result[] */
    private array $results = [];
    private string $source;
    /** @var SniffCollectionInterface<SniffInterface> */
    private SniffCollectionInterface $sniffs;
    private string $applicationVersion;

    private const PHP_VERSIONS = [
        '50', '51', '52', '53', '54', '55', '56',
        '70', '71', '72', '73', '74',
        '80', '81', '82', '83',
    ];

    /**
     * @param SniffCollectionInterface<SniffInterface> $sniffs
     */
    public function __construct(SniffCollectionInterface $sniffs, InputInterface $input, OutputInterface $output)
    {
        $this->sniffs = $sniffs;
        parent::__construct($input, $output);
    }

    public function format(mixed $data): void
    {
        /** @var string[] $format */
        $format = $this->input->getOption('output');
        if (!$this->supportsFormatting($data, $format)) {
            return;
        }

        $data = $data->getData();
        $token = key($data);
        $data = current($data);
        $target = '/tmp/' . $token . '-compatinfo.sarif';
        $sarifLog = $this->generateReport($data);

        $normalizer = new JsonSerializableNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer([$normalizer], [$encoder]);

        $jsonEncodeOptions = (JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $jsonString = $serializer->serialize($sarifLog, 'json', ['json_encode_options' => $jsonEncodeOptions]);

        @file_put_contents($target, $jsonString);

        $output = new Style($this->input, $this->output);
        $output->note('Profile results are being formatted as SARIF to file ' . $target);
        $output->comment('Produced by ' . $this->getName());
    }

    /**
     * @inheritDoc
     */
    public function afterAnalyzeFile(AfterFileAnalysisEvent $event): void
    {
        $fileInfo = $event->getArgument('file');
        $file = $fileInfo->getRelativePathname();

        $message = new Message('', 'default');
        $message->addArguments([$file]);
        $result = new Result($message);

        $artifactLocation = new ArtifactLocation();
        $artifactLocation->setUri($this->pathToArtifactLocation($file));
        $artifactLocation->setUriBaseId('PROJECT_DIR');

        $location = new Location();
        $physicalLocation = new PhysicalLocation($artifactLocation);
        $location->setPhysicalLocation($physicalLocation);
        $result->addLocations([$location]);

        $keysAllowed = [
            'extensions',
            'namespaces',
            'classes',
            'interfaces',
            'traits',
            'methods',
            'generators',
            'functions',
            'constants',
            'directives',
            'conditions',
        ];

        if ($event->hasArgument('ast')) {
            $ast = $event->getArgument('ast');
            $collector = new VersionDataCollector($keysAllowed);
            $collector->collect($ast);

            $extra = [];
            foreach ($collector->getData() as $group => $components) {
                if ('versions' === $group) {
                    $extra[$group] = $components;
                } else {
                    foreach ($components as $id => $values) {
                        if (is_array($values) && isset($values['rule'])) {
                            $extra[$group][$id] = $values['rule'];
                        }
                    }
                }
            }

            $properties = new PropertyBag();
            foreach ($extra as $key => $values) {
                $properties->addProperty($key, $values);
            }
            $result->setProperties($properties);

            $phpMin = explode('.', $extra['versions']['php.min']);
            $result->setRuleId(sprintf('CA%1d%1d00', $phpMin[0], $phpMin[1]));
        }

        $this->results[] = $result;
    }

    /**
     * @inheritDoc
     */
    public function afterAnalysis(AfterAnalysisEvent $event): void
    {
        if ($event->hasArgument('profile') && $this->input->hasOption('output')) {
            $profile = $event->getArgument('profile');
            $token = key($profile->getData());
            $this->source = $event->getArgument('source');
            $this->applicationVersion = $event->getArgument('applicationVersion');
            $this->format(new Profile($token, $this->results));
        }
    }

    /**
     * @return Generator<string, mixed>
     */
    public function getRules(): Generator
    {
        foreach (self::PHP_VERSIONS as $phpVer) {
            yield sprintf('CA%2d00', $phpVer) => [
                'name' => substr(strrchr(get_class($this), '\\'), 1),
                'fullDescription' => 'PHP minimum requirement',
                'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-' . $phpVer,
                'messages' => [
                    'default' => "File '{0}' requires at least PHP "
                        . sprintf('%1s.%1s', $phpVer[0], $phpVer[1])
                ],
            ];
        }
    }

    /**
     * @param array<string, mixed> $definition
     */
    private function buildRulesList(string $id, array $definition): ReportingDescriptor
    {
        $baseHelpUri = 'https://llaville.github.io/php-compatinfo';

        $rule = new ReportingDescriptor($id);
        $rule->setName($definition['name']);
        if (isset($definition['fullDescription'])) {
            $rule->setFullDescription(new MultiformatMessageString($definition['fullDescription']));
        }
        $rule->setHelpUri(str_replace('%baseHelpUri%', $baseHelpUri, $definition['helpUri']));
        $messages = $definition['messages'] ?? [];
        foreach ($messages as $key => $text) {
            // Express plain text result messages as complete sentences and end each sentence with a period
            $text = rtrim($text, '.') . '.';
            $messages[$key] = new MultiformatMessageString($text);
        }
        $rule->addMessageStrings($messages);
        return $rule;
    }

    /**
     * @param Result[] $results
     */
    private function generateReport(array $results): SarifLog
    {
        $driver = new ToolComponent('PHP_CompatInfo');
        $driver->setInformationUri('https://github.com/llaville/php-compatinfo');
        if (!empty($this->applicationVersion)) {
            $driver->setVersion($this->applicationVersion);
            $driver->setSemanticVersion(explode('@', $this->applicationVersion)[0]);
        }

        $rules = [];
        foreach ($this->getRules() as $id => $definition) {
            $rules[] = $this->buildRulesList($id, $definition);
        }
        foreach ($this->sniffs as $sniff) {
            foreach ($sniff->getRules() as $id => $definition) {
                $rules[] = $this->buildRulesList($id, $definition);
            }
        }
        $driver->addRules($rules);

        $tool = new Tool($driver);

        $argv = $_SERVER['argv'];

        $run = new Run($tool);
        $workingDir = new ArtifactLocation();
        $workingDir->setUri($this->pathToUri($this->source));
        $appDir = new ArtifactLocation();
        $appDir->setUri($this->pathToUri($argv[0]));
        $originalUriBaseIds = [
            'PROJECT_DIR' => $workingDir,
            'APP_DIR' => $appDir,
        ];
        $run->addAdditionalProperties($originalUriBaseIds);
        $run->addResults($results);

        $cwd = dirname($this->source);
        $repositoryUri = $this->runProcess(['git', 'config', '--get', 'remote.origin.url'], $cwd);
        if (!empty($repositoryUri)) {
            $vcsDetails = new VersionControlDetails($repositoryUri);

            $revisionId = $this->runProcess(['git', 'rev-parse', '--short', 'HEAD'], $cwd);
            $vcsDetails->setRevisionId($revisionId);

            $branch = $this->runProcess(['git', 'rev-parse', '--abbrev-ref', 'HEAD'], $cwd);
            $vcsDetails->setBranch($branch);

            $artifactLocation = new ArtifactLocation();
            $artifactLocation->setUriBaseId('PROJECT_DIR');
            $vcsDetails->setMappedTo($artifactLocation);

            $run->addVersionControlDetails([$vcsDetails]);
        }

        $invocation = new Invocation(true);
        $invocation->setCommandLine(implode(' ', $argv));
        // strip the application name
        $app = array_shift($argv);
        $invocation->addArguments($argv);

        $artifactLocation = new ArtifactLocation();
        $artifactLocation->setUri($this->pathToArtifactLocation($app));
        $artifactLocation->setUriBaseId('APP_DIR');
        $invocation->setExecutableLocation($artifactLocation);

        $run->addInvocations([$invocation]);

        return new SarifLog([$run]);
    }

    /**
     * Returns path to resource (file) scanned.
     */
    private function pathToArtifactLocation(string $path): string
    {
        $workingDir = getcwd();
        if ($workingDir === false) {
            $workingDir = '.';
        }
        if (str_starts_with($path, $workingDir)) {
            // relative path
            return substr($path, strlen($workingDir) + 1);
        }

        return $path;
    }

    /**
     * Returns path to resource (file) scanned with protocol.
     */
    private function pathToUri(string $path): string
    {
        if (parse_url($path, PHP_URL_SCHEME) !== null) {
            // already a URL
            return $path;
        }

        $path = str_replace(DIRECTORY_SEPARATOR, '/', $path);

        // file:///C:/... on Windows systems
        if (!str_starts_with($path, '/')) {
            $path = realpath($path);
        }
        $path = rtrim($path, '/') . '/';

        return 'file://' . $path;
    }

    /**
     * @param string[] $command
     * @param string|null $cwd
     */
    private function runProcess(array $command, string $cwd = null): string
    {
        $process = new Process($command, $cwd);
        $process->start();

        while ($process->isRunning()) {
            // waiting for process to finish
        }

        $out = $process->getOutput();
        return trim($out);
    }
}
