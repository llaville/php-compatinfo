<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Analyser;

/**
 * Interface that all analysers using sniffs must implement.
 *
 * @author Laurent Laville
 * @since Release 6.0.0
 */
interface SniffVisitorInterface extends AnalyserInterface
{
    public function setUpBeforeVisitor(): void;
    public function tearDownAfterVisitor(): void;
}
