<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * You cannot use any of the following words as constants, class names,
 * function or method names.
 *
 * @link http://php.net/manual/en/reserved.keywords.php
 * @link https://github.com/wimg/PHPCompatibility/issues/45
 */
class KeywordReservedSniff extends SniffAbstract
{
    private $forbiddenNames;
    private $keywordReserved;

    public function enterSniff()
    {
        parent::enterSniff();

        $this->forbiddenNames = array(
            '__halt_compiler' => '5.1',
            'abstract' => '5.0',
            'and' => '4.0',
            'array' => '4.0',
            'as' => '4.0',
            'break' => '4.0',
            'callable' => '5.4',
            'case' => '4.0',
            'catch' => '5.0',
            'class' => '4.0',
            'clone' => '5.0',
            'const' => '4.0',
            'continue' => '4.0',
            'declare' => '4.0',
            'default' => '4.0',
            'die' => '4.0',
            'do' => '4.0',
            'echo' => '4.0',
            'else' => '4.0',
            'elseif' => '4.0',
            'empty' => '4.0',
            'enddeclare' => '4.0',
            'endfor' => '4.0',
            'endforeach' => '4.0',
            'endif' => '4.0',
            'endswitch' => '4.0',
            'endwhile' => '4.0',
            'eval' => '4.0',
            'exit' => '4.0',
            'extends' => '4.0',
            'final' => '5.0',
            'finally' => '5.5',
            'for' => '4.0',
            'foreach' => '4.0',
            'function' => '4.0',
            'global' => '4.0',
            'goto' => '5.3',
            'if' => '4.0',
            'implements' => '5.0',
            'include' => '4.0',
            'include_once' => '4.0',
            'instanceof' => '5.0',
            'insteadof' => '5.4',
            'interface' => '5.0',
            'isset' => '4.0',
            'list' => '4.0',
            'namespace' => '5.3',
            'new' => '4.0',
            'or' => '4.0',
            'print' => '4.0',
            'private' => '5.0',
            'protected' => '5.0',
            'public' => '5.0',
            'require' => '4.0',
            'require_once' => '4.0',
            'return' => '4.0',
            'static' => '4.0',
            'switch' => '4.0',
            'throw' => '5.0',
            'trait' => '5.4',
            'try' => '5.0',
            'unset' => '4.0',
            'use' => '4.0',
            'var' => '4.0',
            'while' => '4.0',
            'xor' => '4.0',
            'yield' => '5.5',
            '__class__' => '4.0',
            '__dir__' => '5.3',
            '__file__' => '4.0',
            '__function__' => '4.0',
            '__line__' => '4.0',
            '__method__' => '4.0',
            '__namespace__' => '5.3',
            '__trait__' => '5.4',
        );

        $this->keywordReserved = array();
    }
    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->keywordReserved)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::KEYWORD_RESERVED => $this->keywordReserved)
            );
        }
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Class_
            || $node instanceof Node\Stmt\Interface_
            || $node instanceof Node\Stmt\Function_
            || $node instanceof Node\Stmt\ClassMethod
            || $node instanceof Node\Expr\MethodCall
            || $node instanceof Node\Expr\StaticCall
        ) {
            if (!$node->name instanceof Node\Name) {
                return;
            }
            $name = (string) $node->name;
        } elseif ($node instanceof Node\Stmt\Trait_) {
            $name = 'trait';
        } elseif (($node instanceof Node\Expr\ConstFetch || $node instanceof Node\Expr\FuncCall)
            && $node->name instanceof Node\Name
        ) {
            $name = $node->name->toString();
        } elseif ($node instanceof Node\Expr\New_
            || $node instanceof Node\Expr\ClassConstFetch
        ) {
            if (!$node->class instanceof Node\Name) {
                return;
            }
            $name = (string) $node->class;
        } else {
            return;
        }

        $name = strtolower($name);

        if (isset($this->forbiddenNames[$name])) {
            if (!isset($this->keywordReserved[$name])) {
                $version = $this->forbiddenNames[$name];

                $this->keywordReserved[$name] = array(
                    'severity' => $this->getCurrentSeverity($version, 'lt'),
                    'version'  => $version,
                    'spots'    => array()
                );
            }
            $this->keywordReserved[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }
}
