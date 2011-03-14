<?php
/**
 * Additional parser connected to tokens T_STRING and T_CONSTANT_ENCAPSED_STRING
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

class PHP_CompatInfo_TokenParser
{
    public static function parseTokenString()
    {
        list($subject, $context, $token) = func_get_args();
        extract($context);

        $type = $token->getType();

        if ($type === 'constant') {
            $container = $subject->options['containers']['const'];

            if (null != $container) {
                $name = $token->getName();

                // update constants
                $constants = $subject->offsetGet($container);
                $constants[$name]['uses'][] = $token->getLine();
                $subject->offsetSet($container, $constants);
            }

        }
        elseif ($type === 'function') {
            $container = $subject->options['containers']['core'];

            $name = $token->getName();

            $classMethod     = FALSE;
            $interfaceMethod = FALSE;

            if ($class) {
                $classes = $subject->getClasses();
                $classMethod = array_key_exists(
                    $name, $classes[$class]['methods']
                );
            }
            else if ($interface) {
                $interfaces = $subject->getInterfaces();
                $interfaceMethod = array_key_exists(
                    $name, $interfaces[$interface]['methods']
                );
            }
            if ($classMethod === FALSE && $interfaceMethod === FALSE) {

                if (null != $container) {
                    $name = $token->getName();

                    // update internal functions
                    $functions = $subject->offsetGet($container);
                    $functions[$name]['uses'][] = $token->getLine();
                    $subject->offsetSet($container, $functions);
                }
            }

        }
        elseif ($type === 'interface') {
            $container = $subject->options['containers'][$type];

            if (null != $container) {
                $name = $token->getName();

                // update interfaces
                $interfaces = $subject->offsetGet($container);
                $interfaces[$name]['uses'][] = $token->getLine();
                $subject->offsetSet($container, $interfaces);
            }
        }
        elseif ($type === 'class') {
            $container = $subject->options['containers'][$type];

            if (null != $container) {
                $name = $token->getName();

                // update classes
                $classes = $subject->offsetGet($container);
                $classes[$name]['uses'][] = $token->getLine();
                $subject->offsetSet($container, $classes);
            }
        }
    }

    public static function parseTokenConstant()
    {
        list($subject, $context, $token) = func_get_args();
        extract($context);

        $type = $token->getType();

        if ($type === 'constant') {
            $container = $subject->options['containers']['const'];

            if (null != $container) {
                $name = $token->getName();

                // update constants
                $constants = $subject->offsetGet($container);
                $constants[$name]['uses'][] = $token->getLine();
                $subject->offsetSet($container, $constants);
            }
        }
    }

}
