<?php
if (trait_exists('Foo')) {
    class Bar {
        use \Foo;
    }
}
