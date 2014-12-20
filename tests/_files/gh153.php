<?php
md5('foo');
if (PHP_VERSION >= '5') {
    md5('foo', true);
} else {
    md5('foo');
}
