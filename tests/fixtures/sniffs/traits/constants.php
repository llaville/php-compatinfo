<?php
trait Foo {
    public const FLAG_1 = 1;
    protected const FLAG_2 = 2;
    private const FLAG_3 = 3;

    public function doFoo(int $flags): void {
        if ($flags & self::FLAG_1) {
            echo 'Got flag 1';
        }
        if ($flags & self::FLAG_2) {
            echo 'Got flag 2';
        }
        if ($flags & self::FLAG_3) {
            echo 'Got flag 3';
        }
    }
}
