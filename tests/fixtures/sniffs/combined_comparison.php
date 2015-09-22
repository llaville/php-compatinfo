<?php
function order_func($a, $b) {
    return [$a->x, $a->y, $a->foo] <=> [$b->x, $b->y, $b->foo];
}
