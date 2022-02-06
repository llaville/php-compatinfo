<?php
function count_and_iterate(Iterator&\Countable $value) {
    foreach($value as $val) {}
    count($value);
}
