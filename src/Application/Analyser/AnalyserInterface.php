<?php declare(strict_types=1);

/**
 * Interface that each analyser must implement.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

namespace Bartlett\CompatInfo\Application\Analyser;

use Symfony\Component\Finder\SplFileInfo;

/**
 * @since Release 5.4.0
 */
interface AnalyserInterface
{
    public function getCurrentFile(): SplFileInfo;

    public function getTokens(): array;

    public function setTokens(array $tokens): void;

    public function setCurrentFile(SplFileInfo $file): void;

    public function getMetrics(): array;

    public function getName(): string;

    public function getNamespace(): string;

    public function getShortName(): string;
}
