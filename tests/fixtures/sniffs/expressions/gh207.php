<?php
function always_false() {
    return false;
}

if (empty(always_false())) {
    echo "This will be printed.\n";
}

if (empty(true)) {
    echo "This will not be printed.\n";
}

function foo() {}
