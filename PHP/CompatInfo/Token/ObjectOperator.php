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
 * Implement/Replace existing OBJECT_OPERATOR token behaviors
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Token_OBJECT_OPERATOR extends PHP_Reflect_Token_OBJECT_OPERATOR
{
    public function getName()
    {
        $name = '';

        if ($this->_getContext(-1) == 'T_VARIABLE'
            || ($this->_getContext(-2) == 'T_VARIABLE'
            && $this->_getContext(-1) == 'T_WHITESPACE')
        ) {
            // try to detect method chaining

            if ($this->_getContext(+1) == 'T_STRING'
                || $this->_getContext(+2) == 'T_STRING'
            ) {
                // start of object method call
                $i = +2;
                while ($this->_getContext($i) != 'T_OPEN_CURLY'
                    && $this->_getContext($i) != 'T_SEMICOLON'
                    && $this->_getContext($i) != 'T_CLOSE_TAG'
                ) {

                    if ($this->_getContext($i) == 'T_CLOSE_BRACKET') {

                        if ($this->_getContext($i+1) == 'T_OBJECT_OPERATOR'
                            || $this->_getContext($i+2) == 'T_OBJECT_OPERATOR'
                        ) {
                            // found method chaining
                            $name = '$foo->method()->chaining()';
                            break;
                        }
                    }
                    $i++;
                }
            }
        }
        elseif ($this->_getContext(-1) == 'T_CLOSE_BRACKET'
            || $this->_getContext(-2) == 'T_CLOSE_BRACKET'
        ) {
            // try to detect class member access on instantiation
            $i = -2;
            while ($this->_getContext($i) != 'T_OPEN_TAG'
                && $this->_getContext($i) != 'T_SEMICOLON'
            ) {
                if ($this->_getContext($i) == 'T_NEW') {
                    $name = 'classMemberAccessOnInstantiation';
                    break;
                }
                $i--;
            }
        }

        return $name;
    }

    public function __toString()
    {
        return $this->getName();
    }

    private function _getContext($i)
    {
        if (($this->id + $i) > 0 && isset($this->tokenStream[$this->id+$i])) {
            return $this->tokenStream[$this->id+$i][0];
        }
        return false;
    }
}
