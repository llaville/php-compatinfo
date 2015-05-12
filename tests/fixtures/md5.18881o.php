<?php
$str = 'apple';

if (md5($str, false) === '1f3870be274f6c49b3e31a0c6728957f') {
    echo "Would you like a green or red apple?";
}
