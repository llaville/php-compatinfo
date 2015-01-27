#!/usr/bin/env php
<?php
/**
 * Credits to Sebastian Bergmann (original author)
 */
print 'bartlett/php-compatinfo: <info>';

$tag = @exec('git describe --tags 2>&1');

if (strpos($tag, '-') === false && strpos($tag, 'No names found') === false) {
    print $tag;
} else {
    $branch = @exec('git rev-parse --abbrev-ref HEAD');
    $hash   = @exec('git log -1 --format="%H"');
    print $branch . '@' . $hash;
}

print "</info>\n";

$lock = json_decode(file_get_contents(__DIR__ . '/composer.lock'));

foreach ($lock->packages as $package) {
    print $package->name . ': <info>' . $package->version;

    if (!preg_match('/^[v= ]*(([0-9]+)(\\.([0-9]+)(\\.([0-9]+)(-([0-9]+))?(-?([a-zA-Z-+][a-zA-Z0-9\\.\\-:]*)?)?)?)?)$/', $package->version)) {
        print '@' . $package->source->reference;
    }

    print "</info>\n";
}
