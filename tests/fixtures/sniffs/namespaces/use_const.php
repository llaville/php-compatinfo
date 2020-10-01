<?php

namespace Name\Space {
    const FOO = 42;
}

namespace Other\Name\Space {
    use const Name\Space\FOO;

    echo FOO . PHP_EOL;
}
