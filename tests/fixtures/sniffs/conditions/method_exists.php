<?php
if (method_exists('Normalizer', 'normalize')) {
    $text = Normalizer::normalize($text);
}
