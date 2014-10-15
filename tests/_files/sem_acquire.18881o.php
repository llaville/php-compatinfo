<?php

$key = ftok(__FILE__,'m');
$a   = sem_get($key);
sem_acquire($a, true);
