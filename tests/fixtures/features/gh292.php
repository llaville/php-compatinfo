<?php

/**
 * Pick up partial code
 * from https://github.com/FriendsOfPHP/proxy-manager-lts/blob/1.x/tests/ProxyManagerTestAsset/ClassWithPhp80TypedMethods.php
 */

namespace ProxyManagerTestAsset;

class ClassWithPhp80TypedMethods
{
    /** Note: the false type cannot be used standalone, and must be part of a union type */
    public function falseType(false|self $parameter): false|self
    {
    }
}
