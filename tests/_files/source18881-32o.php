<?php
$text = "April fools day is 04/01/2002\n";
$text.= "Last christmas was 12/24/2001\n";

function next_year($matches)
{
    return $matches[1].($matches[2]+1);
}
echo preg_replace_callback(
    "|(\d{2}/\d{2}/)(\d{4})|",
    "next_year",
    $text,
    -1,
    $count
);
echo $count;
