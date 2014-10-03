<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

// XCache
// @link http://xcache.lighttpd.net
//
// Administration @link http://xcache.lighttpd.net/wiki/XcacheIni#XCacheAdministration
// Cacher         @link http://xcache.lighttpd.net/wiki/XcacheIni#XCacheCacher
// Optimizer      @link http://xcache.lighttpd.net/wiki/XcacheIni#XCacheOptimizer
// Coverager      @link http://xcache.lighttpd.net/wiki/XcacheIni#XCacheCoverager

class XcacheExtension extends AbstractReference
{
    const REF_NAME    = 'XCache';
    const REF_VERSION = '3.2.0';    // 2014-09-18 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 1.0
        if (version_compare($version, '1.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.2.0
        if (version_compare($version, '1.2.0', 'ge')) {
            $release = $this->getR10200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.2.1
        if (version_compare($version, '1.2.1', 'ge')) {
            $release = $this->getR10201();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.3.0
        if (version_compare($version, '1.3.0', 'ge')) {
            $release = $this->getR10300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0
        if (version_compare($version, '2.0.0', 'ge')) {
            $release = $this->getR20000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 3.0.0
        if (version_compare($version, '3.0.0', 'ge')) {
            $release = $this->getR30000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 3.0.1
        if (version_compare($version, '3.0.1', 'ge')) {
            $release = $this->getR30001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 3.1.0
        if (version_compare($version, '3.1.0', 'ge')) {
            $release = $this->getR30100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 3.2.0
        if (version_compare($version, '3.2.0', 'ge')) {
            $release = $this->getR30200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR10000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-06-06',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xcache.coveragedumper'         => array('ext.max' => '1.2.0'),

            // Administration
            'xcache.admin.pass'             => null,
            'xcache.admin.user'             => null,
            'xcache.coredump_directory'     => null,
            'xcache.test'                   => null,

            // Cacher
            'xcache.cacher'                 => null,
            'xcache.count'                  => null,
            'xcache.mmap_path'              => null,
            'xcache.readonly_protection'    => null,
            'xcache.size'                   => null,
            'xcache.slots'                  => null,
            'xcache.var_count'              => null,
            'xcache.var_size'               => null,
            'xcache.var_slots'              => null,
        );
        $release->functions = array(
            // Common Used Functions
            'xcache_dec'                    => null,
            'xcache_get'                    => null,
            'xcache_inc'                    => null,
            'xcache_isset'                  => null,
            'xcache_set'                    => null,
            'xcache_unset'                  => null,

            // Administrator Functions
            'xcache_clear_cache'            => null,
            'xcache_coredump'               => null,
            'xcache_count'                  => null,
            'xcache_info'                   => null,
            'xcache_list'                   => null,

            // Dis/Assembler Opcode Functions
            'xcache_get_data_type'          => null,
            'xcache_get_op_type'            => null,
            'xcache_get_opcode'             => null,
            'xcache_get_special_value'      => null,
            'xcache_is_autoglobal'          => null,
        );
        $release->constants = array(
            'XCACHE_MODULES'                => null,
            'XCACHE_VERSION'                => null,
            'XC_ADD'                        => null,
            'XC_ADD_ARRAY_ELEMENT'          => null,
            'XC_ADD_CHAR'                   => null,
            'XC_ADD_INTERFACE'              => null,
            'XC_ADD_STRING'                 => null,
            'XC_ADD_VAR'                    => null,
            'XC_ASSIGN'                     => null,
            'XC_ASSIGN_ADD'                 => null,
            'XC_ASSIGN_BW_AND'              => null,
            'XC_ASSIGN_BW_OR'               => null,
            'XC_ASSIGN_BW_XOR'              => null,
            'XC_ASSIGN_CONCAT'              => null,
            'XC_ASSIGN_DIM'                 => null,
            'XC_ASSIGN_DIV'                 => null,
            'XC_ASSIGN_MOD'                 => null,
            'XC_ASSIGN_MUL'                 => null,
            'XC_ASSIGN_OBJ'                 => null,
            'XC_ASSIGN_REF'                 => null,
            'XC_ASSIGN_SL'                  => null,
            'XC_ASSIGN_SR'                  => null,
            'XC_ASSIGN_SUB'                 => null,
            'XC_BEGIN_SILENCE'              => null,
            'XC_BOOL'                       => null,
            'XC_BOOL_NOT'                   => null,
            'XC_BOOL_XOR'                   => null,
            'XC_BRK'                        => null,
            'XC_BW_AND'                     => null,
            'XC_BW_NOT'                     => null,
            'XC_BW_OR'                      => null,
            'XC_BW_XOR'                     => null,
            'XC_CASE'                       => null,
            'XC_CAST'                       => null,
            'XC_CATCH'                      => null,
            'XC_CLONE'                      => null,
            'XC_CONCAT'                     => null,
            'XC_CONT'                       => null,
            'XC_DECLARE_CLASS'              => null,
            'XC_DECLARE_FUNCTION'           => null,
            'XC_DECLARE_INHERITED_CLASS'    => null,
            'XC_DIV'                        => null,
            'XC_DO_FCALL'                   => null,
            'XC_DO_FCALL_BY_NAME'           => null,
            'XC_ECHO'                       => null,
            'XC_END_SILENCE'                => null,
            'XC_EXIT'                       => null,
            'XC_EXT_FCALL_BEGIN'            => null,
            'XC_EXT_FCALL_END'              => null,
            'XC_EXT_NOP'                    => null,
            'XC_EXT_STMT'                   => null,
            'XC_FETCH_CLASS'                => null,
            'XC_FETCH_CONSTANT'             => null,
            'XC_FETCH_DIM_FUNC_ARG'         => null,
            'XC_FETCH_DIM_IS'               => null,
            'XC_FETCH_DIM_R'                => null,
            'XC_FETCH_DIM_RW'               => null,
            'XC_FETCH_DIM_TMP_VAR'          => null,
            'XC_FETCH_DIM_UNSET'            => null,
            'XC_FETCH_DIM_W'                => null,
            'XC_FETCH_FUNC_ARG'             => null,
            'XC_FETCH_IS'                   => null,
            'XC_FETCH_OBJ_FUNC_ARG'         => null,
            'XC_FETCH_OBJ_IS'               => null,
            'XC_FETCH_OBJ_R'                => null,
            'XC_FETCH_OBJ_RW'               => null,
            'XC_FETCH_OBJ_UNSET'            => null,
            'XC_FETCH_OBJ_W'                => null,
            'XC_FETCH_R'                    => null,
            'XC_FETCH_RW'                   => null,
            'XC_FETCH_UNSET'                => null,
            'XC_FETCH_W'                    => null,
            'XC_FE_FETCH'                   => null,
            'XC_FE_RESET'                   => null,
            'XC_FREE'                       => null,
            'XC_HANDLE_EXCEPTION'           => null,
            'XC_INCLUDE_OR_EVAL'            => null,
            'XC_INIT_ARRAY'                 => null,
            'XC_INIT_FCALL_BY_NAME'         => null,
            'XC_INIT_METHOD_CALL'           => null,
            'XC_INIT_STATIC_METHOD_CALL'    => null,
            'XC_INIT_STRING'                => null,
            'XC_INSTANCEOF'                 => null,
            'XC_ISSET_ISEMPTY_DIM_OBJ'      => null,
            'XC_ISSET_ISEMPTY_PROP_OBJ'     => null,
            'XC_ISSET_ISEMPTY_VAR'          => null,
            'XC_IS_ARRAY'                   => null,
            'XC_IS_BOOL'                    => null,
            'XC_IS_CONST'                   => null,
            'XC_IS_CONSTANT'                => null,
            'XC_IS_CONSTANT_ARRAY'          => null,
            'XC_IS_CV'                      => null,
            'XC_IS_DOUBLE'                  => null,
            'XC_IS_EQUAL'                   => null,
            'XC_IS_IDENTICAL'               => null,
            'XC_IS_LONG'                    => null,
            'XC_IS_NOT_EQUAL'               => null,
            'XC_IS_NOT_IDENTICAL'           => null,
            'XC_IS_NULL'                    => null,
            'XC_IS_OBJECT'                  => null,
            'XC_IS_RESOURCE'                => null,
            'XC_IS_SMALLER'                 => null,
            'XC_IS_SMALLER_OR_EQUAL'        => null,
            'XC_IS_STRING'                  => null,
            'XC_IS_TMP_VAR'                 => null,
            'XC_IS_UNICODE'                 => null,
            'XC_IS_UNUSED'                  => null,
            'XC_IS_VAR'                     => null,
            'XC_JMP'                        => null,
            'XC_JMPNZ'                      => null,
            'XC_JMPNZ_EX'                   => null,
            'XC_JMPZ'                       => null,
            'XC_JMPZNZ'                     => null,
            'XC_JMPZ_EX'                    => null,
            'XC_MOD'                        => null,
            'XC_MUL'                        => null,
            'XC_NEW'                        => null,
            'XC_NOP'                        => null,
            'XC_NULL?'                      => null,
            'XC_OPSPEC_ARG'                 => null,
            'XC_OPSPEC_ASSIGN'              => null,
            'XC_OPSPEC_BIT'                 => null,
            'XC_OPSPEC_BRK'                 => null,
            'XC_OPSPEC_CAST'                => null,
            'XC_OPSPEC_CLASS'               => null,
            'XC_OPSPEC_CONT'                => null,
            'XC_OPSPEC_DECLARE'             => null,
            'XC_OPSPEC_FCALL'               => null,
            'XC_OPSPEC_FCLASS'              => null,
            'XC_OPSPEC_FE'                  => null,
            'XC_OPSPEC_FETCH'               => null,
            'XC_OPSPEC_IFACE'               => null,
            'XC_OPSPEC_INCLUDE'             => null,
            'XC_OPSPEC_INIT_FCALL'          => null,
            'XC_OPSPEC_ISSET'               => null,
            'XC_OPSPEC_JMPADDR'             => null,
            'XC_OPSPEC_OPLINE'              => null,
            'XC_OPSPEC_SEND'                => null,
            'XC_OPSPEC_SEND_NOREF'          => null,
            'XC_OPSPEC_STD'                 => null,
            'XC_OPSPEC_TMP'                 => null,
            'XC_OPSPEC_UCLASS'              => null,
            'XC_OPSPEC_UNUSED'              => null,
            'XC_OPSPEC_VAR'                 => null,
            'XC_OP_DATA'                    => null,
            'XC_POST_DEC'                   => null,
            'XC_POST_DEC_OBJ'               => null,
            'XC_POST_INC'                   => null,
            'XC_POST_INC_OBJ'               => null,
            'XC_PRE_DEC'                    => null,
            'XC_PRE_DEC_OBJ'                => null,
            'XC_PRE_INC'                    => null,
            'XC_PRE_INC_OBJ'                => null,
            'XC_PRINT'                      => null,
            'XC_QM_ASSIGN'                  => null,
            'XC_RAISE_ABSTRACT_ERROR'       => null,
            'XC_RECV'                       => null,
            'XC_RECV_INIT'                  => null,
            'XC_RETURN'                     => null,
            'XC_SEND_REF'                   => null,
            'XC_SEND_VAL'                   => null,
            'XC_SEND_VAR'                   => null,
            'XC_SEND_VAR_NO_REF'            => null,
            'XC_SIZEOF_TEMP_VARIABLE'       => null,
            'XC_SL'                         => null,
            'XC_SR'                         => null,
            'XC_SUB'                        => null,
            'XC_SWITCH_FREE'                => null,
            'XC_THROW'                      => null,
            'XC_TICKS'                      => null,
            'XC_TYPE_PHP'                   => null,
            'XC_TYPE_VAR'                   => null,
            'XC_UNDEF'                      => null,
            'XC_UNSET_DIM'                  => null,
            'XC_UNSET_OBJ'                  => null,
            'XC_UNSET_VAR'                  => null,
            'XC_USER_OPCODE'                => null,
            'XC_VERIFY_ABSTRACT_CLASS'      => null,
        );
        return $release;
    }

    protected function getR10200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-12-10',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            // Cacher
            'xcache.gc_interval'            => null,
            'xcache.shm_scheme'             => null,
            'xcache.stat'                   => null,
            'xcache.ttl'                    => null,
            'xcache.var_gc_interval'        => null,
            'xcache.var_maxttl'             => null,
            'xcache.var_ttl'                => null,
        );
        $release->functions = array(
            // Coverager Functions
            'xcache_coverager_decode'       => null,
            'xcache_coverager_get'          => null,
            'xcache_coverager_start'        => null,
            'xcache_coverager_stop'         => null,
        );
        return $release;
    }

    protected function getR10201()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.2.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-07-01',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            // Administration
            'xcache.admin.enable_auth'      => null,
        );
        return $release;
    }

    protected function getR10300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-08-04',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            // Optimizer
            'xcache.optimizer'                      => null,

            // Coverager
            'xcache.coverager'                      => null,
            'xcache.coveragedump_directory'         => null,
        );
        $release->functions = array(
            // Dis/Assembler Opcode Functions
            'xcache_get_opcode_spec'                => null,
        );
        $release->constants = array(
            'XC_INIT_NS_FCALL_BY_NAME'              => null,
            'XC_GOTO'                               => null,
            'XC_DECLARE_CONST'                      => null,
            'XC_DECLARE_INHERITED_CLASS_DELAYED'    => null,
            'XC_DECLARE_LAMBDA_FUNCTION'            => null,
            'XC_JMP_SET'                            => null,
        );
        return $release;
    }

    protected function getR20000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-04-20',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xcache.experimental'           => null,
        );
        $release->functions = array(
            // Common Used Functions
            'xcache_unset_by_prefix'        => null,

            // Dis/Assembler Opcode Functions
            'xcache_dasm_file'              => null,
            'xcache_dasm_string'            => null,
            'xcache_get_isref'              => null,
            'xcache_get_refcount'           => null,
            'xcache_get_type'               => null,
        );
        $release->constants = array(
            'XC_ADD_TRAIT'                  => array('5.4.0', ''),
            'XC_BIND_TRAITS'                => array('5.4.0', ''),
            'XC_JMP_SET_VAR'                => array('5.4.0', ''),
            'XC_QM_ASSIGN_VAR'              => array('5.4.0', ''),
            'XC_RETURN_BY_REF'              => array('5.4.0', ''),
            'XC_SEPARATE'                   => array('5.4.0', ''),
        );
        return $release;
    }

    protected function getR30000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-10-29',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            // Administration
            'xcache.disable_on_crash'       => null,

            // Coverager
            'xcache.coverager_autostart'    => null,

            // Cacher
            'xcache.allocator'              => null,
            'xcache.var_allocator'          => null,
            'xcache.var_namespace_mode'     => null,
            'xcache.var_namespace'          => null,
        );
        return $release;
    }

    protected function getR30001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-01-11',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            // Administration
            'xcache.coredump_type'          => null,
        );
        return $release;
    }

    protected function getR30100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-10-10',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'XC_DISCARD_EXCEPTION'          => array('5.5.0', ''),
            'XC_FAST_CALL'                  => array('5.5.0', ''),
            'XC_FAST_RET'                   => array('5.5.0', ''),
            'XC_GENERATOR_RETURN'           => array('5.5.0', ''),
            'XC_YIELD'                      => array('5.5.0', ''),
        );
        return $release;
    }

    protected function getR30200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-09-18',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'XC_RECV_VARIADIC'              => array('5.6.0', ''),
            'XC_SEND_UNPACK'                => array('5.6.0', ''),
            'XC_POW'                        => array('5.6.0', ''),
            'XC_ASSIGN_POW'                 => array('5.6.0', ''),
        );
        return $release;
    }
}
