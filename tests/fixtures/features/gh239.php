<?php

// see https://wiki.php.net/rfc/short_list_syntax  PHP RFC: Square bracket syntax for array destructuring assignment
// requires PHP 7.1

class foo
{
    const BAZ = [1,15,0];
    public function bar()
    {
        [ $page, $perpage, $start ] = static::BAZ;
    }
}
