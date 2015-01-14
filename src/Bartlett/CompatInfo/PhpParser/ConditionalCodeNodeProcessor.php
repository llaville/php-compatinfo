<?php
/**
 * Concrete Node processor to check if conditional code is present.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\PhpParser;

use Bartlett\Reflect\PhpParser\NodeProcessorAbstract;

use PhpParser\Node;

/**
 * Concrete Node processor to check if conditional code is present.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha3
 */
class ConditionalCodeNodeProcessor extends NodeProcessorAbstract
{

    public function __construct()
    {
        $this->push(array($this, 'nodeProcessor'));
    }

    protected function nodeProcessor(Node $node)
    {
        if ($node instanceof Node\Expr\FuncCall
            && $node->name instanceof Node\Name
        ) {
            $element = (string) $node->name;

            $conditionalFunctions = array(
                'extension_loaded' => 'extensions',
                'function_exists'  => 'functions',
                'method_exists'    => 'methods',
                'class_exists'     => 'classes',
                'interface_exists' => 'interfaces',
                'trait_exists'     => 'traits',
                'defined'          => 'constants',
            );

            if (!array_key_exists($element, $conditionalFunctions)) {
                return;
            }
        } else {
            return;
        }

        // conditional code target
        $condition = $element;
        $context   = $conditionalFunctions[$element];

        $element = $node->args[0]->value;

        if (!$element instanceof Node\Scalar\String) {
            // cannot resolve variable argument
            return;
        }

        if ('methods' == $context) {
            // check also 2nd argument of method_exists
            $method = $node->args[1]->value;

            if (!$method instanceof Node\Scalar\String) {
                // cannot resolve method name argument
                return;
            }
        }
        $conditionalCode = array($element->value);

        if ('methods' == $context) {
            // method name
            $conditionalCode[] = $method->value;
        }
        return array($condition => $conditionalCode);
    }
}
