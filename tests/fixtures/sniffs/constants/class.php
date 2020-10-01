<?php
namespace Foo {
    class Bar
    {
    }
}

namespace {
    echo \Foo\Bar::class . PHP_EOL;
}
