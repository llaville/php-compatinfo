<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class TokenizerExtension extends AbstractReference
{
    const REF_NAME    = 'tokenizer';
    const REF_VERSION = '0.1';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 4.2.0
        if (version_compare($version, '4.2.0', 'ge')) {
            $release = $this->getR40200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.6.0alpha1
        if (version_compare($version, '5.6.0alpha1', 'ge')) {
            $release = $this->getR50600a1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-04-22',
            'php.min' => '4.2.0',
            'php.max' => '',
        );
        $release->constants = array(
            'T_AND_EQUAL'                   => null,
            'T_ARRAY'                       => null,
            'T_ARRAY_CAST'                  => null,
            'T_AS'                          => null,
            'T_BAD_CHARACTER'               => null,
            'T_BOOLEAN_AND'                 => null,
            'T_BOOLEAN_OR'                  => null,
            'T_BOOL_CAST'                   => null,
            'T_BREAK'                       => null,
            'T_CASE'                        => null,
            'T_CHARACTER'                   => null,
            'T_CLASS'                       => null,
            'T_CLOSE_TAG'                   => null,
            'T_COMMENT'                     => null,
            'T_CONCAT_EQUAL'                => null,
            'T_CONST'                       => null,
            'T_CONSTANT_ENCAPSED_STRING'    => null,
            'T_CONTINUE'                    => null,
            'T_CURLY_OPEN'                  => null,
            'T_DEC'                         => null,
            'T_DECLARE'                     => null,
            'T_DEFAULT'                     => null,
            'T_DIV_EQUAL'                   => null,
            'T_DNUMBER'                     => null,
            'T_DO'                          => null,
            'T_DOC_COMMENT'                 => null,
            'T_DOLLAR_OPEN_CURLY_BRACES'    => null,
            'T_DOUBLE_ARROW'                => null,
            'T_DOUBLE_CAST'                 => null,
            'T_DOUBLE_COLON'                => null,
            'T_ECHO'                        => null,
            'T_ELSE'                        => null,
            'T_ELSEIF'                      => null,
            'T_EMPTY'                       => null,
            'T_ENCAPSED_AND_WHITESPACE'     => null,
            'T_ENDDECLARE'                  => null,
            'T_ENDFOR'                      => null,
            'T_ENDFOREACH'                  => null,
            'T_ENDIF'                       => null,
            'T_ENDSWITCH'                   => null,
            'T_ENDWHILE'                    => null,
            'T_END_HEREDOC'                 => null,
            'T_EVAL'                        => null,
            'T_EXIT'                        => null,
            'T_EXTENDS'                     => null,
            'T_FILE'                        => null,
            'T_FOR'                         => null,
            'T_FOREACH'                     => null,
            'T_FUNCTION'                    => null,
            'T_GLOBAL'                      => null,
            'T_IF'                          => null,
            'T_INC'                         => null,
            'T_INCLUDE'                     => null,
            'T_INCLUDE_ONCE'                => null,
            'T_INLINE_HTML'                 => null,
            'T_INT_CAST'                    => null,
            'T_ISSET'                       => null,
            'T_IS_EQUAL'                    => null,
            'T_IS_GREATER_OR_EQUAL'         => null,
            'T_IS_IDENTICAL'                => null,
            'T_IS_NOT_EQUAL'                => null,
            'T_IS_NOT_IDENTICAL'            => null,
            'T_IS_SMALLER_OR_EQUAL'         => null,
            'T_LINE'                        => null,
            'T_LIST'                        => null,
            'T_LNUMBER'                     => null,
            'T_LOGICAL_AND'                 => null,
            'T_LOGICAL_OR'                  => null,
            'T_LOGICAL_XOR'                 => null,
            'T_MINUS_EQUAL'                 => null,
            'T_ML_COMMENT'                  => array('4.2.0', '4.4.9'),
            'T_MOD_EQUAL'                   => null,
            'T_MUL_EQUAL'                   => null,
            'T_NEW'                         => null,
            'T_NUM_STRING'                  => null,
            'T_OBJECT_CAST'                 => null,
            'T_OBJECT_OPERATOR'             => null,
            'T_OLD_FUNCTION'                => array('4.2.0', '4.4.9'),
            'T_OPEN_TAG'                    => null,
            'T_OPEN_TAG_WITH_ECHO'          => null,
            'T_OR_EQUAL'                    => null,
            'T_PAAMAYIM_NEKUDOTAYIM'        => null,
            'T_PLUS_EQUAL'                  => null,
            'T_PRINT'                       => null,
            'T_REQUIRE'                     => null,
            'T_REQUIRE_ONCE'                => null,
            'T_RETURN'                      => null,
            'T_SL'                          => null,
            'T_SL_EQUAL'                    => null,
            'T_SR'                          => null,
            'T_SR_EQUAL'                    => null,
            'T_START_HEREDOC'               => null,
            'T_STATIC'                      => null,
            'T_STRING'                      => null,
            'T_STRING_CAST'                 => null,
            'T_STRING_VARNAME'              => null,
            'T_SWITCH'                      => null,
            'T_UNSET'                       => null,
            'T_VAR'                         => null,
            'T_VARIABLE'                    => null,
            'T_WHILE'                       => null,
            'T_WHITESPACE'                  => null,
            'T_XOR_EQUAL'                   => null,
        );
        $release->functions = array(
            'token_get_all'                 => null,
            'token_name'                    => null,
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'T_CLASS_C'                     => null,
            'T_FUNC_C'                      => null,
        );
        return $release;
    }

    protected function getR50000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'T_ABSTRACT'                    => null,
            'T_CATCH'                       => null,
            'T_CLONE'                       => null,
            'T_FINAL'                       => null,
            'T_IMPLEMENTS'                  => null,
            'T_INSTANCEOF'                  => null,
            'T_INTERFACE'                   => null,
            'T_METHOD_C'                    => null,
            'T_PRIVATE'                     => null,
            'T_PROTECTED'                   => null,
            'T_PUBLIC'                      => null,
            'T_THROW'                       => null,
            'T_TRY'                         => null,
            'T_UNSET_CAST'                  => null,
        );
        return $release;
    }

    protected function getR50100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'T_HALT_COMPILER'               => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'T_DIR'                         => null,
            'T_GOTO'                        => null,
            'T_NAMESPACE'                   => null,
            'T_NS_C'                        => null,
            'T_NS_SEPARATOR'                => null,
            'T_USE'                         => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->constants = array(
            'T_CALLABLE'                    => null,
            'T_INSTEADOF'                   => null,
            'T_TRAIT'                       => null,
            'T_TRAIT_C'                     => null,
        );
        return $release;
    }

    protected function getR50500()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->constants = array(
            'T_FINALLY'                     => null,
            'T_YIELD'                       => null,
        );
        return $release;
    }

    protected function getR50600a1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.6.0alpha1',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2014-01-21',
            'php.min' => '5.6.0alpha1',
            'php.max' => '',
        );
        $release->constants = array(
            'T_ELLIPSIS'                    => null,
        );
        return $release;
    }
}
