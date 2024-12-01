<!-- markdownlint-disable MD013 -->
# PHP 8.1

| Sniff category       | Sniff class name           | PHP Feature                                                               |
|----------------------|----------------------------|---------------------------------------------------------------------------|
| Arrays               | ArrayUnpackingSyntaxSniff  | [Array unpacking support for string-keyed arrays][ArrayUnpackingSyntax81] |
| Classes              | ReadonlyPropertySniff      | [Readonly Properties][ReadonlyProperty]                                   |
| Classes              | NewInitializerSniff        | [New initializers][NewInitializer]                                        |
| Constants            | ClassConstantSniff         | [Final class constants][FinalClassConstant]                               |
| Enumerations         | EnumerationSniff           | [Enumerations][Enumerations]                                              |
| Fibers               | FiberSniff                 | [Fibers][Fibers]                                                          |
| FunctionDeclarations | FirstClassCallableSniff    | [First class callable][FirstClassCallable]                                |
| FunctionDeclarations | ParamTypeDeclarationSniff  | [Pure Intersection Types][PureIntersectionTypes]                          |
| FunctionDeclarations | ReturnTypeDeclarationSniff | [Pure Intersection Types][PureIntersectionTypes]                          |
| FunctionDeclarations | ReturnTypeDeclarationSniff | [Never return type][NeverReturnType]                                      |
| Numbers              | OctalNumberFormatSniff     | [Explicit Octal numeral notation][OctalNumberFormat]                      |

[ArrayUnpackingSyntax81]: https://www.php.net/releases/8.1/en.php#array_unpacking_support_for_string_keyed_arrays
[ReadonlyProperty]: https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.readonly-properties
[NewInitializer]: https://www.php.net/manual/en/migration81.new-features.php#migration81.new-features.core.new-in-initializer
[FinalClassConstant]: https://www.php.net/releases/8.1/en.php#final_class_constants
[Enumerations]: https://www.php.net/manual/en/migration81.new-features.php#migration81.new-features.core.enums
[Fibers]: https://www.php.net/releases/8.1/en.php#fibers
[FirstClassCallable]: https://www.php.net/manual/en/functions.first_class_callable_syntax.php
[PureIntersectionTypes]: https://www.php.net/releases/8.1/en.php#pure_intersection_types
[NeverReturnType]: https://www.php.net/releases/8.1/en.php#never_return_type
[OctalNumberFormat]: https://www.php.net/releases/8.1/en.php#explicit_octal_numeral_notation
