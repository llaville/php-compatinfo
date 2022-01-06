<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Analyser;

use Bartlett\CompatInfo\Application\DataCollector\ErrorHandler;
use Bartlett\CompatInfo\Application\Profiler\ProfilerInterface;

use PhpParser\NodeVisitor;

/**
 * @author Laurent Laville
 * @since Release 6.0.0
 */
interface SniffAnalyserInterface extends SniffVisitorInterface, NodeVisitor
{
    public function getProfiler(): ProfilerInterface;

    public function setErrorHandler(ErrorHandler $errorHandler): void;
}
