<?php
class Foo
{
    public $result;

    protected $message;
    protected $level;


    function __construct($message = 'Nothing to say', $level = E_USER_NOTICE)
    {
        $this->message = $message;
        $this->level   = $level;
    }

    function raiseError()
    {
        trigger_error($this->message, $this->level);
    }

    function something()
    {
        $this->result .= ' do intermadiate result';

        return $this;
    }

    function somethingelse()
    {
        $this->result .= ' do final result';

        return $this;
    }

}

$foo = new Foo;

echo $foo
    -> something()
    -> somethingelse ( )
    -> result;

$foo -> raiseError ();
