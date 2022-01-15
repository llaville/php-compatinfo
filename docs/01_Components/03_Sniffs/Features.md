<!-- markdownlint-disable MD013 -->
# Sniffs

Before version 5.4, PHP CompatInfo and its compatibility analyser was monolithic code.

Since version 5.4, PHP CompatInfo used a sniff architecture that simplify maintainability of existing code
and allows to extend it more easily.

Each sniff, is in charge to detect a PHP language feature.
Here is the list of features supported and their corresponding sniffs :

## [PHP 5.0](https://www.php.net/manual/en/migration50.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| Classes  | MethodDeclarationSniff  | [Method Visibility](https://www.php.net/manual/en/language.oop5.visibility.php#language.oop5.visiblity-methods) |
| Classes  | PropertyDeclarationSniff  | [Properties](https://www.php.net/manual/en/language.oop5.properties.php) |

## [PHP 5.1](https://www.php.net/manual/en/migration51.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| Classes  | MagicMethodsSniff  | [Magic Methods](https://www.php.net/manual/en/language.oop5.magic.php) |

## [PHP 5.2](https://www.php.net/manual/en/migration52.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
|   |   |   |

## [PHP 5.3](https://www.php.net/manual/en/migration53.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| Classes  | MagicMethodsSniff  | [Magic Methods](https://www.php.net/manual/en/language.oop5.magic.php) |
| ControlStructures    | DeclareSniff | [declare](https://www.php.net/manual/en/control-structures.declare.php) |
| ControlStructures    | GotoSniff    | [goto](https://www.php.net/manual/en/control-structures.goto.php) |
| FunctionDeclarations | ClosureSniff | [Anonymous functions](https://www.php.net/manual/en/functions.anonymous.php) |
|   | `VersionResolverVisitor`        | [Closures](https://www.php.net/manual/en/functions.anonymous.php) |
| Operators  | ShortTernaryOperatorSniff  | [Ternary Operator](https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary) |
|   | `VersionResolverVisitor`            | [Namespaces](https://www.php.net/manual/en/language.namespaces.php) |
| TextProcessing | CryptStringSniff  | [CRYPT_BLOWFISH security fix details](https://www.php.net/security/crypt_blowfish.php) |

## [PHP 5.4](https://www.php.net/manual/en/migration54.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| Arrays  | ArrayDereferencingSyntaxSniff | [Array dereferencing](https://www.php.net/manual/en/migration54.new-features.php) |
| Arrays  | ShortArraySyntaxSniff         | [Short array syntax](https://www.php.net/manual/en/migration54.new-features.php) |
| Classes | ClassMemberAccessSniff | [Class member access on instantiation](https://wiki.php.net/rfc/instance-method-call) |
| Expressions | ClassExprSyntaxSniff | [Class::{expr}() syntax](https://www.php.net/manual/en/migration54.new-features.php) |
| Numbers     | BinaryNumberFormatSniff  | [Binary number format](https://www.php.net/manual/en/migration54.new-features.php) |
| UseDeclarations | UseTraitSniff  | [Traits](https://www.php.net/manual/en/language.oop5.traits.php) |
|   | `VersionResolverVisitor`     | [Traits](https://www.php.net/manual/en/language.oop5.traits.php) |

## [PHP 5.5](https://www.php.net/manual/en/migration55.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| Constants   | MagicClassConstantSniff  | [::class syntax](https://wiki.php.net/rfc/class_name_literal_on_object) |
| Expressions | EmptySniff               | [empty() supports arbitrary expressions](https://www.php.net/manual/en/migration55.new-features.php#migration55.new-features.empty) |
| Generators  | GeneratorSniff           | [Generators](https://www.php.net/manual/en/language.generators.php) |

## [PHP 5.6](https://www.php.net/manual/en/migration56.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| Classes         | MagicMethodsSniff      | [Magic Methods](https://www.php.net/manual/en/language.oop5.magic.php) |
| Constants       | ConstSyntaxSniff       | [Contant Expressions](https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.const-scalar-exprs) |
| Operators       | PowOperatorSniff       | [Exponentiation](https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation) |
| UseDeclarations | UseConstFunctionSniff  | [use function and use const](https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.use) |

## [PHP 7.0](https://www.php.net/manual/en/migration70.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| FunctionDeclarations | ParamTypeDeclarationSniff  | [Scalar type declarations](https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.scalar-type-declarations) |
| FunctionDeclarations | ReturnTypeDeclarationSniff | [Return type declarations](https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.return-type-declarations) |
| Keywords             | ReservedSniff              | [Scalar type declarations](https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.scalar-type-declarations) |
| Operators            | NullCoalesceOperatorSniff  | [Null coalescing operator](https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.null-coalesce-op) |
| Operators            | CombinedComparisonOperatorSniff | [Spaceship operator](https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.spaceship-op) |
| | | [Constant arrays using define()](https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.define-array) |
| Classes | AnonymousClassSniff      | [Anonymous classes](https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.anonymous-classes) |
| Classes | ClassMemberAccessSniff   | Class member access on cloning |
| ControlStructures  | DeclareSniff  | [declare](https://www.php.net/manual/en/control-structures.declare.php) |
| Generators  | GeneratorSniff       | [Generator Return Expressions](https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.generator-return-expressions) |
| Generators  | GeneratorSniff       | [Generator Delegation](https://www.php.net/manual/en/language.generators.syntax.php#control-structures.yield.from) |

## [PHP 7.1](https://www.php.net/manual/en/migration71.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| FunctionDeclarations  | ParamTypeDeclarationSniff  | [Nullable types](https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.nullable-types) |
| FunctionDeclarations  | ReturnTypeDeclarationSniff | [Nullable types](https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.nullable-types) |
| FunctionDeclarations  | ReturnTypeDeclarationSniff | [Void functions](https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.void-functions) |
|   |   | [Symmetric array destructuring](https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.symmetric-array-destructuring) |
|   |   | [Class constant visibility](https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.class-constant-visibility) |
| FunctionDeclarations  | ParamTypeDeclarationSniff  | [iterable pseudo-type](https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.iterable-pseudo-type) |
| Keywords              | ReservedSniff              | [iterable pseudo-type](https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.iterable-pseudo-type) |
|   |   | [Multi catch exception handling](https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.mulit-catch-exception-handling) |
|   |   | [Support for keys in list()](https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.support-for-keys-in-list) |

## [PHP 7.2](https://www.php.net/manual/en/migration72.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| Keywords  | ReservedSniff  | [New object type](https://www.php.net/manual/en/migration72.new-features.php#migration72.new-features.object-type) |

## [PHP 7.3](https://www.php.net/manual/en/migration73.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
|   |   |   |

## [PHP 7.4](https://www.php.net/manual/en/migration74.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| Classes  | TypedPropertySniff  | [Typed properties](https://www.php.net/manual/en/migration74.new-features.php#migration74.new-features.core.typed-properties) |
|   | `VersionResolverVisitor`   | [Arrow functions](https://www.php.net/manual/en/migration74.new-features.php#migration74.new-features.core.arrow-functions) |

## [PHP 8.1](https://www.php.net/manual/en/migration81.php)

| Sniff category | Sniff class name | PHP Feature |
|---|---|---|
| Arrays   | ArrayUnpackingSyntaxSniff | [Array unpacking support for string-keyed arrays](https://www.php.net/releases/8.1/en.php#array_unpacking_support_for_string_keyed_arrays) |
| Classes      | ReadonlyPropertySniff | [Readonly Properties](https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.readonly-properties) |
| Classes      | NewInitializerSniff   | [New initializers](https://www.php.net/manual/en/migration81.new-features.php#migration81.new-features.core.new-in-initializer) |
| Constants    | ClassConstantSniff    | [Final class constants](https://www.php.net/releases/8.1/en.php#final_class_constants) |
| Enumerations | EnumerationSniff | [Enumerations](https://www.php.net/manual/en/migration81.new-features.php#migration81.new-features.core.enums) |
| Fibers       | FiberSniff | [Fibers](https://www.php.net/releases/8.1/en.php#fibers) |
| FunctionDeclarations | FirstClassCallableSniff | [First class callable](https://www.php.net/manual/en/functions.first_class_callable_syntax.php) |
| FunctionDeclarations | ParamTypeDeclarationSniff  | [Pure Intersection Types](https://www.php.net/releases/8.1/en.php#pure_intersection_types) |
| FunctionDeclarations | ReturnTypeDeclarationSniff | [Pure Intersection Types](https://www.php.net/releases/8.1/en.php#pure_intersection_types) |
| FunctionDeclarations | ReturnTypeDeclarationSniff | [Never return type](https://www.php.net/releases/8.1/en.php#never_return_type) |
| Numbers | OctalNumberFormatSniff | [Explicit Octal numeral notation](https://www.php.net/releases/8.1/en.php#explicit_octal_numeral_notation) |

## Special cases

* **Namespaces** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Classes** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Interfaces** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Traits** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Closures** are initialized by the `VersionResolverVisitor` and keywords (this, self, parent, static) are detected with `ClosureSniff`
* **Arrow functions** have no sniff, because its detected by the `VersionResolverVisitor`, but has its test case with `ArrowFunctionSniffTest`
