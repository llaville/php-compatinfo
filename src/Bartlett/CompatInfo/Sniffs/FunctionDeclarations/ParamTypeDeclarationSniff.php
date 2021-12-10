<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\FunctionDeclarations;

use Bartlett\CompatInfo\Sniffs\KeywordBag;
use Bartlett\CompatInfo\Sniffs\SniffAbstract;

use PhpParser\Node;

use function strtolower;

/**
 * Parameters Type Declaration
 *
 * @link https://www.php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration
 * @link https://wiki.php.net/rfc/callable
 * @link https://wiki.php.net/rfc/scalar_type_hints_v5
 * @link https://wiki.php.net/rfc/iterable
 * @link https://wiki.php.net/rfc/object-typehint
 * @link https://madewithlove.com/self-and-parent-type-hints/
 *
 * - Nullable Type Declarations since PHP 7.1
 * @link https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.nullable-types
 *
 * @see tests/Sniffs/ParamTypeDeclarationSniffTest
 * @since Class available since Release 5.4.0
 */
final class ParamTypeDeclarationSniff extends SniffAbstract
{
    /** @var KeywordBag */
    private $paramTypeDeclarations;

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();

        // Type declarations were not present in PHP 4.4 or earlier.
        $this->paramTypeDeclarations = new KeywordBag([
            'array' => '5.1',
            'self' => '5.2',
            'parent' => '5.2',
            'callable' => '5.4',
            'bool' => '7.0',
            'float' => '7.0',
            'int' => '7.0',
            'string' => '7.0',
            'iterable' => '7.1',
            'object' => '7.2',
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\FunctionLike) {
            return null;
        }

        $versions = $node->getAttribute($this->attributeKeyStore);

        foreach ($node->getParams() as $param) {
            if ($param->default instanceof Node\Expr\BinaryOp\Pow) {
                $this->updateVersion('5.6.0', $versions['php.min']);
            }

            if (null === $param->type) {
                // no type hint
                if (true === $param->variadic) {
                    // Variadic functions
                    $this->updateVersion('5.6.0', $versions['php.min']);
                }
                continue;
            }
            // type hint object required at least PHP 5.0
            $this->updateVersion('5.0.0', $versions['php.min']);

            if ($param->type instanceof Node\UnionType) {
                $this->updateVersion('8.0.0', $versions['php.min']);
            } elseif ($param->type instanceof Node\NullableType) {
                // @link https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.nullable-types
                $this->updateVersion('7.1.0', $versions['php.min']);
            } else {
                $min = $this->paramTypeDeclarations->get(strtolower((string) $param->type), '');
                if (!empty($min)) {
                    $this->updateVersion($min, $versions['php.min']);
                } else {
                    $this->updateElementVersion($versions, $param->type->getAttribute($this->attributeKeyStore, []));
                }
            }
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, $versions);
    }
}
