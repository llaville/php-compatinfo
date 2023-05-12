<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @since Release 6.1.0
 * @author Laurent Laville
 */

function dataSource(): Generator
{
    $classes = [
        \Bartlett\CompatInfo\Application\Sniffs\Arrays\ArrayDereferencingSyntaxSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Arrays\ShortArraySyntaxSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\Classes\AnonymousClassSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Classes\ClassMemberAccessSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Classes\MagicMethodsSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Classes\MethodDeclarationSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Classes\PropertyDeclarationSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Classes\TypedPropertySniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\Constants\ClassConstantSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Constants\ConstSyntaxSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Constants\MagicClassConstantSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\ControlStructures\DeclareSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\ControlStructures\GotoSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\Expressions\ClassExprSyntaxSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Expressions\ConditionalCodeSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Expressions\EmptySniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\FunctionCalls\SameSiteCookieSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\ClosureSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\ParamTypeDeclarationSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\ReturnTypeDeclarationSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\Generators\GeneratorSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\Keywords\ReservedSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\Numbers\BinaryNumberFormatSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\Operators\CombinedComparisonOperatorSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Operators\NullCoalesceOperatorSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Operators\PowOperatorSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\Operators\ShortTernaryOperatorSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\TextProcessing\CryptStringSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\UseDeclarations\UseConstFunctionSniff::class,
        \Bartlett\CompatInfo\Application\Sniffs\UseDeclarations\UseTraitSniff::class,

        \Bartlett\CompatInfo\Application\Sniffs\KeywordBag::class,
        \Bartlett\CompatInfo\Application\Sniffs\SniffAbstract::class,
        \Bartlett\CompatInfo\Application\Sniffs\SniffInterface::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
}
