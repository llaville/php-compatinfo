<?php
class Foo implements Serializable
{
    public function serialize() {}

    public function unserialize($serialized) {}
}
