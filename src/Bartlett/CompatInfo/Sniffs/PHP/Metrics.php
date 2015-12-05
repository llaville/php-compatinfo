<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

/**
 * List of metrics available with the migration analyser
 *
 */
final class Metrics
{
    const KEYWORD_RESERVED                      = 'KeywordReserved';

    const ANONYMOUS_CLASS                       = 'AnonymousClass';
    const ANONYMOUS_FUNCTION                    = 'AnonymousFunction';
    const ANONYMOUS_FUNCTION_1                  = 'AnonymousFunction_1';
    const ANONYMOUS_FUNCTION_2                  = 'AnonymousFunction_2';
    const ANONYMOUS_FUNCTION_3                  = 'AnonymousFunction_3';

    const ARRAY_DEREFERENCING_SYNTAX            = 'ArrayDereferencingSyntax';
    const SHORT_ARRAY_SYNTAX                    = 'ShortArraySyntax';

    const BINARY_NUMBER_FORMAT                  = 'BinaryNumberFormat';

    const CLASS_EXPR_SYNTAX                     = 'ClassExprSyntax';

    const CLASS_MEMBER_ACCESS_ON_INSTANTIATION  = 'ClassMemberAccessOnInstantiation';

    const COMBINED_COMPARISON_OPERATOR          = 'CombinedComparisonOperator';

    const SHORT_OPEN_TAG                        = 'ShortOpenTag';

    const CONST_SYNTAX                          = 'ConstSyntax';
    const CONST_SYNTAX_1                        = 'ConstSyntax_1';
    const CONST_SYNTAX_2                        = 'ConstSyntax_2';

    const MAGIC_METHODS                         = 'MagicMethods';

    const DEPRECATED_FUNCTIONS                  = 'DeprecatedFunctions';
    const DEPRECATED_DIRECTIVES                 = 'DeprecatedDirectives';
    const DEPRECATED_ASSIGN_REFS                = 'DeprecatedAssignRefs';

    const INTRODUCED                            = 'Introduced';
    const REMOVED                               = 'Removed';
    const NO_COMPAT_CALL                        = 'NoCompatCall';
    const NO_COMPAT_MAGIC                       = 'NoCompatMagicMethods';
    const NO_COMPAT_BREAK                       = 'NoCompatBreakContinue';
    const NO_COMPAT_PARAM                       = 'NoCompatParam';
    const NO_COMPAT_REGISTER                    = 'NoCompatRegisterGlobals';
    const NO_COMPAT_KEYWORD                     = 'NoCompatKeywordCaseInsensitive';

    const DOC_STRING_SYNTAX                     = 'DocStringSyntax';
    const DOC_STRING_SYNTAX_1                   = 'DocStringSyntax_1';
    const DOC_STRING_SYNTAX_2                   = 'DocStringSyntax_2';
    const DOC_STRING_SYNTAX_3                   = 'DocStringSyntax_3';

    const EXPONANTIATION                        = 'Exponantiation';

    const NULL_COALESCE_OPERATOR                = 'NullCoalesceOperator';

    const RETURN_TYPE_DECLARATION               = 'ReturnTypeDeclaration';

    const USE_CONST_FUNCTION                    = 'UseConstFunction';

    const VARIADIC_FUNCTION                     = 'VariadicFunction';

    const SHORT_TERNARY_OPERATOR_SYNTAX         = 'ShortTernaryOperatorSyntax';
}
