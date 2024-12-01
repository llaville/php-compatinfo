<!-- markdownlint-disable MD013 -->
# PHP 8.2

| Sniff category       | Sniff class name                             | PHP Feature                                                                             |
|----------------------|----------------------------------------------|-----------------------------------------------------------------------------------------|
| Attributes           | AllowDynamicPropertiesAttributeSniff         | [AllowDynamicProperties attribute][AllowDynamicPropertiesAttribute]                     |
| Attributes           | SensitiveParameterAttributeSniff             | [SensitiveParameter attribute][SensitiveParameterAttribute]                             |
| Classes              | ReadonlyClassSniff                           | [Readonly Classes][ReadonlyClass]                                                       |
| Constants            | ConstantsInTraitsSniff                       | [Constants in Traits][ConstantsInTraits]                                                |
| FunctionDeclarations | ParamTypeDeclarationSniff                    | [Disjunctive Normal Form Types][DisjunctiveNormalFormTypes]                             |
| FunctionDeclarations | ReturnTypeDeclarationSniff                   | [Allow null, false, and true as stand-alone types][AllowNullFalseTrueAsStandaloneTypes] |
| TextProcessing       | DeprecateDollarBraceStringInterpolationSniff | [Deprecated \${} string interpolation][DeprecateDollarBraceStringInterpolation]         |

[AllowDynamicPropertiesAttribute]: https://www.php.net/manual/en/class.allow-dynamic-properties.php
[SensitiveParameterAttribute]: https://www.php.net/manual/en/class.sensitive-parameter.php
[ReadonlyClass]: https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.class.readonly
[ConstantsInTraits]: https://www.php.net/manual/en/migration82.new-features.php#migration82.new-features.core.constant-in-traits
[DisjunctiveNormalFormTypes]: https://www.php.net/manual/en/migration82.new-features.php#migration82.new-features.core.type-system
[AllowNullFalseTrueAsStandaloneTypes]: https://wiki.php.net/rfc/true-type
[DeprecateDollarBraceStringInterpolation]: https://wiki.php.net/rfc/deprecate_dollar_brace_string_interpolation
