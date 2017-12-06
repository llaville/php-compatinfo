<?php

class aa {
    public static $x = "a";
    public static function check(){
        if( !empty(self::$x)) echo "ok";
    }
}

aa::check();
