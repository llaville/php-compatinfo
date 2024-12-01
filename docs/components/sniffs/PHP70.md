<!-- markdownlint-disable MD013 -->
# PHP 7.0

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
