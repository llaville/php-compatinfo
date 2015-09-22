<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

use PhpParser\Node;

/**
 *
 */
trait AbstractChange
{
    protected $condFunc;
    protected $condConst;

    protected function isConditionalDeclare(Node $node, $testfunc)
    {
        if (!($node instanceof Node\Stmt\If_ && $node->cond instanceof Node\Expr\BooleanNot)) {
            return false;
        }

        $expr = $node->cond->expr;
        return $expr instanceof Node\Expr\FuncCall && $this->isSameFunc($expr->name, $testfunc);
    }

    protected function isSameElement($name, $compare)
    {
        if (!is_string($name) && !method_exists($name, '__toString')) {
            return false;
        }
        return strcasecmp($name, $compare) === 0;
    }

    public function isConditionalFunc(Node $node)
    {
        return $this->isConditionalDeclare($node, 'function_exists');
    }

    public function isConditionalConst(Node $node)
    {
        return $this->isConditionalDeclare($node, 'defined');
    }

    public function getConditionalName(Node $node)
    {
        return $node->cond->expr->args[0]->value->value;
    }

    public function isSameFunc($name, $compare)
    {
        return $this->isSameElement($name, $compare);
    }

    public function isSameClass($name, $compare)
    {
        return $this->isSameElement($name, $compare);
    }

}
