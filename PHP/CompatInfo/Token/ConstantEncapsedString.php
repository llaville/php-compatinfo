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
 * implement/replace existing CONSTANT_ENCAPSED_STRING token behaviors
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Token_CONSTANT_ENCAPSED_STRING extends PHP_Reflect_Token_CONSTANT_ENCAPSED_STRING
{
    protected $name;
    protected $type;

    public function getName()
    {
        if ($this->name !== NULL) {
            return $this->name;
        }

        for ($i = $this->id - 1; $i > $this->id - 5; $i -= 1) {
            if (isset($this->tokenStream[$i]) &&
                $this->tokenStream[$i][0] == 'T_STRING' &&
                in_array(strtolower($this->tokenStream[$i][1]), array('define', 'defined', 'constant'))
            ) {
                $this->type = 'constant';
                $this->name = trim($this->tokenStream[$this->id][1], "'\"");
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
