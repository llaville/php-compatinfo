<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\ControlStructures;

use Bartlett\CompatInfo\Application\Sniffs\KeywordBag;
use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;
use function sprintf;
use function str_replace;

/**
 * Declare control structures
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/control-structures.declare.php
 * @link https://wiki.php.net/rfc/scalar_type_hints_v5#strict_types_declare_directive
 * @see tests/Sniffs/DeclareSniffTest
 */
final class DeclareSniff extends SniffAbstract
{
    /** @var KeywordBag */
    private $directives;

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->directives = new KeywordBag(
            [
                'ticks' => '4.0',
                'encoding' => '5.3',
                'strict_types' => '7.0',
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Declare_) {
            return null;
        }

        foreach ($node->declares as $declare) {
            $key = (string) $declare->key;

            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $this->directives->get($key)]);
            $this->updateNodeElementRule(
                $node,
                $this->attributeKeyStore,
                sprintf('CA%2d02', str_replace('.', '', $this->directives->all()[$key]))
            );
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        foreach ($this->directives->all() as $directive => $min) {
            yield sprintf('CA%2d02', str_replace('.', '', $min)) => [
                'name' => $this->getShortClass(),
                'fullDescription' => "Directive '$directive' of declare block is available"
                    . ' since PHP ' . $this->directives->get($directive),
                'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-53',
            ];
        }
    }
}
