<?php
class MethodReflection
{
    public function getParameters()
    {
        return new ArrayObject(array($this->getA()->getB()));
    }
}
