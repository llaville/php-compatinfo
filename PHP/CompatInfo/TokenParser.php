<?php
/**
 * Additional parser
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * Additional parser connected to tokens :
 * T_STRING, T_CONSTANT_ENCAPSED_STRING,
 * T_LINE, T_FILE, T_DIR, T_FUNC_C, T_CLASS_C, T_METHOD_C, T_NS_C,
 * T_CATCH, T_CLONE, T_INSTANCEOF, T_THROW, T_TRY, T_HALT_COMPILER, T_GOTO
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_TokenParser
{
    /**
     * Parser for token T_STRING
     *
     * @return void
     */
    public static function parseTokenString()
    {
        list($subject, $context, $token) = func_get_args();

        if (in_array(
            (string)$token,
            array('__DIR__', '__NAMESPACE__', '__TRAIT__')
        )) {
            return self::parseTokenMagicConstant($subject, $context, $token);
        }
        extract($context);

        if ($namespace === FALSE) {
            // global namespace
            $ns = '\\';
        } else {
            $ns = $namespace;
        }

        $type = $token->getType();

        if ($type === 'constant') {
            $container = $subject->options['containers']['const'];

            if (null != $container) {
                $name = $token->getName();

                // update constants
                $constants = $subject->offsetGet(array($container => $ns));
                $constants[$name]['uses'][] = $token->getLine();
                $subject->offsetSet(array($container => $ns), $constants);
            }

        } elseif ($type === 'function') {
            $container = $subject->options['containers']['core'];

            $name = $token->getName();

            $classMethod     = FALSE;
            $interfaceMethod = FALSE;

            if ($class) {
                $classes = $subject->getClasses($ns);
                if (isset($classes[$class]['methods'])) {
                    $classMethod = array_key_exists(
                        $name, $classes[$class]['methods']
                    );
                } else {
                    $classMethod = false;
                }

            } else if ($interface) {
                $interfaces = $subject->getInterfaces($ns);
                if (isset($interfaces[$interface]['methods'])) {
                    $interfaceMethod = array_key_exists(
                        $name, $interfaces[$interface]['methods']
                    );
                } else {
                    $interfaceMethod = false;
                }
            }
            if ($classMethod === FALSE && $interfaceMethod === FALSE) {

                if (null != $container) {
                    $name = $token->getName();

                    // update internal functions
                    $functions = $subject->offsetGet(array($container => $ns));
                    $functions[$name]['uses'][] = $token->getLine();
                    $functions[$name]['arguments'] = $token->getArguments();
                    $subject->offsetSet(array($container => $ns), $functions);
                }
            }

        } elseif ($type === 'interface') {
            $container = $subject->options['containers'][$type];

            if (null != $container) {
                $name = $token->getName();

                // update interfaces
                $interfaces = $subject->offsetGet(array($container => $ns));
                $interfaces[$name]['uses'][] = $token->getLine();
                $subject->offsetSet(array($container => $ns), $interfaces);

            }

        } elseif ($type === 'class') {
            $container = $subject->options['containers'][$type];

            if (null != $container) {
                $name = $token->getName();

                // update classes
                $classes = $subject->offsetGet(array($container => $ns));
                $classes[$name]['uses'][] = $token->getLine();
                $subject->offsetSet(array($container => $ns), $classes);
            }
        }
    }

    /**
     * Parser for token T_CONSTANT_ENCAPSED_STRING
     *
     * @return void
     */
    public static function parseTokenConstant()
    {
        list($subject, $context, $token) = func_get_args();
        extract($context);

        if ($namespace === FALSE) {
            // global namespace
            $ns = '\\';
        } else {
            $ns = $namespace;
        }

        $type = $token->getType();

        if ($type === 'constant') {
            $container = $subject->options['containers']['const'];

            if (null != $container) {
                $name = $token->getName();

                // update constants
                $constants = $subject->offsetGet(array($container => $ns));
                $constants[$name]['uses'][] = $token->getLine();
                $subject->offsetSet(array($container => $ns), $constants);
            }
        }
    }

    /**
     * Parser for tokens
     * T_LINE, T_FILE, T_DIR, T_FUNC_C, T_CLASS_C, T_METHOD_C, T_NS_C
     *
     * @return void
     */
    public static function parseTokenMagicConstant()
    {
        list($subject, $context, $token) = func_get_args();
        extract($context);

        if ($namespace === FALSE) {
            // global namespace
            $ns = '\\';
        } else {
            $ns = $namespace;
        }

        $container = $subject->options['containers']['const'];

        if (null != $container) {
            $name = (string)$token;

            // update constants
            $constants = $subject->offsetGet(array($container => $ns));
            $constants[$name]['uses'][] = $token->getLine();
            $subject->offsetSet(array($container => $ns), $constants);
        }
    }

    /**
     * Parser for token T_VARIABLE
     *
     * @return void
     */
    public static function parseTokenGlobals()
    {
        list($subject, $context, $token) = func_get_args();
        extract($context);

        $type = $token->getType();
        if ($type === NULL) {
            // standard variable
            return;
        }

        if ($namespace === FALSE) {
            // global namespace
            $ns = '\\';
        } else {
            $ns = $namespace;
        }

        $container = $subject->options['containers']['glob'];

        if (null != $container) {
            $name = $token->getName();

            // update globals
            $globals = $subject->offsetGet(array($container => $ns));
            $globals[$type][$name]['uses'][] = $token->getLine();
            $subject->offsetSet(array($container => $ns), $globals);
        }
    }

    /**
     * Parser for tokens
     * T_CATCH, T_CLONE, T_INSTANCEOF, T_THROW, T_TRY, T_HALT_COMPILER, T_GOTO,
     * T_UNSET_CAST, T_INSTEADOF, T_OBJECT_OPERATOR, T_OPEN_SQUARE
     * 
     * @return void
     */
    public static function parseTokenFeatures()
    {
        list($subject, $context, $token) = func_get_args();
        extract($context);

        if ($namespace === FALSE) {
            // global namespace
            $ns = '\\';
        } else {
            $ns = $namespace;
        }

        $container = $subject->options['containers']['token'];

        if (null != $container) {
            $name = (string)$token;

            if ('' == $name) {
                return;
            }

            // update tokens
            $tokens = $subject->offsetGet(array($container => $ns));
            $tokens[$name]['uses'][] = $token->getLine();
            $subject->offsetSet(array($container => $ns), $tokens);
        }
    }

}
