<?php

namespace Bartlett\CompatInfo\Reference;

interface ReferenceInterface
{
    public function getCurrentVersion();
    
    public function getLatestVersion();

    public function getReleases();

    public function getInterfaces();

    public function getClasses();

    public function getFunctions();

    public function getConstants();

    public function getIniEntries();

    public function getClassConstants();

    public function getClassStaticMethods();

    public function getClassMethods();
}
