<?php
/**
 * Registers autoloader for PHP_CompatInfo and all other dependencies
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * Autoloader for PHP_CompatInfo 
 *
 * @param string $className name of the class (and namespace) being instantiated.
 *
 * @return void
 */
function phpCompatInfo_autoload($className)
{
    static $classes = null;
    static $path    = null;

    if ($classes === null) {

        $classes = array(
            'PHP_CompatInfo_TokenParser'
                => 'PHP/CompatInfo/TokenParser.php',
            'PHP_CompatInfo_Token_STRING'
                => 'PHP/CompatInfo/Token/String.php',
            'PHP_CompatInfo_Token_CONSTANT_ENCAPSED_STRING'
                => 'PHP/CompatInfo/Token/ConstantEncapsedString.php',
            'PHP_CompatInfo_Token_OBJECT_OPERATOR'
                => 'PHP/CompatInfo/Token/ObjectOperator.php',
            'PHP_CompatInfo_Token_OPEN_SQUARE'
                => 'PHP/CompatInfo/Token/OpenSquare.php',
            'PHP_CompatInfo'
                => 'PHP/CompatInfo.php',
            'PHP_CompatInfo_Exception'
                => 'PHP/CompatInfo/Exception.php',
            'PHP_CompatInfo_Configuration'
                => 'PHP/CompatInfo/Configuration.php',
            'PHP_CompatInfo_Cache'
                => 'PHP/CompatInfo/Cache.php',
            'PHP_CompatInfo_Cache_Interface'
                => 'PHP/CompatInfo/Cache/Interface.php',
            'PHP_CompatInfo_Cache_Null'
                => 'PHP/CompatInfo/Cache/Null.php',
            'PHP_CompatInfo_Cache_File'
                => 'PHP/CompatInfo/Cache/File.php',
            'PHP_CompatInfo_Reference'
                => 'PHP/CompatInfo/Reference.php',
            'PHP_CompatInfo_Reference_PluginsAbstract'
                => 'PHP/CompatInfo/Reference/PluginsAbstract.php',
            'PHP_CompatInfo_Reference_PHP4'
                => 'PHP/CompatInfo/Reference/PHP4.php',
            'PHP_CompatInfo_Reference_PHP5'
                => 'PHP/CompatInfo/Reference/PHP5.php',
            'PHP_CompatInfo_Reference_ALL'
                => 'PHP/CompatInfo/Reference/ALL.php',
            'PHP_CompatInfo_Report'
                => 'PHP/CompatInfo/Report.php',
            'PHP_CompatInfo_Report_Database'
                => 'PHP/CompatInfo/Report/Database.php',
            'PHP_CompatInfo_Report_Reference'
                => 'PHP/CompatInfo/Report/Reference.php',
            'PHP_CompatInfo_Report_Summary'
                => 'PHP/CompatInfo/Report/Summary.php',
            'PHP_CompatInfo_Report_Extension'
                => 'PHP/CompatInfo/Report/Extension.php',
            'PHP_CompatInfo_Report_Namespace'
                => 'PHP/CompatInfo/Report/Namespace.php',
            'PHP_CompatInfo_Report_Trait'
                => 'PHP/CompatInfo/Report/Trait.php',
            'PHP_CompatInfo_Report_Interface'
                => 'PHP/CompatInfo/Report/Interface.php',
            'PHP_CompatInfo_Report_Class'
                => 'PHP/CompatInfo/Report/Class.php',
            'PHP_CompatInfo_Report_Function'
                => 'PHP/CompatInfo/Report/Function.php',
            'PHP_CompatInfo_Report_Constant'
                => 'PHP/CompatInfo/Report/Constant.php',
            'PHP_CompatInfo_Report_Global'
                => 'PHP/CompatInfo/Report/Global.php',
            'PHP_CompatInfo_Report_Xml'
                => 'PHP/CompatInfo/Report/Xml.php',
            'PHP_CompatInfo_Report_Source'
                => 'PHP/CompatInfo/Report/Source.php',
            'PHP_CompatInfo_Report_Token'
                => 'PHP/CompatInfo/Report/Token.php',
            'PHP_CompatInfo_Listener_File'
                => 'PHP/CompatInfo/Listener/File.php',
            'PHP_CompatInfo_Listener_Growl'
                => 'PHP/CompatInfo/Listener/Growl.php',

            // PHP extensions references
            'PHP_CompatInfo_Reference_Apc'
                => 'PHP/CompatInfo/Reference/apc.php',
            'PHP_CompatInfo_Reference_Bcmath'
                => 'PHP/CompatInfo/Reference/bcmath.php',
            'PHP_CompatInfo_Reference_Bz2'
                => 'PHP/CompatInfo/Reference/bz2.php',
            'PHP_CompatInfo_Reference_Calendar'
                => 'PHP/CompatInfo/Reference/calendar.php',
            'PHP_CompatInfo_Reference_Core'
                => 'PHP/CompatInfo/Reference/core.php',
            'PHP_CompatInfo_Reference_Ctype'
                => 'PHP/CompatInfo/Reference/ctype.php',
            'PHP_CompatInfo_Reference_Curl'
                => 'PHP/CompatInfo/Reference/curl.php',
            'PHP_CompatInfo_Reference_Date'
                => 'PHP/CompatInfo/Reference/date.php',
            'PHP_CompatInfo_Reference_Dom'
                => 'PHP/CompatInfo/Reference/dom.php',
            'PHP_CompatInfo_Reference_Ereg'
                => 'PHP/CompatInfo/Reference/ereg.php',
            'PHP_CompatInfo_Reference_Enchant'
                => 'PHP/CompatInfo/Reference/enchant.php',
            'PHP_CompatInfo_Reference_Filter'
                => 'PHP/CompatInfo/Reference/filter.php',
            'PHP_CompatInfo_Reference_Fileinfo'
                => 'PHP/CompatInfo/Reference/fileinfo.php',
            'PHP_CompatInfo_Reference_Ftp'
                => 'PHP/CompatInfo/Reference/ftp.php',
            'PHP_CompatInfo_Reference_Gd'
                => 'PHP/CompatInfo/Reference/gd.php',
            'PHP_CompatInfo_Reference_Gettext'
                => 'PHP/CompatInfo/Reference/gettext.php',
            'PHP_CompatInfo_Reference_Gmp'
                => 'PHP/CompatInfo/Reference/gmp.php',
            'PHP_CompatInfo_Reference_Hash'
                => 'PHP/CompatInfo/Reference/hash.php',
            'PHP_CompatInfo_Reference_Iconv'
                => 'PHP/CompatInfo/Reference/iconv.php',
            'PHP_CompatInfo_Reference_Imap'
                => 'PHP/CompatInfo/Reference/imap.php',
            'PHP_CompatInfo_Reference_Intl'
                => 'PHP/CompatInfo/Reference/intl.php',
            'PHP_CompatInfo_Reference_Json'
                => 'PHP/CompatInfo/Reference/json.php',
            'PHP_CompatInfo_Reference_Ldap'
                => 'PHP/CompatInfo/Reference/ldap.php',
            'PHP_CompatInfo_Reference_Libxml'
                => 'PHP/CompatInfo/Reference/libxml.php',
            'PHP_CompatInfo_Reference_Mailparse'
                => 'PHP/CompatInfo/Reference/mailparse.php',
            'PHP_CompatInfo_Reference_Mbstring'
                => 'PHP/CompatInfo/Reference/mbstring.php',
            'PHP_CompatInfo_Reference_Mcrypt'
                => 'PHP/CompatInfo/Reference/mcrypt.php',
            'PHP_CompatInfo_Reference_Memcache'
                => 'PHP/CompatInfo/Reference/memcache.php',
            'PHP_CompatInfo_Reference_Memcached'
                => 'PHP/CompatInfo/Reference/memcached.php',
            'PHP_CompatInfo_Reference_Mhash'
                => 'PHP/CompatInfo/Reference/mhash.php',
            'PHP_CompatInfo_Reference_Mssql'
                => 'PHP/CompatInfo/Reference/mssql.php',
            'PHP_CompatInfo_Reference_Mysql'
                => 'PHP/CompatInfo/Reference/mysql.php',
            'PHP_CompatInfo_Reference_Mysqli'
                => 'PHP/CompatInfo/Reference/mysqli.php',
            'PHP_CompatInfo_Reference_OAuth'
                => 'PHP/CompatInfo/Reference/oauth.php',
            'PHP_CompatInfo_Reference_Openssl'
                => 'PHP/CompatInfo/Reference/openssl.php',
            'PHP_CompatInfo_Reference_Pcntl'
                => 'PHP/CompatInfo/Reference/pcntl.php',
            'PHP_CompatInfo_Reference_Pcre'
                => 'PHP/CompatInfo/Reference/pcre.php',
            'PHP_CompatInfo_Reference_PDO'
                => 'PHP/CompatInfo/Reference/pdo.php',
            'PHP_CompatInfo_Reference_Pgsql'
                => 'PHP/CompatInfo/Reference/pgsql.php',
            'PHP_CompatInfo_Reference_Phar'
                => 'PHP/CompatInfo/Reference/phar.php',
            'PHP_CompatInfo_Reference_Posix'
                => 'PHP/CompatInfo/Reference/posix.php',
            'PHP_CompatInfo_Reference_Readline'
                => 'PHP/CompatInfo/Reference/readline.php',
            'PHP_CompatInfo_Reference_Recode'
                => 'PHP/CompatInfo/Reference/recode.php',
            'PHP_CompatInfo_Reference_Reflection'
                => 'PHP/CompatInfo/Reference/reflection.php',
            'PHP_CompatInfo_Reference_Snmp'
                => 'PHP/CompatInfo/Reference/snmp.php',
            'PHP_CompatInfo_Reference_Soap'
                => 'PHP/CompatInfo/Reference/soap.php',
            'PHP_CompatInfo_Reference_SPL'
                => 'PHP/CompatInfo/Reference/spl.php',
            'PHP_CompatInfo_Reference_SQLite'
                => 'PHP/CompatInfo/Reference/sqlite.php',
            'PHP_CompatInfo_Reference_Sqlite3'
                => 'PHP/CompatInfo/Reference/sqlite3.php',
            'PHP_CompatInfo_Reference_Session'
                => 'PHP/CompatInfo/Reference/session.php',
            'PHP_CompatInfo_Reference_Shmop'
                => 'PHP/CompatInfo/Reference/shmop.php',
            'PHP_CompatInfo_Reference_SimpleXML'
                => 'PHP/CompatInfo/Reference/simplexml.php',
            'PHP_CompatInfo_Reference_Sockets'
                => 'PHP/CompatInfo/Reference/sockets.php',
            'PHP_CompatInfo_Reference_Ssh2'
                => 'PHP/CompatInfo/Reference/ssh2.php',
            'PHP_CompatInfo_Reference_Standard'
                => 'PHP/CompatInfo/Reference/standard.php',
            'PHP_CompatInfo_Reference_Sysvmsg'
                => 'PHP/CompatInfo/Reference/sysvmsg.php',
            'PHP_CompatInfo_Reference_Sysvsem'
                => 'PHP/CompatInfo/Reference/sysvsem.php',
            'PHP_CompatInfo_Reference_Sysvshm'
                => 'PHP/CompatInfo/Reference/sysvshm.php',
            'PHP_CompatInfo_Reference_Tidy'
                => 'PHP/CompatInfo/Reference/tidy.php',
            'PHP_CompatInfo_Reference_Tokenizer'
                => 'PHP/CompatInfo/Reference/tokenizer.php',
            'PHP_CompatInfo_Reference_Wddx'
                => 'PHP/CompatInfo/Reference/wddx.php',
            'PHP_CompatInfo_Reference_Xdebug'
                => 'PHP/CompatInfo/Reference/xdebug.php',
            'PHP_CompatInfo_Reference_Xhprof'
                => 'PHP/CompatInfo/Reference/xhprof.php',
            'PHP_CompatInfo_Reference_Xml'
                => 'PHP/CompatInfo/Reference/xml.php',
            'PHP_CompatInfo_Reference_Xmlreader'
                => 'PHP/CompatInfo/Reference/xmlreader.php',
            'PHP_CompatInfo_Reference_Xmlwriter'
                => 'PHP/CompatInfo/Reference/xmlwriter.php',
            'PHP_CompatInfo_Reference_Xmlrpc'
                => 'PHP/CompatInfo/Reference/xmlrpc.php',
            'PHP_CompatInfo_Reference_Xsl'
                => 'PHP/CompatInfo/Reference/xsl.php',
            'PHP_CompatInfo_Reference_Zip'
                => 'PHP/CompatInfo/Reference/zip.php',
            'PHP_CompatInfo_Reference_Zlib'
                => 'PHP/CompatInfo/Reference/zlib.php',
        );
        $path = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;
    }

    if (isset($classes[$className])) {
        include $path . $classes[$className];
    } elseif (substr($className, 0, 19) == 'Console_CommandLine') {
        include str_replace('_', '/', $className) . '.php';
    }
}

spl_autoload_register('phpCompatInfo_autoload');

require_once 'ezc/Base/base.php';
spl_autoload_register(array('ezcBase', 'autoload'));

require_once 'Bartlett/PHP/Reflect/Autoload.php';
