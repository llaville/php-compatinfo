<?php
/**
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * Implement/Replace existing STRING token behaviors
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Token_STRING extends PHP_Reflect_Token_STRING
{
    protected $name;
    protected $type;
    protected $arguments;

    public function getName()
    {
        if ($this->name !== NULL) {
            return $this->name;
        }

        if ($this->_isNamespace()) {
            $this->type = 'namespace';
            $namespace  = $this->tokenStream[$this->id+2][1];

            for ($i = $this->id + 3; ; $i += 2) {
                if (isset($this->tokenStream[$i]) &&
                    $this->tokenStream[$i][0] == 'T_NS_SEPARATOR') {
                    $namespace .= '\\' . $this->tokenStream[$i+1][1];
                } else {
                    break;
                }
            }
            $this->name = $namespace;
        }
        else if ($this->_isFunction()) {
            $this->type = 'function';
            $this->name = $this->tokenStream[$this->id][1];
        }
        else if ($this->_isInterface()) {
            $this->type = 'interface';
            $this->name = $this->tokenStream[$this->id][1];
        }
        else if ($this->_isClass()) {
            $this->type = 'class';
            $this->name = $this->tokenStream[$this->id][1];
        }
        else if ($this->_isConst()) {
            $this->type = 'const';
            $this->name = strtoupper($this->tokenStream[$this->id][1]);
        }
        else if ($this->_isConstant()) {
            $this->type = 'constant';
            $this->name = strtoupper($this->tokenStream[$this->id][1]);
        }

        return $this->name;
    }

    public function getType()
    {
        $this->getName();
        return $this->type;
    }

    private function _isFunction()
    {
        if ($this->_getContext(-2) == 'T_DOUBLE_COLON' ||
            $this->_getContext(-1) == 'T_DOUBLE_COLON') {
            return false;  // methodName of static class call
        }

        if ($this->_getContext(-2) == 'T_OBJECT_OPERATOR' ||
            $this->_getContext(-1) == 'T_OBJECT_OPERATOR') {
            return false;  // property or methodName class call
        }

        if ($this->_getContext(-2) == 'T_NEW'
            || $this->_getContext(-1) == 'T_NS_SEPARATOR'
        ) {
            return false;
        }

        if ($this->_getContext(-2) == 'T_FUNCTION') {
            return false;
        }

        if ($this->_getContext(1) == 'T_OPEN_BRACKET' ||
            $this->_getContext(2) == 'T_OPEN_BRACKET') {
            return true;
        }
        return false;
    }

    private function _isConst()
    {
        if ($this->_getContext(-2) == 'T_CONST') {
            // class or namespace constant
            return true;
        }
        return false;
    }

    private function _isConstant()
    {
        if ($this->_getContext(-2) == 'T_DOUBLE_COLON' ||
            $this->_getContext(-1) == 'T_DOUBLE_COLON') {
            return false;  // constant class call
        }

        $constants = get_defined_constants();
        $name      = $this->tokenStream[$this->id][1];

        return (array_key_exists(strtoupper($name), $constants));
    }

    private function _isInterface()
    {
        if ($this->_getContext(-2) == 'T_INTERFACE' ||
            $this->_getContext(-1) == 'T_INTERFACE') {
            return true;  // already catch by class PHP_Reflect_Token_INTERFACE
        }

        if ($this->_getContext(-2) == 'T_EXTENDS' ||
            $this->_getContext(-1) == 'T_EXTENDS') {

            if ($this->_getContext(-6) == 'T_CLASS') {
                return false;
            }
            return true;
        }

        $i = -1;
        do {
            $context = $this->_getContext($i);
            if ($context == 'T_COMMA' ||
                $context == 'T_WHITESPACE' ||
                $context == 'T_STRING') {
                $i--;
            } else {
                if ($context == 'T_IMPLEMENTS') {
                    return true;
                }
                return false;
            }
        } while (true);
    }

    private function _isClass()
    {
        $name = $this->tokenStream[$this->id][1];
        if ('self' == $name || 'parent' == $name) {
            return false;
        }

        if ($this->_getContext(-1) == 'T_NS_SEPARATOR') {
            $i = -2;
            do {
                $context = $this->_getContext($i);
                if ($context == 'T_WHITESPACE') {
                    if ($this->_getContext($i - 1) == 'T_NEW') {
                        return true;
                    }
                    return false;
                }
                $i--;
            } while (true);
        }

        if ($this->_getContext(-2) == 'T_NEW') {
            return true;
        }

        if ($this->_getContext(-2) == 'T_CLASS' ||
            $this->_getContext(-1) == 'T_CLASS') {
            return true;  // already catch by class PHP_Reflect_Token_CLASS
        }

        if ($this->_getContext(-2) == 'T_EXTENDS' ||
            $this->_getContext(-1) == 'T_EXTENDS') {

            if ($this->_getContext(-6) == 'T_INTERFACE') {
                return false;
            }
            return true;
        }

        if ($this->_getContext(-4) == 'T_CATCH' ||
            $this->_getContext(-3) == 'T_CATCH' ) {
            return true;
        }

        // static class call
        if ($this->_getContext(1) == 'T_DOUBLE_COLON' ||
            $this->_getContext(2) == 'T_DOUBLE_COLON') {
            return true;
        }
        return false;
    }

    private function _isNamespace()
    {
        if ($this->_getContext(-2) == 'T_NAMESPACE') {
            return true;
        }

        if ($this->_getContext(-1) == 'T_NS_SEPARATOR') {
            $i = -2;
            do {
                $context = $this->_getContext($i);
                if ($context == 'T_WHITESPACE') {
                    if ($this->_getContext($i - 1) == 'T_USE') {
                        return true;
                    }
                    return false;
                }
                $i--;
            } while (true);
        }
        return false;
    }

    private function _getContext($i)
    {
        if (($this->id + $i) > 0) {
            return $this->tokenStream[$this->id+$i][0];
        }
        return false;
    }
}
