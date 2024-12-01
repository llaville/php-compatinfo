<!-- markdownlint-disable MD013 -->
# PHP 5.4

| Sniff category  | Sniff class name              | PHP Feature                                               |
|-----------------|-------------------------------|-----------------------------------------------------------|
| Arrays          | ArrayDereferencingSyntaxSniff | [Array dereferencing][ArrayDereferencingSyntax]           |
| Arrays          | ShortArraySyntaxSniff         | [Short array syntax][ShortArraySyntax]                    |
| Classes         | ClassMemberAccessSniff        | [Class member access on instantiation][ClassMemberAccess] |
| Expressions     | ClassExprSyntaxSniff          | [Class::{expr}() syntax][ClassExprSyntax]                 |
| Numbers         | BinaryNumberFormatSniff       | [Binary number format][BinaryNumberFormat]                |
| UseDeclarations | UseTraitSniff                 | [Traits][UseTrait]                                        |
|                 | `VersionResolverVisitor`      | [Traits][UseTrait]                                        |

[ArrayDereferencingSyntax]: https://www.php.net/manual/en/migration54.new-features.php
[ShortArraySyntax]: https://www.php.net/manual/en/migration54.new-features.php
[ClassMemberAccess]: https://wiki.php.net/rfc/instance-method-call
[ClassExprSyntax]: https://www.php.net/manual/en/migration54.new-features.php
[BinaryNumberFormat]: https://www.php.net/manual/en/migration54.new-features.php
[UseTrait]: https://www.php.net/manual/en/language.oop5.traits.php
