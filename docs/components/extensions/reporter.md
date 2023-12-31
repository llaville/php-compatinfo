<!-- markdownlint-disable MD013 -->
# Output format

[Since version 6.1.0](https://github.com/llaville/php-compatinfo/issues/312),
PHP CompatInfo supports different output formats through various formatters.

You can pass the following keywords to the `--output` CLI option of the `analyser:run` command
in order to affect the output:

- `console`: default table format for human reading.
- `dump`: raw format (`var_dump`) for debugging purpose only.
- `json`: creates minified json file format output without whitespaces.
- `sarif`: creates a **S**tatic **A**nalysis **R**esults **I**nterchange **F**ormat to share results with other tools or applications

You can also implement your own custom formatter by implementing
the `Bartlett\CompatInfo\Application\Extension\Reporter\FormatterInterface` interface in a new class.

This is how the `FormatterInterface` interface looks like:

```php
<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Extension\Reporter;

interface FormatterInterface
{
    /**
     * @param object $object
     * @param string[] $formats
     * @return bool
     */
    public function supportsFormatting(object $object, array $formats): bool;

    /**
     * @param mixed $data Data to format
     * @return void
     */
    public function format($data): void;
}
```

Before you can start using your custom output formatter, you have to include it in a new class that implement
the `Bartlett\CompatInfo\Application\Extension\ExtensionInterface` interface (see [Registering Extensions](README.md) chapter for details).

`ConsoleReporter` is a good first example to follow.
