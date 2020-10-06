
## Multiple signatures

Face to this source code, CompatInfo is unable to know what `idn_to_ascii` signature is the minimum.

```php
if (function_exists('idn_to_ascii')) {
    if (defined('INTL_IDNA_VARIANT_UTS46')) {
        $domain = idn_to_ascii($domain, 0, INTL_IDNA_VARIANT_UTS46);
    } else {
        $domain = idn_to_ascii($domain);
    }
}
```

We know ([idn_to_ascii changelog](https://www.php.net/manual/en/function.idn-to-ascii.php#refsect1-function.idn-to-ascii-changelog))
that by using `$variant` parameter, the minimum PHP version required is **7.4.0**, otherwise it's only **5.2.4**

So the console output look like
```
Data Source Analysed

Directories                                          1
Files                                                1
Errors                                               0


Extensions Analysis

    Extension REF  EXT min/Max PHP min/Max
    Core      Core 4.0.0       4.0.0
 C  intl      intl 2.0.0b1     5.2.4
    Total [2]                  4.0.0

Namespaces Analysis

    Namespace REF  EXT min/Max PHP min/Max
              Core             4.0.0
    Total [1]                  4.0.0

No interface found

No trait found

No class found

No generator found

Functions Analysis

    Function        REF  EXT min/Max PHP min/Max
    defined         Core 4.0.0       4.0.0
    function_exists Core 4.0.0       4.0.0
 C  idn_to_ascii    intl 1.0.2       5.2.4
    Total [3]                        4.0.0

Constants Analysis

    Constant                REF  EXT min/Max PHP min/Max
 C  INTL_IDNA_VARIANT_UTS46 intl 2.0.0b1     5.2.4
    Total [1]                                4.0.0

Conditions Analysis

    Condition                        REF  EXT min/Max PHP min/Max
    defined(INTL_IDNA_VARIANT_UTS46) intl 2.0.0b1     5.2.4
    function_exists(idn_to_ascii)    intl 1.0.2       5.2.4
    Total [2]                                         5.2.4

Requires PHP 4.0.0 (min)
```
