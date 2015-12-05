<?php

class Test
{
    const CLASS_CONSTANT = 'test class const value';

    protected $foo = 'foo';

    public function baz()
    {
        // Get a reference to $this
        $self = &$this;
        $func = function () use ($self) {
            // PHP 5.3 compatible
            echo $self::CLASS_CONSTANT;
            echo $self->foo;

            // PHP 5.4 alpha1 or better only
            echo self::CLASS_CONSTANT;
            echo $this->foo;
        };
    }
}

$greet = function($name)
{
    printf("Hello %s\r\n", $name);
};

$greet('World');
