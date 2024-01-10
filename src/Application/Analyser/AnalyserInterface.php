<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Analyser;

use PhpParser\Token;

use Symfony\Component\Finder\SplFileInfo;

/**
 * Interface that each analyser must implement.
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 */
interface AnalyserInterface
{
    public function getCurrentFile(): SplFileInfo;

    /**
     * @return array<int, mixed>
     */
    public function getTokens(): array;

    /**
     * @param array<int, Token> $tokens
     */
    public function setTokens(array $tokens): void;

    public function setCurrentFile(SplFileInfo $file): void;

    public function getName(): string;

    public function getNamespace(): string;

    public function getShortName(): string;
}
