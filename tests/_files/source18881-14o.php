<?php
// print all the page starting at the offset 10
echo stream_get_contents($stream, -1, 10);
