<?php
function doSomething(string $haystack, string $needle): bool {}
doSomething(haystack: 'FooBar', needle: 'Foo');
doSomething(needle: 'Foo', haystack: 'FooBar');
