<?php
namespace Name\Space {
    use Exception;
    const FOO = 42;
    function f() { echo __FUNCTION__."\n"; }
}
namespace {
    use const Name\Space\FOO;
    use function Name\Space\f;
    echo FOO."\n";
    f();
}
