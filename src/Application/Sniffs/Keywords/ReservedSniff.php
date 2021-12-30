<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Keywords;

use Bartlett\CompatInfo\Application\Sniffs\KeywordBag;
use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * You cannot use any of the following words to name classes, interfaces or traits.
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/reserved.other-reserved-words.php
 * @link https://www.php.net/manual/en/migration70.incompatible.php#migration70.incompatible.other.classes
 * @link https://wiki.php.net/rfc/reserve_more_types_in_php_7
 * @see tests/Sniffs/KeywordReservedSniffTest
 */
final class ReservedSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();

        /**
         * The following words cannot be used to name a class, interface or trait,
         * and they are also prohibited from being used in namespaces.
         * @var array<string, string>
         */
        $forbiddenNames = [
            'bool' => '7.0',
            'int' => '7.0',
            'float' => '7.0',
            'string' => '7.0',
            'null' => '7.0',
            'true' => '7.0',
            'false' => '7.0',
            'void', '7.1',
            'iterable' => '7.1',
            'object' => '7.2',
        ];
        $this->forbiddenNames = new KeywordBag($forbiddenNames);

        /**
         * Furthermore, the following names should not be used.
         * Although they will not generate an error in PHP 7.0,
         * they are reserved for future use and should be considered deprecated.
         */
        $this->forbiddenNames->add(
            [
                'resource' => '7.0',
                'mixed' => '7.0',
                'numeric' => '7.0',
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        $this->contextIdentifier = $this->getNameContext($node);
        if (empty($this->contextIdentifier)) {
            return null;
        }

        if ($node instanceof Node\Stmt\Namespace_) {
            $this->contextCallback = [$this, 'enter' . str_replace('_', '', $node->getType())];
        } elseif ($node instanceof Node\Stmt\ClassLike) {
            $this->contextCallback = [$this, 'enterObject'];
        } else {
            $this->contextCallback = null;
        }

        if (!empty($this->contextCallback) && is_callable($this->contextCallback)) {
            call_user_func($this->contextCallback, $node);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        $reservedKeywords = ['7.0' => [], '7.1' => [], '7.2' => []];
        foreach ($this->forbiddenNames->all() as $name => $min) {
            $reservedKeywords[$min][] = $name;
        }
        // php bug (affect all versions) with workaround about void entry
        $reservedKeywords['7.1'][0] = 'void';
        unset($reservedKeywords['void']);

        foreach ($reservedKeywords as $min => $keywords) {
            yield sprintf('CA%2d07', str_replace('.', '', $min)) => [
                'name' => $this->getShortClass(),
                'fullDescription' => "You cannot use any of the following words to name classes, interfaces or traits"
                    . ' since PHP ' . $min . ' : ' . implode(', ', $keywords),
                'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-53',
            ];
        }
    }

    /**
     * Checks that reserved word can not be used as class, interface or trait names
     *
     * @param Node\Stmt\ClassLike $node
     * @return void
     * @see enterNode
     */
    private function enterObject(Node\Stmt\ClassLike $node): void
    {
        $this->checkForbiddenNames($node, $this->contextIdentifier);
    }

    /**
     * Checks that reserved word is prohibited from being used in part of a namespace
     *
     * @param Node\Stmt\Namespace_ $node
     * @return void
     * @see enterNode
     */
    private function enterStmtNamespace(Node\Stmt\Namespace_ $node): void
    {
        $namespaceParts = explode('\\', $this->contextIdentifier);

        foreach ($namespaceParts as $namespacePart) {
            $this->checkForbiddenNames($node, $namespacePart);
        }
    }
}
