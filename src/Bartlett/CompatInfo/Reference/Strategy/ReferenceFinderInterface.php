<?php

namespace Bartlett\CompatInfo\Reference\Strategy;

interface ReferenceFinderInterface
{
    public function findAny($element);
    
    public function findInterface($element);

    public function findClass($element);

    public function findFunction($element);

    public function findConstant($element);
    
    public function findIniEntry($element);
}
