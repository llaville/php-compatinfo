<?php
/**
 * Migration Analyser
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Analyser;

use Bartlett\CompatInfo\Sniffs;

use Bartlett\Reflect\Analyser\AbstractSniffAnalyser;

/**
 * This analyzer collects different metrics to find out :
 * - keywords reserved
 * - deprecated elements
 * - removed elements
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 5.0.0
 */
class MigrationAnalyser extends AbstractSniffAnalyser
{
    /**
     * Initializes the migration analyser
     */
    public function __construct()
    {
        $this->sniffs = array(
            new Sniffs\PHP\IntroducedSniff(),
            new Sniffs\PHP\RemovedSniff(),
            new Sniffs\PHP\KeywordReservedSniff(),
            new Sniffs\PHP\DeprecatedSniff(),
            new Sniffs\PHP\RemovedSniff(),
            new Sniffs\PHP\ShortOpenTagSniff(),
            new Sniffs\PHP\ShortArraySyntaxSniff(),
            new Sniffs\PHP\ArrayDereferencingSyntaxSniff(),
            new Sniffs\PHP\ClassMemberAccessOnInstantiationSniff(),
            new Sniffs\PHP\ConstSyntaxSniff(),
            new Sniffs\PHP\MagicMethodsSniff(),
            new Sniffs\PHP\AnonymousFunctionSniff(),
            new Sniffs\PHP\NullCoalesceOperatorSniff(),
            new Sniffs\PHP\VariadicFunctionSniff(),
            new Sniffs\PHP\UseConstFunctionSniff(),
            new Sniffs\PHP\ExponantiationSniff(),
            new Sniffs\PHP\DocStringSyntaxSniff(),
            new Sniffs\PHP\ClassExprSyntaxSniff(),
            new Sniffs\PHP\BinaryNumberFormatSniff(),
            new Sniffs\PHP\CombinedComparisonOperatorSniff(),
            new Sniffs\PHP\ReturnTypeDeclarationSniff(),
            new Sniffs\PHP\AnonymousClassSniff(),
            new Sniffs\PHP\ShortTernaryOperatorSyntaxSniff(),
            new Sniffs\PHP\NoCompatCallFromGlobalSniff(),
            new Sniffs\PHP\NoCompatMagicMethodsSniff(),
            new Sniffs\PHP\NoCompatBreakContinueSniff(),
            new Sniffs\PHP\NoCompatParamSniff(),
            new Sniffs\PHP\NoCompatRegisterGlobalsSniff(),
            new Sniffs\PHP\NoCompatKeywordCaseInsensitiveSniff(),
        );
    }
}
