<?php
/**
 * Version informations about tokenizer extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about tokenizer extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.tokenizer.php
 */
class PHP_CompatInfo_Reference_Tokenizer
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'tokenizer';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '0.1';

    /**
     * Gets informations about extensions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null, $condition = null)
    {
        $phpMin = '4.2.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.tokenizer.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'token_get_all'                  => array('4.2.0', ''),
            'token_name'                     => array('4.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/tokens.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'T_REQUIRE_ONCE'                 => array('4.2.0', ''),
            'T_REQUIRE'                      => array('4.2.0', ''),
            'T_EVAL'                         => array('4.2.0', ''),
            'T_INCLUDE_ONCE'                 => array('4.2.0', ''),
            'T_INCLUDE'                      => array('4.2.0', ''),
            'T_LOGICAL_OR'                   => array('4.2.0', ''),
            'T_LOGICAL_XOR'                  => array('4.2.0', ''),
            'T_LOGICAL_AND'                  => array('4.2.0', ''),
            'T_PRINT'                        => array('4.2.0', ''),
            'T_SR_EQUAL'                     => array('4.2.0', ''),
            'T_SL_EQUAL'                     => array('4.2.0', ''),
            'T_XOR_EQUAL'                    => array('4.2.0', ''),
            'T_OR_EQUAL'                     => array('4.2.0', ''),
            'T_AND_EQUAL'                    => array('4.2.0', ''),
            'T_MOD_EQUAL'                    => array('4.2.0', ''),
            'T_CONCAT_EQUAL'                 => array('4.2.0', ''),
            'T_DIV_EQUAL'                    => array('4.2.0', ''),
            'T_MUL_EQUAL'                    => array('4.2.0', ''),
            'T_MINUS_EQUAL'                  => array('4.2.0', ''),
            'T_PLUS_EQUAL'                   => array('4.2.0', ''),
            'T_BOOLEAN_OR'                   => array('4.2.0', ''),
            'T_BOOLEAN_AND'                  => array('4.2.0', ''),
            'T_IS_NOT_IDENTICAL'             => array('4.2.0', ''),
            'T_IS_IDENTICAL'                 => array('4.2.0', ''),
            'T_IS_NOT_EQUAL'                 => array('4.2.0', ''),
            'T_IS_EQUAL'                     => array('4.2.0', ''),
            'T_IS_GREATER_OR_EQUAL'          => array('4.2.0', ''),
            'T_IS_SMALLER_OR_EQUAL'          => array('4.2.0', ''),
            'T_SR'                           => array('4.2.0', ''),
            'T_SL'                           => array('4.2.0', ''),
            'T_BOOL_CAST'                    => array('4.2.0', ''),
            'T_OBJECT_CAST'                  => array('4.2.0', ''),
            'T_ARRAY_CAST'                   => array('4.2.0', ''),
            'T_STRING_CAST'                  => array('4.2.0', ''),
            'T_DOUBLE_CAST'                  => array('4.2.0', ''),
            'T_INT_CAST'                     => array('4.2.0', ''),
            'T_DEC'                          => array('4.2.0', ''),
            'T_INC'                          => array('4.2.0', ''),
            'T_NEW'                          => array('4.2.0', ''),
            'T_EXIT'                         => array('4.2.0', ''),
            'T_IF'                           => array('4.2.0', ''),
            'T_ELSEIF'                       => array('4.2.0', ''),
            'T_ELSE'                         => array('4.2.0', ''),
            'T_ENDIF'                        => array('4.2.0', ''),
            'T_LNUMBER'                      => array('4.2.0', ''),
            'T_DNUMBER'                      => array('4.2.0', ''),
            'T_STRING'                       => array('4.2.0', ''),
            'T_STRING_VARNAME'               => array('4.2.0', ''),
            'T_VARIABLE'                     => array('4.2.0', ''),
            'T_NUM_STRING'                   => array('4.2.0', ''),
            'T_INLINE_HTML'                  => array('4.2.0', ''),
            'T_CHARACTER'                    => array('4.2.0', ''),
            'T_BAD_CHARACTER'                => array('4.2.0', ''),
            'T_ENCAPSED_AND_WHITESPACE'      => array('4.2.0', ''),
            'T_CONSTANT_ENCAPSED_STRING'     => array('4.2.0', ''),
            'T_ECHO'                         => array('4.2.0', ''),
            'T_DO'                           => array('4.2.0', ''),
            'T_WHILE'                        => array('4.2.0', ''),
            'T_ENDWHILE'                     => array('4.2.0', ''),
            'T_FOR'                          => array('4.2.0', ''),
            'T_ENDFOR'                       => array('4.2.0', ''),
            'T_FOREACH'                      => array('4.2.0', ''),
            'T_ENDFOREACH'                   => array('4.2.0', ''),
            'T_DECLARE'                      => array('4.2.0', ''),
            'T_ENDDECLARE'                   => array('4.2.0', ''),
            'T_AS'                           => array('4.2.0', ''),
            'T_SWITCH'                       => array('4.2.0', ''),
            'T_ENDSWITCH'                    => array('4.2.0', ''),
            'T_CASE'                         => array('4.2.0', ''),
            'T_DEFAULT'                      => array('4.2.0', ''),
            'T_BREAK'                        => array('4.2.0', ''),
            'T_CONTINUE'                     => array('4.2.0', ''),
            'T_FUNCTION'                     => array('4.2.0', ''),
            'T_CONST'                        => array('4.2.0', ''),
            'T_RETURN'                       => array('4.2.0', ''),
            'T_GLOBAL'                       => array('4.2.0', ''),
            'T_STATIC'                       => array('4.2.0', ''),
            'T_VAR'                          => array('4.2.0', ''),
            'T_UNSET'                        => array('4.2.0', ''),
            'T_ISSET'                        => array('4.2.0', ''),
            'T_EMPTY'                        => array('4.2.0', ''),
            'T_CLASS'                        => array('4.2.0', ''),
            'T_EXTENDS'                      => array('4.2.0', ''),
            'T_OBJECT_OPERATOR'              => array('4.2.0', ''),
            'T_DOUBLE_ARROW'                 => array('4.2.0', ''),
            'T_LIST'                         => array('4.2.0', ''),
            'T_ARRAY'                        => array('4.2.0', ''),
            'T_CLASS_C'                      => array('4.3.0', ''),
            'T_FUNC_C'                       => array('4.3.0', ''),
            'T_LINE'                         => array('4.2.0', ''),
            'T_FILE'                         => array('4.2.0', ''),
            'T_COMMENT'                      => array('4.2.0', ''),
            'T_DOC_COMMENT'                  => array('4.2.0', ''),
            'T_ML_COMMENT'                   => array('4.2.0', '4.4.9'),
            'T_OLD_FUNCTION'                 => array('4.2.0', '4.4.9'),
            'T_OPEN_TAG'                     => array('4.2.0', ''),
            'T_OPEN_TAG_WITH_ECHO'           => array('4.2.0', ''),
            'T_CLOSE_TAG'                    => array('4.2.0', ''),
            'T_WHITESPACE'                   => array('4.2.0', ''),
            'T_START_HEREDOC'                => array('4.2.0', ''),
            'T_END_HEREDOC'                  => array('4.2.0', ''),
            'T_DOLLAR_OPEN_CURLY_BRACES'     => array('4.2.0', ''),
            'T_CURLY_OPEN'                   => array('4.2.0', ''),
            'T_PAAMAYIM_NEKUDOTAYIM'         => array('4.2.0', ''),
            'T_DOUBLE_COLON'                 => array('4.2.0', ''),
            'T_ABSTRACT'                     => array('5.0.0', ''),
            'T_CALLABLE'                     => array('5.4.0', ''),
            'T_CATCH'                        => array('5.0.0', ''),
            'T_CLONE'                        => array('5.0.0', ''),
            'T_DIR'                          => array('5.3.0', ''),
            'T_FINAL'                        => array('5.0.0', ''),
            'T_FINALLY'                      => array('5.5.0-dev', ''),
            'T_GOTO'                         => array('5.3.0', ''),
            'T_HALT_COMPILER'                => array('5.1.0', ''),
            'T_IMPLEMENTS'                   => array('5.0.0', ''),
            'T_INSTANCEOF'                   => array('5.0.0', ''),
            'T_INSTEADOF'                    => array('5.4.0', ''),
            'T_INTERFACE'                    => array('5.0.0', ''),
            'T_METHOD_C'                     => array('5.0.0', ''),
            'T_NAMESPACE'                    => array('5.3.0', ''),
            'T_NS_C'                         => array('5.3.0', ''),
            'T_NS_SEPARATOR'                 => array('5.3.0', ''),
            'T_PUBLIC'                       => array('5.0.0', ''),
            'T_PROTECTED'                    => array('5.0.0', ''),
            'T_PRIVATE'                      => array('5.0.0', ''),
            'T_TRAIT'                        => array('5.4.0', ''),
            'T_TRAIT_C'                      => array('5.4.0', ''),
            'T_TRY'                          => array('5.0.0', ''),
            'T_THROW'                        => array('5.0.0', ''),
            'T_UNSET_CAST'                   => array('5.0.0', ''),
            'T_USE'                          => array('5.3.0', ''),
            'T_YIELD'                        => array('5.5.0-dev', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
