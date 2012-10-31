<?php
/**
 * Version informations about XCache extension
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
 * All interfaces, classes, functions, constants about XCache extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://xcache.lighttpd.net/
 * @since    Class available since Release 2.8.0
 */
class PHP_CompatInfo_Reference_XCache
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'XCache';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '3.0.0';

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
        $phpMin = '4.3.0';
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
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '1.0';         // 2006-06-06
        $items = array(
            // Common Used Functions
            'xcache_get'                        => array('4.3.0', ''),
            'xcache_set'                        => array('4.3.0', ''),
            'xcache_isset'                      => array('4.3.0', ''),
            'xcache_unset'                      => array('4.3.0', ''),
            'xcache_inc'                        => array('4.3.0', ''),
            'xcache_dec'                        => array('4.3.0', ''),

            // Administrator Functions
            'xcache_count'                      => array('4.3.0', ''),
            'xcache_info'                       => array('4.3.0', ''),
            'xcache_list'                       => array('4.3.0', ''),
            'xcache_clear_cache'                => array('4.3.0', ''),
            'xcache_coredump'                   => array('4.3.0', ''),

            // Dis/Assembler Opcode Functions
            'xcache_get_op_type'                => array('4.3.0', ''),
            'xcache_get_data_type'              => array('4.3.0', ''),
            'xcache_get_opcode'                 => array('4.3.0', ''),
            'xcache_get_special_value'          => array('4.3.0', ''),
            'xcache_is_autoglobal'              => array('4.3.0', ''),

        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.2.0';       // 2006-12-10
        $items = array(
            // Coverager Functions
            'xcache_coverager_decode'           => array('5.2.0', ''),
            'xcache_coverager_get'              => array('5.2.0', ''),
            'xcache_coverager_start'            => array('5.2.0', ''),
            'xcache_coverager_stop'             => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.3.0';       // 2009-08-04
        $items = array(
            // Dis/Assembler Opcode Functions
            'xcache_get_opcode_spec'            => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.0';       // 2012-04-20
        $items = array(
            // Common Used Functions
            'xcache_unset_by_prefix'            => array('5.2.0', ''),

            // Dis/Assembler Opcode Functions
            'xcache_dasm_file'                  => array('5.2.0', ''),
            'xcache_dasm_string'                => array('5.2.0', ''),
            'xcache_get_isref'                  => array('5.2.0', ''),
            'xcache_get_refcount'               => array('5.2.0', ''),
            'xcache_get_type'                   => array('5.2.0', ''),
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
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '1.0';         // 2006-06-06
        $items = array(
            'XCACHE_MODULES'                => array('4.3.0', ''),
            'XCACHE_VERSION'                => array('4.3.0', ''),
            'XC_ADD'                        => array('4.3.0', ''),
            'XC_ADD_ARRAY_ELEMENT'          => array('4.3.0', ''),
            'XC_ADD_CHAR'                   => array('4.3.0', ''),
            'XC_ADD_INTERFACE'              => array('4.3.0', ''),
            'XC_ADD_STRING'                 => array('4.3.0', ''),
            'XC_ADD_VAR'                    => array('4.3.0', ''),
            'XC_ASSIGN'                     => array('4.3.0', ''),
            'XC_ASSIGN_ADD'                 => array('4.3.0', ''),
            'XC_ASSIGN_BW_AND'              => array('4.3.0', ''),
            'XC_ASSIGN_BW_OR'               => array('4.3.0', ''),
            'XC_ASSIGN_BW_XOR'              => array('4.3.0', ''),
            'XC_ASSIGN_CONCAT'              => array('4.3.0', ''),
            'XC_ASSIGN_DIM'                 => array('4.3.0', ''),
            'XC_ASSIGN_DIV'                 => array('4.3.0', ''),
            'XC_ASSIGN_MOD'                 => array('4.3.0', ''),
            'XC_ASSIGN_MUL'                 => array('4.3.0', ''),
            'XC_ASSIGN_OBJ'                 => array('4.3.0', ''),
            'XC_ASSIGN_REF'                 => array('4.3.0', ''),
            'XC_ASSIGN_SL'                  => array('4.3.0', ''),
            'XC_ASSIGN_SR'                  => array('4.3.0', ''),
            'XC_ASSIGN_SUB'                 => array('4.3.0', ''),
            'XC_BEGIN_SILENCE'              => array('4.3.0', ''),
            'XC_BOOL'                       => array('4.3.0', ''),
            'XC_BOOL_NOT'                   => array('4.3.0', ''),
            'XC_BOOL_XOR'                   => array('4.3.0', ''),
            'XC_BRK'                        => array('4.3.0', ''),
            'XC_BW_AND'                     => array('4.3.0', ''),
            'XC_BW_NOT'                     => array('4.3.0', ''),
            'XC_BW_OR'                      => array('4.3.0', ''),
            'XC_BW_XOR'                     => array('4.3.0', ''),
            'XC_CASE'                       => array('4.3.0', ''),
            'XC_CAST'                       => array('4.3.0', ''),
            'XC_CATCH'                      => array('4.3.0', ''),
            'XC_CLONE'                      => array('4.3.0', ''),
            'XC_CONCAT'                     => array('4.3.0', ''),
            'XC_CONT'                       => array('4.3.0', ''),
            'XC_DECLARE_CLASS'              => array('4.3.0', ''),
            'XC_DECLARE_FUNCTION'           => array('4.3.0', ''),
            'XC_DECLARE_INHERITED_CLASS'    => array('4.3.0', ''),
            'XC_DIV'                        => array('4.3.0', ''),
            'XC_DO_FCALL'                   => array('4.3.0', ''),
            'XC_DO_FCALL_BY_NAME'           => array('4.3.0', ''),
            'XC_ECHO'                       => array('4.3.0', ''),
            'XC_END_SILENCE'                => array('4.3.0', ''),
            'XC_EXIT'                       => array('4.3.0', ''),
            'XC_EXT_FCALL_BEGIN'            => array('4.3.0', ''),
            'XC_EXT_FCALL_END'              => array('4.3.0', ''),
            'XC_EXT_NOP'                    => array('4.3.0', ''),
            'XC_EXT_STMT'                   => array('4.3.0', ''),
            'XC_FETCH_CLASS'                => array('4.3.0', ''),
            'XC_FETCH_CONSTANT'             => array('4.3.0', ''),
            'XC_FETCH_DIM_FUNC_ARG'         => array('4.3.0', ''),
            'XC_FETCH_DIM_IS'               => array('4.3.0', ''),
            'XC_FETCH_DIM_R'                => array('4.3.0', ''),
            'XC_FETCH_DIM_RW'               => array('4.3.0', ''),
            'XC_FETCH_DIM_TMP_VAR'          => array('4.3.0', ''),
            'XC_FETCH_DIM_UNSET'            => array('4.3.0', ''),
            'XC_FETCH_DIM_W'                => array('4.3.0', ''),
            'XC_FETCH_FUNC_ARG'             => array('4.3.0', ''),
            'XC_FETCH_IS'                   => array('4.3.0', ''),
            'XC_FETCH_OBJ_FUNC_ARG'         => array('4.3.0', ''),
            'XC_FETCH_OBJ_IS'               => array('4.3.0', ''),
            'XC_FETCH_OBJ_R'                => array('4.3.0', ''),
            'XC_FETCH_OBJ_RW'               => array('4.3.0', ''),
            'XC_FETCH_OBJ_UNSET'            => array('4.3.0', ''),
            'XC_FETCH_OBJ_W'                => array('4.3.0', ''),
            'XC_FETCH_R'                    => array('4.3.0', ''),
            'XC_FETCH_RW'                   => array('4.3.0', ''),
            'XC_FETCH_UNSET'                => array('4.3.0', ''),
            'XC_FETCH_W'                    => array('4.3.0', ''),
            'XC_FE_FETCH'                   => array('4.3.0', ''),
            'XC_FE_RESET'                   => array('4.3.0', ''),
            'XC_FREE'                       => array('4.3.0', ''),
            'XC_HANDLE_EXCEPTION'           => array('4.3.0', ''),
            'XC_INCLUDE_OR_EVAL'            => array('4.3.0', ''),
            'XC_INIT_ARRAY'                 => array('4.3.0', ''),
            'XC_INIT_FCALL_BY_NAME'         => array('4.3.0', ''),
            'XC_INIT_METHOD_CALL'           => array('4.3.0', ''),
            'XC_INIT_STATIC_METHOD_CALL'    => array('4.3.0', ''),
            'XC_INIT_STRING'                => array('4.3.0', ''),
            'XC_INSTANCEOF'                 => array('4.3.0', ''),
            'XC_ISSET_ISEMPTY_DIM_OBJ'      => array('4.3.0', ''),
            'XC_ISSET_ISEMPTY_PROP_OBJ'     => array('4.3.0', ''),
            'XC_ISSET_ISEMPTY_VAR'          => array('4.3.0', ''),
            'XC_IS_ARRAY'                   => array('4.3.0', ''),
            'XC_IS_BOOL'                    => array('4.3.0', ''),
            'XC_IS_CONST'                   => array('4.3.0', ''),
            'XC_IS_CONSTANT'                => array('4.3.0', ''),
            'XC_IS_CONSTANT_ARRAY'          => array('4.3.0', ''),
            'XC_IS_CV'                      => array('4.3.0', ''),
            'XC_IS_DOUBLE'                  => array('4.3.0', ''),
            'XC_IS_EQUAL'                   => array('4.3.0', ''),
            'XC_IS_IDENTICAL'               => array('4.3.0', ''),
            'XC_IS_LONG'                    => array('4.3.0', ''),
            'XC_IS_NOT_EQUAL'               => array('4.3.0', ''),
            'XC_IS_NOT_IDENTICAL'           => array('4.3.0', ''),
            'XC_IS_NULL'                    => array('4.3.0', ''),
            'XC_IS_OBJECT'                  => array('4.3.0', ''),
            'XC_IS_RESOURCE'                => array('4.3.0', ''),
            'XC_IS_SMALLER'                 => array('4.3.0', ''),
            'XC_IS_SMALLER_OR_EQUAL'        => array('4.3.0', ''),
            'XC_IS_STRING'                  => array('4.3.0', ''),
            'XC_IS_TMP_VAR'                 => array('4.3.0', ''),
            'XC_IS_UNICODE'                 => array('4.3.0', ''),
            'XC_IS_UNUSED'                  => array('4.3.0', ''),
            'XC_IS_VAR'                     => array('4.3.0', ''),
            'XC_JMP'                        => array('4.3.0', ''),
            'XC_JMPNZ'                      => array('4.3.0', ''),
            'XC_JMPNZ_EX'                   => array('4.3.0', ''),
            'XC_JMPZ'                       => array('4.3.0', ''),
            'XC_JMPZNZ'                     => array('4.3.0', ''),
            'XC_JMPZ_EX'                    => array('4.3.0', ''),
            'XC_MOD'                        => array('4.3.0', ''),
            'XC_MUL'                        => array('4.3.0', ''),
            'XC_NEW'                        => array('4.3.0', ''),
            'XC_NOP'                        => array('4.3.0', ''),
            'XC_NULL?'                      => array('4.3.0', ''),
            'XC_OPSPEC_ARG'                 => array('4.3.0', ''),
            'XC_OPSPEC_ASSIGN'              => array('4.3.0', ''),
            'XC_OPSPEC_BIT'                 => array('4.3.0', ''),
            'XC_OPSPEC_BRK'                 => array('4.3.0', ''),
            'XC_OPSPEC_CAST'                => array('4.3.0', ''),
            'XC_OPSPEC_CLASS'               => array('4.3.0', ''),
            'XC_OPSPEC_CONT'                => array('4.3.0', ''),
            'XC_OPSPEC_DECLARE'             => array('4.3.0', ''),
            'XC_OPSPEC_FCALL'               => array('4.3.0', ''),
            'XC_OPSPEC_FCLASS'              => array('4.3.0', ''),
            'XC_OPSPEC_FE'                  => array('4.3.0', ''),
            'XC_OPSPEC_FETCH'               => array('4.3.0', ''),
            'XC_OPSPEC_IFACE'               => array('4.3.0', ''),
            'XC_OPSPEC_INCLUDE'             => array('4.3.0', ''),
            'XC_OPSPEC_INIT_FCALL'          => array('4.3.0', ''),
            'XC_OPSPEC_ISSET'               => array('4.3.0', ''),
            'XC_OPSPEC_JMPADDR'             => array('4.3.0', ''),
            'XC_OPSPEC_OPLINE'              => array('4.3.0', ''),
            'XC_OPSPEC_SEND'                => array('4.3.0', ''),
            'XC_OPSPEC_SEND_NOREF'          => array('4.3.0', ''),
            'XC_OPSPEC_STD'                 => array('4.3.0', ''),
            'XC_OPSPEC_TMP'                 => array('4.3.0', ''),
            'XC_OPSPEC_UCLASS'              => array('4.3.0', ''),
            'XC_OPSPEC_UNUSED'              => array('4.3.0', ''),
            'XC_OPSPEC_VAR'                 => array('4.3.0', ''),
            'XC_OP_DATA'                    => array('4.3.0', ''),
            'XC_POST_DEC'                   => array('4.3.0', ''),
            'XC_POST_DEC_OBJ'               => array('4.3.0', ''),
            'XC_POST_INC'                   => array('4.3.0', ''),
            'XC_POST_INC_OBJ'               => array('4.3.0', ''),
            'XC_PRE_DEC'                    => array('4.3.0', ''),
            'XC_PRE_DEC_OBJ'                => array('4.3.0', ''),
            'XC_PRE_INC'                    => array('4.3.0', ''),
            'XC_PRE_INC_OBJ'                => array('4.3.0', ''),
            'XC_PRINT'                      => array('4.3.0', ''),
            'XC_QM_ASSIGN'                  => array('4.3.0', ''),
            'XC_RAISE_ABSTRACT_ERROR'       => array('4.3.0', ''),
            'XC_RECV'                       => array('4.3.0', ''),
            'XC_RECV_INIT'                  => array('4.3.0', ''),
            'XC_RETURN'                     => array('4.3.0', ''),
            'XC_SEND_REF'                   => array('4.3.0', ''),
            'XC_SEND_VAL'                   => array('4.3.0', ''),
            'XC_SEND_VAR'                   => array('4.3.0', ''),
            'XC_SEND_VAR_NO_REF'            => array('4.3.0', ''),
            'XC_SIZEOF_TEMP_VARIABLE'       => array('4.3.0', ''),
            'XC_SL'                         => array('4.3.0', ''),
            'XC_SR'                         => array('4.3.0', ''),
            'XC_SUB'                        => array('4.3.0', ''),
            'XC_SWITCH_FREE'                => array('4.3.0', ''),
            'XC_THROW'                      => array('4.3.0', ''),
            'XC_TICKS'                      => array('4.3.0', ''),
            'XC_TYPE_PHP'                   => array('4.3.0', ''),
            'XC_TYPE_VAR'                   => array('4.3.0', ''),
            'XC_UNDEF'                      => array('4.3.0', ''),
            'XC_UNSET_DIM'                  => array('4.3.0', ''),
            'XC_UNSET_OBJ'                  => array('4.3.0', ''),
            'XC_UNSET_VAR'                  => array('4.3.0', ''),
            'XC_USER_OPCODE'                => array('4.3.0', ''),
            'XC_VERIFY_ABSTRACT_CLASS'      => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '1.3.0';       // 2009-08-04
        $items = array(
            'XC_INIT_NS_FCALL_BY_NAME'      => array('5.3.0', ''),
            'XC_GOTO'                       => array('5.3.0', ''),
            'XC_DECLARE_CONST'              => array('5.3.0', ''),
            'XC_DECLARE_INHERITED_CLASS_DELAYED'
                                            => array('5.3.0', ''),
            'XC_DECLARE_LAMBDA_FUNCTION'    => array('5.3.0', ''),
            'XC_JMP_SET'                    => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '2.0.0';       // 2012-04-20
        $items = array(
            'XC_ADD_TRAIT'                  => array('5.4.0', ''),
            'XC_BIND_TRAITS'                => array('5.4.0', ''),
            'XC_JMP_SET_VAR'                => array('5.4.0', ''),
            'XC_QM_ASSIGN_VAR'              => array('5.4.0', ''),
            'XC_RETURN_BY_REF'              => array('5.4.0', ''),
            'XC_SEPARATE'                   => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
