<?php
$ent = __FILE__;
echo $ent . ' (SHA1: ' . sha1_file($ent, false) . ')';
