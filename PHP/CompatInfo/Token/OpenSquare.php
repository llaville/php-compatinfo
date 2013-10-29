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
 * Implement/Replace existing OPEN_SQUARE token behaviors
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Token_OPEN_SQUARE extends PHP_Reflect_Token_OPEN_SQUARE
{
    public function getName()
    {
        $name = '';

        if ($this->_getContext(-1) == 'T_CLOSE_BRACKET'
            || ($this->_getContext(-2) == 'T_CLOSE_BRACKET'
            && $this->_getContext(-1) == 'T_WHITESPACE')
        ) {
            $name = 'arrayDereferencing';
        }

        if ($this->_getContext(-1) == 'T_EQUAL'
            || ($this->_getContext(-2) == 'T_EQUAL'
            && $this->_getContext(-1) == 'T_WHITESPACE')
        ) {
            $name = 'arrayShortSyntax';
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
