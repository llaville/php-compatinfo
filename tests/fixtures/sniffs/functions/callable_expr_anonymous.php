<?php

function fromCallable(callable $callback): void
{
    $closure = $callback(...);
}
