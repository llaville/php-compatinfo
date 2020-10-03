<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\DataCollector;

use PhpParser\NodeVisitor;

use function array_fill_keys;
use function array_filter;
use function array_pop;
use function array_replace;
use function explode;
use function implode;
use function strpos;

/**
 * @since 5.4.0
 */
final class VersionDataCollector extends DataCollector
{
    /** @var string[] */
    private $dataKeysAllowed = [];

    /** @var array */
    private $extensions = [];

    /** @var array */
    private $versions = [];

    public function __construct(NodeVisitor $visitor)
    {
        parent::__construct($visitor);

        $this->dataKeysAllowed = [
            'versions',
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
            'conditions'
        ];

        $this->reset();
    }

    /**
     * {@inheritDoc}
     */
    public function collect(array $nodes): array
    {
        $dataVisited = parent::collect($nodes);

        foreach($dataVisited as $item) {
            if (isset($item['versions']['opt.group'])) {
                $this->handleCodeWithCondition($item['id'], $item['type'], $item['versions']);
            } else {
                $this->handleCodeWithoutCondition($item['id'], $item['type'], $item['versions'], $item['parents']);
            }
        }

        $this->data['versions'] = $this->versions;
        $this->data['extensions'] = $this->extensions;

        return $this->data;
    }

    /**
     * {@inheritDoc}
     */
    public function reset(): void
    {
        parent::reset();

        $this->versions = array_filter(self::$php4, function ($key) {
            return (strpos($key, 'php.') !== false);
        }, ARRAY_FILTER_USE_KEY);
        $this->extensions = [];
        $this->data = array_fill_keys($this->dataKeysAllowed, []);
    }

    public function getVersions(): array
    {
        return $this->data['versions'] ?? [];
    }

    public function getExtensions(): array
    {
        return $this->data['extensions'] ?? [];
    }

    public function getNamespaces(): array
    {
        return $this->data['namespace'] ?? [];
    }

    public function getClasses(): array
    {
        return $this->data['classes'] ?? [];
    }

    public function getInterfaces(): array
    {
        return $this->data['interfaces'] ?? [];
    }

    public function getTraits(): array
    {
        return $this->data['traits'] ?? [];
    }

    public function getMethods(): array
    {
        return $this->data['methods'] ?? [];
    }

    public function getGenerators(): array
    {
        return $this->data['generators'] ?? [];
    }

    public function getFunctions(): array
    {
        return $this->data['functions'] ?? [];
    }

    public function getConstants(): array
    {
        return $this->data['constants'] ?? [];
    }

    public function getDirectives(): array
    {
        return $this->data['directives'] ?? [];
    }

    public function getConditions(): array
    {
        return $this->data['conditions'] ?? [];
    }

    private function handleCodeWithoutCondition(string $id, string $group, array $versions, array $parents): void
    {
        if (isset($this->data[$group][$id])) {
            if (isset($this->data[$group][$id]['optional'])) {
                return;
            }
            $this->updateElementVersion($this->data[$group][$id], $versions);
            $versions = $this->data[$group][$id];
        } else {
            $versions = array_replace(self::$php4, $versions);
            $this->data[$group][$id] = $versions;
        }

        $extName = $this->data[$group][$id]['ext.name'];
        if ('user' !== $extName && ($this->data[$group][$id]['optional'] ?? false) === false) {
            $this->updateExtension($extName, $this->extensions, $versions);
        }
        unset($versions['ext.name']);

        foreach ($parents as $parent) {
            // Updates all parent context elements
            $type = key($parent);
            $id = reset($parent);
            if (isset($this->data[$type][$id])) {
                $this->updateElementVersion($this->data[$type][$id], $versions);
            }
        }

        // Updates the global versions of the data source scanned
        $this->updateElementVersion($this->versions, $versions);
    }

    private function handleCodeWithCondition(string $id, string $type, array $condition): void
    {
        $name = $condition['opt.name'];
        $group = $condition['opt.group'];
        $versions = $condition['opt.versions'];

        if (empty($versions['ext.min'])) {
            // when version is empty because NameResolver cannot resolve FQN class name (import namespace not specified)
            // i.e: with vfsStream 1.6.0 ZipArchive is under user namespace `org\bovigo\vfs`
            // @see https://github.com/bovigo/vfsStream/blob/v1.6.0/src/test/php/org/bovigo/vfs/vfsStreamZipTestCase.php#L39
            $versions['ext.min'] = '0.1.0';
            $versions['ext.max'] = $versions['php.max'] = '';
            $versions['php.min'] = '4.0.0';
        }

        $this->data['conditions'][sprintf('%s(%s)', $id, $name)] = $versions;

        if ('methods' === $group) {
            $parts = explode('\\', $name);
            array_pop($parts);
            $name = implode('\\', $parts);
            $group = 'classes';
        }

        if (!isset($this->data[$group][$name])) {
            $this->data[$group][$name] = $versions;
        }
        $this->data[$group][$name]['optional'] = true;

        if (!isset($this->extensions[$versions['ext.name']])) {
            $this->extensions[$versions['ext.name']] = $versions;
        }
        $this->extensions[$versions['ext.name']]['optional'] = true;

        if (!isset($this->data[$type][$id])) {
            unset(
                $condition['opt.name'],
                $condition['opt.group'],
                $condition['opt.versions']
            );
            $this->data[$type][$id] = $condition;
        }
    }
}
