<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\DataCollector;

use PhpParser\Error;
use PhpParser\Node;

use Symfony\Component\Finder\SplFileInfo;

/**
 * @author Laurent Laville
 * @since Release 5.4.0
 */
interface DataCollectorInterface
{
    /**
     * Resets a data collector to its initial state.
     */
    public function reset(): void;

    /**
     * Retrieves data collected.
     *
     * @return array<string, mixed>
     */
    public function getData(): array;

    /**
     * Collects data for the given Node from AST.
     *
     * @param Node[] $nodes
     * @return array<mixed, mixed>
     */
    public function collect(array $nodes): array;

    /**
     * Identify the data collector by a unique name.
     */
    public function setName(string $name): DataCollectorInterface;

    /**
     * Returns the name of the collector.
     */
    public function getName(): string;

    /**
     * Collects file analysed.
     */
    public function addFile(SplFileInfo $file): void;

    /**
     * Returns list of files analysed.
     *
     * @return string[]
     */
    public function getFiles(): array;

    /**
     * Collects all errors found.
     *
     * @param Error[] $errors
     */
    public function addErrors(array $errors): void;

    /**
     * Returns list of errors collected.
     *
     * @return string[]
     */
    public function getErrors(): array;
}
