<!-- markdownlint-disable MD013 -->
# Limitation

```php
<?php
// @link https://github.com/nikic/PHP-Parser/blob/v4.10.0/lib/PhpParser/Lexer.php#L413-L433

$compatTokens = [
    // PHP 7.4
    'T_BAD_CHARACTER',
    'T_FN',
    'T_COALESCE_EQUAL',
    // PHP 8.0
    'T_NAME_QUALIFIED',
    'T_NAME_FULLY_QUALIFIED',
    'T_NAME_RELATIVE',
    'T_MATCH',
    'T_NULLSAFE_OBJECT_OPERATOR',
    'T_ATTRIBUTE',
];

foreach ($compatTokens as $token) {
    if (\defined($token)) {
        $tokenId = \constant($token);
    }
}
```

Here we cannot detect that constants listed in `$compatTokens` array are perhaps condition code.

Later, in another script or even the same one, if we used these constants we will detect them as PHP 7.4 or PHP 8.0 versions,
but it's not the reality.

Example with

```php
<?php
// @link https://github.com/nikic/PHP-Parser/blob/v4.10.0/lib/PhpParser/Lexer.php#L110
$tokens[] = [\T_BAD_CHARACTER, $chr, $line];
```

Console output tell us

```text
Constants Analysis

    Constant                   REF       EXT min/Max PHP min/Max
    T_ABSTRACT                 tokenizer 5.0.0       5.0.0
    T_ARRAY                    tokenizer 4.2.0       4.2.0
    T_AS                       tokenizer 4.2.0       4.2.0
    T_ATTRIBUTE                user                  4.0.0
    T_BAD_CHARACTER            tokenizer 7.4.0       7.4.0beta1
    T_BREAK                    tokenizer 4.2.0       4.2.0
    ... more ...
    true                       Core      4.0.0       4.0.0
    Total [98]                                       7.4.0beta1

No condition found

Requires PHP 7.4.0beta1 (min)
```

Caution when you read such results. Until a new CompatInfo version is able to check this situation for us !
