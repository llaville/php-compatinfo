<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Query\Analyser\Compatibility;

use Bartlett\CompatInfo\Application\DataCollector\ErrorHandler\Collecting;
use Bartlett\CompatInfo\Application\DataCollector\ErrorHandler\Throwing;
use Bartlett\CompatInfo\Application\PhpParser\Parser;
use Bartlett\CompatInfo\Application\Profiler\Profile;
use Bartlett\CompatInfo\Application\Query\QueryHandlerInterface;
use Bartlett\CompatInfo\Application\Service\SourceProvider;

use Exception;
use RuntimeException;
use function realpath;

/**
 * Collect and analyse metrics of parsing results.
 *
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class GetCompatibilityHandler implements QueryHandlerInterface
{
    private Parser $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @throws Exception
     */
    public function __invoke(GetCompatibilityQuery $query): Profile
    {
        $dataSource = $query->getSource();
        $exclude = $query->getExclude();
        $source = realpath($dataSource);
        if (false === $source) {
            throw new RuntimeException(sprintf('No data source match (%s)', $dataSource));
        }

        // create compatible nikic/php-parser Throwing and Collecting objects
        $errorHandler = $query->isStopOnFailure() ? new Throwing() : new Collecting();

        $finder = SourceProvider::getFinder($source, $exclude);

        return $this->parser->parse($source, $finder, $errorHandler, $query->getVersion());
    }
}
