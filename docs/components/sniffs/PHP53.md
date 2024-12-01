<!-- markdownlint-disable MD013 -->
# PHP 5.3

| Sniff category       | Sniff class name          | PHP Feature                                          |
|----------------------|---------------------------|------------------------------------------------------|
| Classes              | MagicMethodsSniff         | [Magic Methods][MagicMethods53]                      |
| Classes              | DynamicAccessSniff        | Dynamic Static Method access                         |
| Classes              | DynamicAccessSniff        | Dynamic Static Property access                       |
| ControlStructures    | DeclareSniff              | [Declare][Declare53]                                 |
| ControlStructures    | GotoSniff                 | [Goto][Goto]                                         |
| FunctionDeclarations | ClosureSniff              | [Anonymous functions][AnonymousFunctions]            |
|                      | `VersionResolverVisitor`  | [Closures][Closures]                                 |
| Operators            | ShortTernaryOperatorSniff | [Ternary Operator][ShortTernaryOperator]             |
|                      | `VersionResolverVisitor`  | [Namespaces][Namespaces]                             |
| TextProcessing       | CryptStringSniff          | [CRYPT_BLOWFISH security fix details][CryptBlowfish] |

[MagicMethods53]: https://www.php.net/manual/en/language.oop5.magic.php
[Declare53]: https://www.php.net/manual/en/control-structures.declare.php
[Goto]: https://www.php.net/manual/en/control-structures.goto.php
[AnonymousFunctions]: https://www.php.net/manual/en/functions.anonymous.php
[Closures]: https://www.php.net/manual/en/functions.anonymous.php
[ShortTernaryOperator]: https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
[Namespaces]: https://www.php.net/manual/en/language.namespaces.php
[CryptBlowfish]: https://www.php.net/security/crypt_blowfish.php
