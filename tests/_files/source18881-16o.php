<?php
$text = 'This is a test';

// the text is reduced to 's i', so it prints 0
echo substr_count($text, 'is', 3, 3);
