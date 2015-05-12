<?php
class RequestMaxVersion
{
    /**
     * Sample code to check max php version
     *
     * @return void
     */
    function testMaxVersion()
    {
        // PHP 5 <= 5.0.4
        $res = php_check_syntax('bug6581.php');

        $array1 = array('blue'  => 1, 'red'  => 2, 'green'  => 3);
        $array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7);

        // PHP 5 >= 5.1.0RC1
        $diff = array_diff_key($array1, $array2);
    }
}
