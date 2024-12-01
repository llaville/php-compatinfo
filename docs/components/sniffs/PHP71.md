<!-- markdownlint-disable MD013 -->
# PHP 7.1

| Sniff category       | Sniff class name           | PHP Feature                                                  |
|----------------------|----------------------------|--------------------------------------------------------------|
| FunctionDeclarations | ParamTypeDeclarationSniff  | [Nullable types][NullableTypes]                              |
| FunctionDeclarations | ReturnTypeDeclarationSniff | [Nullable types][NullableTypes]                              |
| FunctionDeclarations | ReturnTypeDeclarationSniff | [Void functions][VoidFunctions]                              |
|                      |                            | [Symmetric array destructuring][SymmetricArrayDestructuring] |
|                      |                            | [Class constant visibility][ClassConstantVisibility]         |
| FunctionDeclarations | ParamTypeDeclarationSniff  | [iterable pseudo-type][IterableType]                         |
| Keywords             | ReservedSniff              | [iterable pseudo-type][IterableType]                         |
|                      |                            | [Multi catch exception handling][MultiCatchException]        |
|                      |                            | [Support for keys in list()][SupportKeysInList]              |

[NullableTypes]: https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.nullable-types
[VoidFunctions]: https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.void-functions
[SymmetricArrayDestructuring]: https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.symmetric-array-destructuring
[ClassConstantVisibility]: https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.class-constant-visibility
[IterableType]: https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.iterable-pseudo-type
[MultiCatchException]: https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.mulit-catch-exception-handling
[SupportKeysInList]: https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.support-for-keys-in-list
