<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\Expressions;

use Bartlett\CompatInfo\Collection\ReferenceCollection;
use Bartlett\CompatInfo\Sniffs\SniffAbstract;
use Bartlett\CompatInfo\Util\Database;

use PhpParser\Node;

use PDO;
use function ltrim;

/**
 * Detect conditional code identified by :
 * - [extension_loaded](https://www.php.net/manual/en/function.extension-loaded.php)
 * - [function_exists](https://www.php.net/manual/en/function.function-exists.php)
 * - [method_exists](https://www.php.net/manual/en/function.method-exists)
 * - [class_exists](https://www.php.net/manual/en/function.class-exists.php)
 * - [interface_exists](https://www.php.net/manual/en/function.interface-exists.php)
 * - [trait_exists](https://www.php.net/manual/en/function.trait-exists.php)
 * - [defined](https://www.php.net/manual/en/function.defined)
 *
 * @see tests/Sniffs/ConditionalCodeSniffTest
 * @since Class available since Release 5.4.0
 */
final class ConditionalCodeSniff extends SniffAbstract
{
    /** @var string */
    private $opt;

    /** @var string */
    private $group;

    /** @var ReferenceCollection */
    private $references;

    /**
     * {@inheritDoc}
     */
    public function setUpBeforeSniff(): void
    {
        parent::setUpBeforeSniff();

        /**
         * Initializes CompatInfo DB
         */
        $pdo = Database::initRefDb();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->references = new ReferenceCollection([], $pdo);
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$this->isConditionalCode($node)) {
            return null;
        }

        $versions =
            $this->references->find(
                'functions',
                (string) $node->name,
                (isset($node->args) ? count($node->args) : 0)
            )
        ;

        $extra = ('methods' === $this->group) ? $node->args[0]->value->value : null;

        $data = $node->getAttribute($this->attributeKeyStore, $versions);
        $data['opt.name'] = ('methods' === $this->group) ? $extra . '\\' . $this->opt : $this->opt;
        $data['opt.group'] = $this->group;
        $data['opt.versions'] = $this->references->find($this->group, $this->opt, 0, $extra);
        $node->setAttribute($this->attributeKeyStore, $data);
    }

    /**
     * Checks if node match a conditional code.
     *
     * @param Node $node
     * @return bool
     */
    private function isConditionalCode(Node $node): bool
    {
        if (($node instanceof Node\Expr\FuncCall && $node->name instanceof Node\Name) === false) {
            return false;
        }

        $function = (string) $node->name;

        $conditionalFunctions = [
            'extension_loaded' => 'extensions',
            'function_exists'  => 'functions',
            'method_exists'    => 'methods',
            'class_exists'     => 'classes',
            'interface_exists' => 'interfaces',
            'trait_exists'     => 'traits',
            'defined'          => 'constants',
        ];

        $this->group = $conditionalFunctions[$function] ?? '';
        if (empty($this->group)) {
            // not a conditional function
            return false;
        }

        $name = $node->args[0]->value;

        if (!$name instanceof Node\Scalar\String_) {
            // indirect name cannot be resolved
            return false;
        }
        $this->opt = ltrim($name->value, '\\');

        if ('methods' === $this->group) {
            $name = $node->args[1]->value;
            if (!$name instanceof Node\Scalar\String_) {
                // indirect method name cannot be resolved
                return false;
            }
            $this->opt = $name->value;
        }

        return true;
    }
}
