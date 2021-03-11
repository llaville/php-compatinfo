<?php declare(strict_types=1);

/**
 * Collect and analyse metrics of parsing results.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
*/

namespace Bartlett\CompatInfo\Api\V5;

use Bartlett\CompatInfo\Analyser\CompatibilityAnalyser;
use Bartlett\CompatInfo\Collection\ReferenceCollectionInterface;
use Bartlett\CompatInfo\Collection\SniffCollection;
use Bartlett\CompatInfo\DataCollector\ErrorHandler\Collecting as CollectingError;
use Bartlett\CompatInfo\DataCollector\ErrorHandler\Throwing as ThrowingError;
use Bartlett\CompatInfo\Profiler\Profile;
use Bartlett\CompatInfo\Profiler\Profiler;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use ArrayIterator;
use Exception;
use RuntimeException;

/**
 * Collect and analyse metrics of parsing results.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 5.4.0
 */
class Analyser extends SourceProvider
{
    private $eventDispatcher;

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function activatePlugins($register)
    {
        // @deprecated - will be removed in v6.0
    }

    /**
     * Analyse a data source and display results.
     *
     * @param string $source Path to the data source or its alias
     * @param bool $stop_on_failure Stop execution upon first error generated during lexing, parsing or some other operation
     * @param ReferenceCollectionInterface|null $referenceCollection
     * @param SniffCollection|null $sniffCollection
     * @param Profiler|null $profiler
     *
     * @return Profile
     * @throws Exception
     */
    public function run(string $source, bool $stop_on_failure = null, ReferenceCollectionInterface $referenceCollection = null, SniffCollection $sniffCollection = null, Profiler $profiler = null): Profile
    {
        if (null === $profiler) {
            $profiler = new Profiler(sha1($source));
        }

        if (null === $sniffCollection) {
            $sniffCollection = new SniffCollection(new ArrayIterator([]));
        }

        $finder = $this->getFinder($source);

        if ($finder === null) {
            throw new RuntimeException(
                'None data source matching'
            );
        }

        $parser = new Parser(
            new CompatibilityAnalyser($profiler, $sniffCollection, $referenceCollection),
            $referenceCollection
        );
        $parser->setEventDispatcher($this->eventDispatcher);
        $parser->setDataSourceId($source);

        // create compatible nikic/php-parser Throwing and Collecting objects
        $errorHandler = $stop_on_failure ? new ThrowingError() : new CollectingError();

        return $parser->parse($finder, $errorHandler, $profiler);
    }
}
