<!-- markdownlint-disable MD013 -->
# PHP 5.5

| Sniff category | Sniff class name        | PHP Feature                                     |
|----------------|-------------------------|-------------------------------------------------|
| Constants      | MagicClassConstantSniff | [::class syntax][MagicClass]                    |
| Expressions    | EmptySniff              | [empty() supports arbitrary expressions][Empty] |
| Generators     | GeneratorSniff          | [Generators][Generators]                        |

[MagicClass]: https://wiki.php.net/rfc/class_name_literal_on_object
[Empty]: https://www.php.net/manual/en/migration55.new-features.php#migration55.new-features.empty
[Generators]: https://www.php.net/manual/en/language.generators.php
