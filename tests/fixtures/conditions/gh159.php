<?php

mb_strtolower($text);

if (method_exists('Normalizer', 'normalize')) {
    $text = Normalizer::normalize($text);
}
