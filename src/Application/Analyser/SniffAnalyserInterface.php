<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Analyser;

use PhpParser\NodeVisitor;

/**
 * @since Release 6.0.0
 */
interface SniffAnalyserInterface extends AnalyserInterface, SniffVisitorInterface, NodeVisitor
{
}
