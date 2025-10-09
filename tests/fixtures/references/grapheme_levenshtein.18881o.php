<?php
// @link https://github.com/llaville/php-compatinfo-db/commit/420a0df9e4f68b8e5595121c1f010101367ce138
// @link https://github.com/php/php-src/blob/ad75c260442d93dc0aeb6857407387d4f871b5d6/ext/intl/tests/grapheme_levenshtein.phpt

var_dump(grapheme_levenshtein(str_repeat("a", 128), str_repeat("a", 125) . "abc", 1, 1, 1, 'en_US'));
