<?php

namespace Name\Space {
    function f() { echo __FUNCTION__ . PHP_EOL; }
}

namespace Other\Name\Space {
    use function Name\Space\f;

    f();
}
