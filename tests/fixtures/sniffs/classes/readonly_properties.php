<?php
class Test {
    public readonly string $prop;

    public function __construct(string $prop) {
        // Legal initialization.
        $this->prop = $prop;
    }
}
