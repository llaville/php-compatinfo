<!-- markdownlint-disable MD013 -->
# Indirect calls

By indirect calls, CompatInfo is unable (yet) to resolve such type of code.

```php
$ext = 'intl';

if (extension_loaded($ext)) {
    // ... do something
}
```

`extension_loaded` is well detected but not the extension name.

