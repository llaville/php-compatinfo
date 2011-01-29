<?php
/**
 * Parser for PHP_Token_STRING
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

class PHP_CompatInfo_TokenParser
{
    public static function parseTokenString(PHP_Token_Stream &$ts, $context)
    {
        extract($context);

        $type = $token->getType();

        if ($type === 'constant') {
            $name = $token->getName();
            if (isset($ts['constants'])) {
                $constants = $ts['constants'];
            } else {
                $constants = array();
            }
            $constants[$name]['uses'][] = $token->getLine();
            $ts['constants'] = $constants;
        }
        elseif ($type === 'function') {
            $name = $token->getName();

            $classMethod     = FALSE;
            $interfaceMethod = FALSE;

            if ($class) {
                $classes = $ts->getClasses();
                $classMethod = array_key_exists(
                    $name, $classes[$class]['methods']
                );
            }
            else if ($interface) {
                $interfaces = $ts->getInterfaces();
                $interfaceMethod = array_key_exists(
                    $name, $interfaces[$interface]['methods']
                );
            }
            if ($classMethod === FALSE && $interfaceMethod === FALSE) {
                if (isset($ts['internalFunctions'])) {
                    $functions = $ts['internalFunctions'];
                } else {
                    $functions = array();
                }
                $functions[$name]['uses'][] = $token->getLine();
                $ts['internalFunctions'] = $functions;
            }

        }
        elseif ($type === 'interface') {
            $name = $token->getName();
            if (isset($ts['allInterfaces'])) {
                $interfaces = $ts['allInterfaces'];
            } else {
                $interfaces = array();
            }
            $interfaces[$name]['uses'][] = $token->getLine();
                    $ts['allInterfaces'] = $interfaces;
        }
        elseif ($type === 'class') {
            $name = $token->getName();
            if (isset($ts['allClasses'])) {
                $classes = $ts['allClasses'];
            } else {
                $classes = array();
            }
            $classes[$name]['uses'][] = $token->getLine();
            $ts['allClasses'] = $classes;
        }
    }

    public static function parseTokenConstant(PHP_Token_Stream &$ts, $context)
    {
        extract($context);

        $type = $token->getType();

        if ($type === 'constant') {
            $name = $token->getName();
            if (isset($ts['constants'])) {
                $constants = $ts['constants'];
            } else {
                $constants = array();
            }
            $constants[$name]['uses'][] = $token->getLine();
            $ts['constants'] = $constants;
        }
    }

    // parser for tokens REQUIRE_*, INCLUDE_*
    public static function parseTokenIncludes(PHP_Token_Stream &$ts, $context)
    {
        extract($context);

        if (isset($ts['includes'])) {
            $includes = $ts['includes'];
        } else {
            $includes = array();
        }
        $includes[$token->getType()][] = $token->getName();
        $ts['includes'] = $includes;
    }

    // dummy parser for token INTERFACE
    public static function parseTokenInterface(PHP_Token_Stream &$ts, $context)
    {

    }

    // dummy parser for token CLASS
    public static function parseTokenClass(PHP_Token_Stream &$ts, $context)
    {
    }
}

/**
 * implement/replace class PHP_Token_STRING
 */
class PHP_CompatInfo_Token_STRING extends PHP_Token_STRING
{
    protected $name;
    protected $type;

    private $_tokens;

    public function getName()
    {
        if ($this->name !== NULL) {
            return $this->name;
        }

        $this->_tokens = $this->tokenStream->tokens();

        if ($this->_isFunction()) {
            $this->type = 'function';
            $this->name = (string)$this->_tokens[$this->id];
        }
        else if ($this->_isInterface()) {
            $this->type = 'interface';
            $this->name = (string)$this->_tokens[$this->id];
        }
        else if ($this->_isClass()) {
            $this->type = 'class';
            $this->name = (string)$this->_tokens[$this->id];
        }
        else if ($this->_isConstant()) {
            $this->type = 'constant';
            $this->name = strtoupper((string)$this->_tokens[$this->id]);
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
        if ($this->_getContext(-2) instanceof PHP_Token_DOUBLE_COLON ||
            $this->_getContext(-1) instanceof PHP_Token_DOUBLE_COLON) {
            return false;  // methodName of static class call
        }

        if ($this->_getContext(-2) instanceof PHP_Token_OBJECT_OPERATOR ||
            $this->_getContext(-1) instanceof PHP_Token_OBJECT_OPERATOR) {
            return false;  // property or methodName class call
        }

        if ($this->_getContext(-2) instanceof PHP_Token_NEW) {
            return false;
        }

        if ($this->_getContext(-2) instanceof PHP_Token_FUNCTION) {
            return false;
        }

        if ($this->_getContext(1) instanceof PHP_Token_OPEN_BRACKET ||
            $this->_getContext(2) instanceof PHP_Token_OPEN_BRACKET) {
            return true;
        }
        return false;
    }

    private function _isConstant()
    {
        $constants = get_defined_constants();
        $name      = (string)$this->_tokens[$this->id];

        return (array_key_exists(strtoupper($name), $constants));
    }

    // Until a new stable release of PHP_TokenStream greater than 1.0.1 is available
    // replace 'PHP_Token_INTERFACE' by 'PHP_CompatInfo_Token_INTERFACE'
    // replace 'PHP_Token_CLASS'     by 'PHP_CompatInfo_Token_CLASS'
    private function _isInterface()
    {
        if (get_class($this->_getContext(-2)) === 'PHP_CompatInfo_Token_INTERFACE' ||
            get_class($this->_getContext(-1)) === 'PHP_CompatInfo_Token_INTERFACE') {
            return true;  // already catch by class PHP_Token_INTERFACE
        }

        if ($this->_getContext(-2) instanceof PHP_Token_EXTENDS ||
            $this->_getContext(-1) instanceof PHP_Token_EXTENDS) {

            if (get_class($this->_getContext(-6)) === 'PHP_CompatInfo_Token_CLASS') {
                return false;
            }
            return true;
        }

        $i = -1;
        do {
            $context = $this->_getContext($i);
            if ($context instanceof PHP_Token_COMMA ||
                $context instanceof PHP_Token_WHITESPACE ||
                $context instanceof PHP_Token_STRING) {
                $i--;
            } else {
                if ($context instanceof PHP_Token_IMPLEMENTS) {
                    return true;
                }
                return false;
            }
        } while (true);
    }

    // Until a new stable release of PHP_TokenStream greater than 1.0.1 is available
    // replace 'PHP_Token_INTERFACE' by 'PHP_CompatInfo_Token_INTERFACE'
    // replace 'PHP_Token_CLASS'     by 'PHP_CompatInfo_Token_CLASS'
    private function _isClass()
    {
        $name = (string)$this->_tokens[$this->id];
        if ('self' == $name || 'parent' == $name) {
            return false;
        }

        if ($this->_getContext(-2) instanceof PHP_Token_NEW) {
            return true;
        }

        if (get_class($this->_getContext(-2)) === 'PHP_CompatInfo_Token_CLASS' ||
            get_class($this->_getContext(-1)) === 'PHP_CompatInfo_Token_CLASS') {
            return true;  // already catch by class PHP_Token_CLASS
        }

        if ($this->_getContext(-2) instanceof PHP_Token_EXTENDS ||
            $this->_getContext(-1) instanceof PHP_Token_EXTENDS) {

            if (get_class($this->_getContext(-6)) === 'PHP_CompatInfo_Token_INTERFACE') {
                return false;
            }
            return true;
        }

        if ($this->_getContext(-4) instanceof PHP_Token_CATCH ||
            $this->_getContext(-3) instanceof PHP_Token_CATCH ) {
            return true;
        }

        // static class call
        if ($this->_getContext(1) instanceof PHP_Token_DOUBLE_COLON ||
            $this->_getContext(2) instanceof PHP_Token_DOUBLE_COLON) {
            return true;
        }
        return false;
    }

    private function _getContext($i)
    {
        if (($this->id + $i) > 0) {
            return $this->_tokens[$this->id+$i];
        }
        return false;
    }
}

/**
 * implement/replace class PHP_Token_CONSTANT_ENCAPSED_STRING
 */
class PHP_CompatInfo_Token_CONSTANT_ENCAPSED_STRING extends PHP_Token_CONSTANT_ENCAPSED_STRING
{
    protected $name;
    protected $type;

    public function getName()
    {
        if ($this->name !== NULL) {
            return $this->name;
        }

        $tokens = $this->tokenStream->tokens();

        for ($i = $this->id - 1; $i > $this->id - 5; $i -= 1) {
            if (isset($tokens[$i]) &&
                $tokens[$i] instanceof PHP_Token_STRING &&
                in_array(strtolower($tokens[$i]), array('define', 'defined', 'constant'))
            ) {
                $this->type = 'constant';
                $this->name = trim($tokens[$this->id], "'\"");
                break;
            }
        }
        return $this->name;
    }

    public function getType()
    {
        $this->getName();
        return $this->type;
    }
}

/**
 * Until a new stable release of PHP_TokenStream greater than 1.0.1 is available
 */
abstract class PHP_CompatInfo_Token_Includes extends PHP_Token
{
    protected $name;
    protected $type;

    public function getName()
    {
        if ($this->name !== NULL) {
            return $this->name;
        }

        $tokens = $this->tokenStream->tokens();

        if ($tokens[$this->id+2] instanceof PHP_Token_CONSTANT_ENCAPSED_STRING) {
            $this->name = trim($tokens[$this->id+2], "'\"");
            $this->type = strtolower(
                str_replace('PHP_CompatInfo_Token_', '', get_class($tokens[$this->id]))
            );
        }

        return $this->name;
    }

    public function getType()
    {
        $this->getName();
        return $this->type;
    }
}

class PHP_CompatInfo_Token_REQUIRE_ONCE extends PHP_CompatInfo_Token_Includes {}
class PHP_CompatInfo_Token_REQUIRE extends PHP_CompatInfo_Token_Includes {}
class PHP_CompatInfo_Token_INCLUDE_ONCE extends PHP_CompatInfo_Token_Includes {}
class PHP_CompatInfo_Token_INCLUDE extends PHP_CompatInfo_Token_Includes {}

abstract class PHP_CompatInfo_TokenWithScope extends PHP_Token
{
    protected $endTokenId;

    public function getEndTokenId()
    {
        $block  = 0;
        $i      = $this->id;
        $tokens = $this->tokenStream->tokens();

        while ($this->endTokenId === NULL && isset($tokens[$i])) {
            if ($tokens[$i] instanceof PHP_Token_OPEN_CURLY
                || $tokens[$i] instanceof PHP_Token_CURLY_OPEN
            ) {
                $block++;
            }

            else if ($tokens[$i] instanceof PHP_Token_CLOSE_CURLY) {
                $block--;

                if ($block === 0) {
                    $this->endTokenId = $i;
                }
            }

            else if ($this instanceof PHP_Token_FUNCTION &&
                $tokens[$i] instanceof PHP_Token_SEMICOLON) {
                if ($block === 0) {
                    $this->endTokenId = $i;
                }
            }

            $i++;
        }

        if ($this->endTokenId === NULL) {
            $this->endTokenId = $this->id;
        }

        return $this->endTokenId;
    }

    public function getEndLine()
    {
        return $this->tokenStream[$this->getEndTokenId()]->getLine();
    }

}

class PHP_CompatInfo_Token_INTERFACE extends PHP_CompatInfo_TokenWithScope
{
    protected $interfaces;

    public function getName()
    {
        return (string)$this->tokenStream[$this->id + 2];
    }

    public function hasParent()
    {
        return $this->tokenStream[$this->id + 4] instanceof PHP_Token_EXTENDS;
    }

    public function getParent()
    {
        if (!$this->hasParent()) {
            return FALSE;
        }

        $i         = $this->id + 6;
        $tokens    = $this->tokenStream->tokens();
        $className = (string)$tokens[$i];

        while (!$tokens[$i+1] instanceof PHP_Token_WHITESPACE) {
            $className .= (string)$tokens[++$i];
        }

        return $className;
    }

    public function hasInterfaces()
    {
        return ($this->tokenStream[$this->id + 4] instanceof PHP_Token_IMPLEMENTS ||
            $this->tokenStream[$this->id + 8] instanceof PHP_Token_IMPLEMENTS);
    }

    public function getInterfaces()
    {
        if ($this->interfaces !== NULL) {
            return $this->interfaces;
        }

        if (!$this->hasInterfaces()) {
            return ($this->interfaces = FALSE);
        }

        if ($this->tokenStream[$this->id + 4] instanceof PHP_Token_IMPLEMENTS) {
            $i = $this->id + 3;
        } else {
            $i = $this->id + 7;
        }
        $tokens = $this->tokenStream->tokens();

        while (!$tokens[$i+1] instanceof PHP_Token_OPEN_CURLY) {
            $i++;
            if ($tokens[$i] instanceof PHP_Token_STRING) {
                $this->interfaces[] = (string)$tokens[$i];
            }
        }
        return $this->interfaces;
    }
}

class PHP_CompatInfo_Token_CLASS extends PHP_CompatInfo_Token_INTERFACE {}

