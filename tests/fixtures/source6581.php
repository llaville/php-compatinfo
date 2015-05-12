<?php
$nb = bcsub(1.234, 5, 4);
if (preg_match('/^-/', $nb)) {
    echo 'minus';
}
