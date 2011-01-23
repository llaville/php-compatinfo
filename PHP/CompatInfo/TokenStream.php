<?php
/**
 * Wrapper based on PHP_TokenStream 1.0.1, that support a Hook system
 * to extends parser functionalities
 *
 * IMPORTANT: 
 * Some features are already in master branch of PHP_TokenStream repository.
 * Waiting for a new stable release before to clean-up code in this wrapper.
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

require_once 'PHP/Token/Stream.php';

class PHP_CompatInfo_TokenStream extends PHP_Token_Stream
{
    /**
     * @var array
     */
    protected $interfaces;

    /**
     * @var array
     */
    protected $parserElements = array();

    /**
     * @var array
     */
    private $data = array();


    /**
     * Constructor.
     *
     * @param string $sourceCode
     * @param array  $options    OPTIONAL
     */
    public function __construct($sourceCode, $options = null)
    {
        if (is_file($sourceCode)) {
            $sourceCode = file_get_contents($sourceCode);
        }

        if (is_array($options)) {
            foreach ($options as $elementName => $parser) {
                if (is_array($parser) && count($parser) == 2) {
                    $this->connectParserElement(
                        $elementName, $parser[0], $parser[1]
                    );
                }
            }
        }

        $this->scan($sourceCode);
    }

    /**
     * @param string $elementName  Token name element (PHP_Token_STRING for example)
     * @param mixed  $callback     A PHP callable function
     * @param string $classElement Class that should implement the token element
     *
     * @throws RuntimeException
     */
    private function connectParserElement($elementName, $callback, $classElement)
    {
        if (!class_exists($elementName, true)) {
            throw new RuntimeException(
                "Invalid element name provided. " .
                "Expected string beginning by 'PHP_Token_'"
            );
        }

        if (!is_callable($callback)) {
            if (is_array($callback)) {
                if (is_string($callback[0])) {
                    $cb = implode('::', $callback);
                } elseif (is_object($callback[0])) {
                    $cb = get_class($callback[0]) . '::' . (string)$callback[1];
                } else {
                    $cb = null;
                }
            } else {
                $cb = $callback;
            }
            throw new RuntimeException(
                "cannot call function $cb"
            );
        }

        if (!class_exists($classElement, true)) {
            throw new RuntimeException(
                "Unknown class element '" . (string)$classElement .  "'"
            );
        }

        $this->parserElements[$elementName] = array(
            'callback' => $callback,
            'alias'    => $classElement,
        );
    }

    /**
     * Scans the source for sequences of characters and converts them into a
     * stream of tokens.
     *
     * @param string $sourceCode
     */
    protected function scan($sourceCode)
    {
        $line      = 1;
        $tokens    = token_get_all($sourceCode);
        $numTokens = count($tokens);

        for ($i = 0; $i < $numTokens; ++$i) {
            $token = $tokens[$i];
            unset($tokens[$i]);

            if (is_array($token)) {
                $text       = $token[1];
                $tokenClass = 'PHP_Token_' . substr(token_name($token[0]), 2);
            } else {
                $text       = $token;
                $tokenClass = self::$customTokens[$token];
            }

            if (isset($this->parserElements[$tokenClass])) {
                $tokenClass = $this->parserElements[$tokenClass]['alias'];
            }

            $this->tokens[] = new $tokenClass($text, $line, $this, $i);
            $lines          = substr_count($text, "\n");
            $line          += $lines;

            if ($tokenClass == 'PHP_Token_HALT_COMPILER') {
                break;
            }

            else if ($tokenClass == 'PHP_Token_COMMENT' ||
                $tokenClass == 'PHP_Token_DOC_COMMENT') {
                $this->linesOfCode['cloc'] += $lines + 1;
            }
        }

        $this->linesOfCode['loc']   = substr_count($sourceCode, "\n");
        $this->linesOfCode['ncloc'] = $this->linesOfCode['loc'] -
                                      $this->linesOfCode['cloc'];
    }

    /**
     * @return array
     */
    public function getInterfaces()
    {
        if ($this->interfaces !== NULL) {
            return $this->interfaces;
        }

        $this->parseClassesFunctions();

        return $this->interfaces;
    }

    /**
     * Gets the names of all files that have been included
     * using include(), include_once(), require() or require_once().
     *
     * Parameter $categorize set to TRUE causing this function to return a
     * multi-dimensional array with categories in the keys of the first dimension
     * and constants and their values in the second dimension.
     *
     * Parameter $category allow to filter following specific inclusion type
     *
     * @param bool   $categorize OPTIONAL
     * @param string $category   OPTIONAL Either 'require_once', 'require',
     *                                           'include_once', 'include'.
     * @return array
     */
    public function getIncludes($categorize = FALSE, $category = NULL)
    {
        if ($this['includes'] === NULL) {
            $this['includes'] = array(
              'require_once' => array(),
              'require'      => array(),
              'include_once' => array(),
              'include'      => array()
            );

            foreach ($this->tokens as $token) {
                switch (get_class($token)) {
                    case 'PHP_CompatInfo_Token_REQUIRE_ONCE':
                    case 'PHP_CompatInfo_Token_REQUIRE':
                    case 'PHP_CompatInfo_Token_INCLUDE_ONCE':
                    case 'PHP_CompatInfo_Token_INCLUDE': {
                        $this['includes'][$token->getType()][] = $token->getName();
                    }
                    break;
                }
            }
        }

        if (isset($this['includes'][$category])) {
            $includes = $this['includes'][$category];
        }

        else if ($categorize === FALSE) {
            $includes = array_merge(
              $this['includes']['require_once'],
              $this['includes']['require'],
              $this['includes']['include_once'],
              $this['includes']['include']
            );
        } else {
            $includes = $this['includes'];
        }

        return $includes;
    }

    protected function parseClassesFunctions()
    {
        $this->interfaces = array();
        $this->classes    = array();
        $this->functions  = array();
        $class            = FALSE;
        $classEndLine     = FALSE;
        $interface        = FALSE;
        $interfaceEndLine = FALSE;

        foreach ($this->tokens as $token) {
            $context = array(
                'class'     => $class,
                'interface' => $interface,
                'token'     => $token
            );
            $tokenName = get_class($token);
            switch ($tokenName) {
                case 'PHP_Token_HALT_COMPILER': {
                    return;
                }
                break;

                case 'PHP_CompatInfo_Token_INTERFACE': {
                    $interface        = $token->getName();
                    $interfaceEndLine = $token->getEndLine();

                    $this->interfaces[$interface] = array(
                      'methods'   => array(),
                      'parent'    => $token->getParent(),
                      'startLine' => $token->getLine(),
                      'endLine'   => $interfaceEndLine
                    );
                }
                break;

                case 'PHP_CompatInfo_Token_CLASS': {
                    $class        = $token->getName();
                    $classEndLine = $token->getEndLine();

                    $this->classes[$class] = array(
                      'methods'   => array(),
                      'parent'    => $token->getParent(),
                      'interfaces'=> $token->getInterfaces(),
                      'startLine' => $token->getLine(),
                      'endLine'   => $classEndLine
                    );
                }
                break;

                case 'PHP_Token_FUNCTION': {
                    $name = $token->getName();
                    $tmp  = array(
                      'docblock'  => $token->getDocblock(),
                      'signature' => $token->getSignature(),
                      'startLine' => $token->getLine(),
                      'endLine'   => $token->getEndLine(),
                      'ccn'       => $token->getCCN()
                    );

                    if ($class === FALSE && $interface === FALSE) {
                        $this->functions[$name] = $tmp;
                    } else if ($interface === FALSE) {
                        $this->classes[$class]['methods'][$name] = $tmp;
                    } else {
                        $this->interfaces[$interface]['methods'][$name] = $tmp;
                    }
                }
                break;

                case 'PHP_Token_CLOSE_CURLY': {
                    if ($classEndLine !== FALSE &&
                        $classEndLine == $token->getLine()) {
                        $class        = FALSE;
                        $classEndLine = FALSE;
                    }
                    if ($interfaceEndLine !== FALSE &&
                        $interfaceEndLine == $token->getLine()) {
                        $interface        = FALSE;
                        $interfaceEndLine = FALSE;
                    }
                }
                break;

                default: {
                    // is there a callback connected to a particular token
                    foreach ($this->parserElements as $name => $element) {
                        if ($element['alias'] === $tokenName) {
                            // proceed
                            call_user_func_array(
                                $this->parserElements[$name]['callback'],
                                array(&$this, $context)
                            );
                            break;
                        }
                    }
                }
                break;
            }
        }
    }

    /**
     * @param mixed $offset
     */
    public function offsetExists($offset)
    {
        if (is_numeric($offset)) {
            return isset($this->tokens[$offset]);
        }
        return isset($this->data[$offset]);
    }

    /**
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        if (is_numeric($offset)) {
            return $this->tokens[$offset];
        }
        if ($this->functions === NULL) {
            $this->parseClassesFunctions();
        }
        return (isset($this->data[$offset]) ? $this->data[$offset] : NULL);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_numeric($offset)) {
            $this->tokens[$offset] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        if (is_numeric($offset)) {
            unset($this->tokens[$offset]);
        } else {
            unset($this->data[$offset]);
        }
    }

}
