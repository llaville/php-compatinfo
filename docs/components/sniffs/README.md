<!-- markdownlint-disable MD013 -->
# Sniffs

Before version 5.4, PHP CompatInfo and its compatibility analyser was monolithic code.

Since version 5.4, PHP CompatInfo used a sniff architecture that simplify maintainability of existing code
and allows to extend it more easily.

Each sniff, is in charge to detect a PHP language feature.
Here is the list of features supported and their corresponding sniffs :

## [PHP 5.0](https://www.php.net/manual/en/migration50.php)

| Sniff category | Sniff class name         | PHP Feature                           |
|----------------|--------------------------|---------------------------------------|
| Classes        | MethodDeclarationSniff   | [Method Visibility][MethodVisibility] |
| Classes        | PropertyDeclarationSniff | [Properties][Properties]              |

[MethodVisibility]: https://www.php.net/manual/en/language.oop5.visibility.php#language.oop5.visiblity-methods
[Properties]: https://www.php.net/manual/en/language.oop5.properties.php

## [PHP 5.1](https://www.php.net/manual/en/migration51.php)

| Sniff category | Sniff class name  | PHP Feature                     |
|----------------|-------------------|---------------------------------|
| Classes        | MagicMethodsSniff | [Magic Methods][MagicMethods51] |

[MagicMethods51]: https://www.php.net/manual/en/language.oop5.magic.php

## [PHP 5.2](https://www.php.net/manual/en/migration52.php)

| Sniff category | Sniff class name | PHP Feature |
|----------------|------------------|-------------|
|                |                  |             |

## [PHP 5.3](https://www.php.net/manual/en/migration53.php)

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

## [PHP 5.4](https://www.php.net/manual/en/migration54.php)

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

## [PHP 5.5](https://www.php.net/manual/en/migration55.php)

| Sniff category | Sniff class name        | PHP Feature                                     |
|----------------|-------------------------|-------------------------------------------------|
| Constants      | MagicClassConstantSniff | [::class syntax][MagicClass]                    |
| Expressions    | EmptySniff              | [empty() supports arbitrary expressions][Empty] |
| Generators     | GeneratorSniff          | [Generators][Generators]                        |

[MagicClass]: https://wiki.php.net/rfc/class_name_literal_on_object
[Empty]: https://www.php.net/manual/en/migration55.new-features.php#migration55.new-features.empty
[Generators]: https://www.php.net/manual/en/language.generators.php

## [PHP 5.6](https://www.php.net/manual/en/migration56.php)

| Sniff category  | Sniff class name      | PHP Feature                                    |
|-----------------|-----------------------|------------------------------------------------|
| Classes         | MagicMethodsSniff     | [Magic Methods][MagicMethods56]                |
| Constants       | ConstSyntaxSniff      | [Contant Expressions][ConstScalar]             |
| Operators       | PowOperatorSniff      | [Exponentiation][PowOperator]                  |
| UseDeclarations | UseConstFunctionSniff | [use function and use const][UseConstFunction] |

[MagicMethods56]: https://www.php.net/manual/en/language.oop5.magic.php
[ConstScalar]: https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.const-scalar-exprs
[PowOperator]: https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation
[UseConstFunction]: https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.use

## [PHP 7.0](https://www.php.net/manual/en/migration70.php)

| Sniff category       | Sniff class name                | PHP Feature                                        |
|----------------------|---------------------------------|----------------------------------------------------|
| FunctionDeclarations | ParamTypeDeclarationSniff       | [Scalar type declarations][ScalarTypeDeclarations] |
| FunctionDeclarations | ReturnTypeDeclarationSniff      | [Return type declarations][ReturnTypeDeclarations] |
| Keywords             | ReservedSniff                   | [Scalar type declarations][ScalarTypeDeclarations] |
| Operators            | NullCoalesceOperatorSniff       | [Null coalescing operator][NullCoalesceOperator]   |
| Operators            | CombinedComparisonOperatorSniff | [Spaceship operator][SpaceshipOperator]            |
|                      |                                 | [Constant arrays using define()][DefineArray]      |
| Classes              | AnonymousClassSniff             | [Anonymous classes][AnonymousClass]                |
| Classes              | ClassMemberAccessSniff          | Class member access on cloning                     |
| ControlStructures    | DeclareSniff                    | [Declare][Declare70]                               |
| Generators           | GeneratorSniff                  | [Generator Return Expressions][GeneratorReturn]    |
| Generators           | GeneratorSniff                  | [Generator Delegation][GeneratorDelegation]        |

[ScalarTypeDeclarations]: https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.scalar-type-declarations
[ReturnTypeDeclarations]: https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.return-type-declarations
[NullCoalesceOperator]: https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.null-coalesce-op
[SpaceshipOperator]: https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.spaceship-op
[DefineArray]: https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.define-array
[AnonymousClass]: https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.anonymous-classes
[Declare70]: https://www.php.net/manual/en/control-structures.declare.php
[GeneratorReturn]: https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.generator-return-expressions
[GeneratorDelegation]: https://www.php.net/manual/en/language.generators.syntax.php#control-structures.yield.from

## [PHP 7.1](https://www.php.net/manual/en/migration71.php)

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

## [PHP 7.2](https://www.php.net/manual/en/migration72.php)

| Sniff category | Sniff class name | PHP Feature                           |
|----------------|------------------|---------------------------------------|
| Keywords       | ReservedSniff    | [New object type][ReservedKeywords72] |

[ReservedKeywords72]: https://www.php.net/manual/en/migration72.new-features.php#migration72.new-features.object-type

## [PHP 7.3](https://www.php.net/manual/en/migration73.php)

| Sniff category | Sniff class name    | PHP Feature                                          |
|----------------|---------------------|------------------------------------------------------|
| FunctionCalls  | SameSiteCookieSniff | [SetCookie accept $options argument][SameSiteCookie] |

[SameSiteCookie]: https://www.php.net/manual/en/migration73.other-changes.php#migration73.other-changes.core.setcookie

## [PHP 7.4](https://www.php.net/manual/en/migration74.php)

| Sniff category       | Sniff class name          | PHP Feature                                                                |
|----------------------|---------------------------|----------------------------------------------------------------------------|
| Arrays               | ArrayUnpackingSyntaxSniff | [Array unpacking support for numeric-keyed arrays][ArrayUnpackingSyntax74] |
| Classes              | TypedPropertySniff        | [Typed properties][TypedProperties]                                        |
| FunctionDeclarations | ArrowFunctionSniff        | [Arrow functions][ArrowFunctions]                                          |
|                      | `VersionResolverVisitor`  | [Arrow functions][ArrowFunctions]                                          |

[ArrayUnpackingSyntax74]: https://www.php.net/manual/en/migration74.new-features.php#migration74.new-features.core.unpack-inside-array
[TypedProperties]: https://www.php.net/manual/en/migration74.new-features.php#migration74.new-features.core.typed-properties
[ArrowFunctions]: https://www.php.net/manual/en/migration74.new-features.php#migration74.new-features.core.arrow-functions

## [PHP 8.0](https://www.php.net/manual/en/migration80.php)

| Sniff category       | Sniff class name              | PHP Feature                                         |
|----------------------|-------------------------------|-----------------------------------------------------|
| Attributes           | AttributeSniff                | [Attributes][Attributes]                            |
| Classes              | PropertyPromotionSniff        | [Constructor property promotion][PropertyPromotion] |
| ControlStructures    | MatchSniff                    | [Match expressions][Match]                          |
| ControlStructures    | NonCapturingCatchSniff        | [Non-capturing catches][NonCapturingCatch]          |
| FunctionDeclarations | NamedArgumentDeclarationSniff | [Named arguments][NamedArgumentDeclaration]         |
| FunctionDeclarations | ParamTypeDeclarationSniff     | [Union types][UnionTypes]                           |
| FunctionDeclarations | TrailingCommaSniff            | [Trailing comma][TrailingComma]                     |
| Operators            | NullsafeOperatorSniff         | [Nullsafe operator][NullsafeOperator]               |

[Attributes]: https://www.php.net/releases/8.0/en.php#attributes
[PropertyPromotion]: https://www.php.net/releases/8.0/en.php#constructor-property-promotion
[Match]: https://www.php.net/releases/8.0/en.php#match-expression
[NonCapturingCatch]: https://wiki.php.net/rfc/non-capturing_catches
[NamedArgumentDeclaration]: https://www.php.net/releases/8.0/en.php#named-arguments
[UnionTypes]: https://www.php.net/releases/8.0/en.php#union-types
[TrailingComma]: https://php.watch/versions/8.0/trailing-comma-parameter-use-list
[NullsafeOperator]: https://www.php.net/releases/8.0/en.php#nullsafe-operator

## [PHP 8.1](https://www.php.net/manual/en/migration81.php)

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

## [PHP 8.2](https://www.php.net/manual/en/migration82.php)

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

## [PHP 8.3](https://www.php.net/manual/en/migration83.php)

| Sniff category | Sniff class name        | PHP Feature                                 |
|----------------|-------------------------|---------------------------------------------|
| Attributes     | OverrideAttributeSniff  | [Override attribute][OverrideAttribute]     |
| Constants      | TypedClassConstantSniff | [Typed Class Constants][TypedClassConstant] |

[OverrideAttribute]: https://www.php.net/releases/8.3/en.php#override_attribute
[TypedClassConstant]: https://www.php.net/releases/8.3/en.php#typed_class_constants

## Special cases

* **Namespaces** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Classes** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Interfaces** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Traits** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Closures** are initialized by the `VersionResolverVisitor` and keywords (this, self, parent, static) are detected with `ClosureSniff`
* **Arrow functions** have no sniff, because its detected by the `VersionResolverVisitor`, but has its test case with `ArrowFunctionSniffTest`
