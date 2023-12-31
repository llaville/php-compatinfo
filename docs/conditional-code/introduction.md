<!-- markdownlint-disable MD013 -->
# Introduction

What is considered as a conditional code ?

Each time you found following functions in source code :

- [extension_loaded](https://www.php.net/manual/en/function.extension-loaded.php)
- [function_exists](https://www.php.net/manual/en/function.function-exists.php)
- [method_exists](https://www.php.net/manual/en/function.method-exists)
- [class_exists](https://www.php.net/manual/en/function.class-exists.php)
- [interface_exists](https://www.php.net/manual/en/function.interface-exists.php)
- [trait_exists](https://www.php.net/manual/en/function.trait-exists.php)
- [defined](https://www.php.net/manual/en/function.defined)

**Note** for developers, this is the `Bartlett\CompatInfo\Sniffs\Expressions\ConditionalCodeSniff` sniff that handle it !

This feature was improve since previous versions until 5.4, but has some limits you should know.

- if we detect one of these previous function, we do not compute `php.min`, `php.max`, `ext.*` version elements
to global or parent results.

That means, with this code :

```php
<?php
Class C
{
    function encode()
    {
        if (!function_exists('json_encode')) {
            function json_encode($value, $options = 0, $depth = 512) {
                // ... do something
            }
        }
    }
}
```

When we run analyser, we got this output :

```text
Data Source Analysed

Directories                                          1
Files                                                1
Errors                                               0


Extensions Analysis

    Extension REF  EXT min/Max PHP min/Max
    Core      Core 4.0.0       4.0.0
 C  json      json 5.2.0       5.2.0
    Total [2]                  4.0.0

Namespaces Analysis

    Namespace REF  EXT min/Max PHP min/Max
              Core             4.0.0
    Total [1]                  4.0.0

No interface found

No trait found

Classes Analysis

    Class     REF  EXT min/Max PHP min/Max
    C         user             4.0.0
    Total [1]                  4.0.0

No generator found

Functions Analysis

    Function             REF  EXT min/Max PHP min/Max
    C\encode\json_encode user             4.0.0
    function_exists      Core 4.0.0       4.0.0
 C  json_encode          json 5.2.0       5.2.0
    Total [3]                             4.0.0

No constant found

Conditions Analysis

    Condition                    REF  EXT min/Max PHP min/Max
    function_exists(json_encode) json 5.2.0       5.2.0
    Total [1]                                     5.2.0

Requires PHP 4.0.0 (min)
```

Each data with a `C` in front of line tell us that the code is conditional.

`json_encode` native function that come with PHP 7.2 is only used for PHP 7.2 or greater
and the user function `C\encode\json_encode` is used for PHP versions less or equal 7.1.*

This is a very simple example.
There are much more difficult situation that CompatInfo can handle, and some that we cannot !
