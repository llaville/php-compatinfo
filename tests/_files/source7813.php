<?php
/**
 * A package to make adding self updating functionality to other
 * packages easy.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   PEAR
 * @package    PEAR_PackageUpdate
 * @author     Scott Mattocks
 * @copyright  2006 Scott Mattocks
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    CVS: $Id: PackageUpdate.php,v 1.1 2008/02/02 15:09:40 farell Exp $
 * @link       http://pear.php.net/package/PEAR_PackageUpdate
 * @since      File available since Release 0.4.0a1
 */

require_once 'PEAR/ErrorStack.php';
require_once 'PEAR/Config.php';

// Constants for preferences.
define('PEAR_PACKAGEUPDATE_PREF_NOUPDATES',   0);
define('PEAR_PACKAGEUPDATE_PREF_NEXTRELEASE', 1);
define('PEAR_PACKAGEUPDATE_PREF_TYPE',        2);
define('PEAR_PACKAGEUPDATE_PREF_STATE',       3);

// Constants for states.
define('PEAR_PACKAGEUPDATE_STATE_DEVEL',  'devel');
define('PEAR_PACKAGEUPDATE_STATE_ALPHA',  'alpha');
define('PEAR_PACKAGEUPDATE_STATE_BETA',   'beta');
define('PEAR_PACKAGEUPDATE_STATE_STABLE', 'stable');

// Constants for release types.
define('PEAR_PACKAGEUPDATE_TYPE_BUG',   'bug');
define('PEAR_PACKAGEUPDATE_TYPE_MINOR', 'minor');
define('PEAR_PACKAGEUPDATE_TYPE_MAJOR', 'major');

// Constants for errors.
define('PEAR_PACKAGEUPDATE_ERROR_NOPACKAGE',            -1);
define('PEAR_PACKAGEUPDATE_ERROR_NOCHANNEL',            -2);
define('PEAR_PACKAGEUPDATE_ERROR_NOINFO',               -3);
define('PEAR_PACKAGEUPDATE_ERROR_NOTINSTALLED',         -4);
define('PEAR_PACKAGEUPDATE_ERROR_PREFFILE_READACCESS',  -5);
define('PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEACCESS', -6);
define('PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEERROR',  -7);
define('PEAR_PACKAGEUPDATE_ERROR_PREFFILE_CORRUPTED',   -8);
define('PEAR_PACKAGEUPDATE_ERROR_INVALIDTYPE',          -9);
define('PEAR_PACKAGEUPDATE_ERROR_INVALIDSTATE',         -10);
define('PEAR_PACKAGEUPDATE_ERROR_INVALIDPREF',          -11);
define('PEAR_PACKAGEUPDATE_ERROR_NONEXISTENTDRIVER',    -12);

// Error messages.
$GLOBALS['_PEAR_PACKAGEUPDATE_ERRORS'] =
    array(
        PEAR_PACKAGEUPDATE_ERROR_NOPACKAGE =>
            'No package name provided',
        PEAR_PACKAGEUPDATE_ERROR_NOCHANNEL =>
            'No channel name provided',
        PEAR_PACKAGEUPDATE_ERROR_NOINFO =>
            'No update information is available for %packagename%.',
        PEAR_PACKAGEUPDATE_ERROR_NOTINSTALLED =>
            '%packagename% is not installed. It cannot be updated.',
        PEAR_PACKAGEUPDATE_ERROR_PREFFILE_READACCESS =>
            'Preferences cannot be read from %file%.',
        PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEACCESS =>
            'Preferences cannot be written to %file% because of access permission errors.',
        PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEERROR =>
            'An error occurred while trying to write the preferences to %file%.',
        PEAR_PACKAGEUPDATE_ERROR_PREFFILE_CORRUPTED =>
            'Preferences file is corrupted.',
        PEAR_PACKAGEUPDATE_ERROR_INVALIDTYPE =>
            'Invalid release type: %type%',
        PEAR_PACKAGEUPDATE_ERROR_INVALIDSTATE =>
            'Invalid release state: %state%',
        PEAR_PACKAGEUPDATE_ERROR_INVALIDPREF =>
            'Invalid preference: %preference%',
        PEAR_PACKAGEUPDATE_ERROR_NONEXISTENTDRIVER =>
            'Driver %drivername% could not be found.'
    );

/**
 * The package allows a developer to add a few lines of code to
 * their existing packages and have the ability to update their
 * package automatically. This auto-update ability allows users
 * to stay up to date much more easily than requiring them to
 * update manually.
 *
 * This package keeps track of user preferences such as "don't
 * remind me again".
 *
 * This package is designed to be a backend to different front
 * ends written for this package. For example, this package can
 * be used to drive a PHP-GTK 2, CLI or web front end. The API
 * for this package should be flexible enough to allow any type
 * of front end to be used and also to allow the package to be
 * used directly in another package without a front end driver.
 *
 * The interface for this package must allow for the following
 * functionality:
 * - check to see if a new version is available for a given
 *   package on a given channel
 *   - check minimum state
 * - present information regarding the upgrade (version, size)
 *   - inform user about dependencies
 * - allow user to confirm or cancel upgrade
 * - download and install the package
 * - track preferences on a per package basis
 *   - don't ask again
 *   - don't ask until next release
 *   - only ask for state XXXX or higher
 *   - bug/minor/major updates only
 * - update channel automatically
 * - force application to exit when upgrade complete
 *   - PHP-GTK/CLI apps must exit to allow classes to reload
 *   - web front end could send headers to reload certain page
 *
 * This class is simply a wrapper for PEAR classes that actually
 * do the work.
 *
 * EXAMPLE:
 * <code>
 * <?php
 *  class Goo {
 *      function __construct()
 *      {
 *          // Check for updates...
 *          require_once 'PEAR/PackageUpdate.php';
 *          $ppu =& PEAR_PackageUpdate::factory('Gtk2', 'Goo', 'pear');
 *          if ($ppu !== false) {
 *              if ($ppu->checkUpdate()) {
 *                  // Use a dialog window to ask permission to update.
 *                  if ($ppu->presentUpdate()) {
 *                      if ($ppu->update()) {
 *                          // If the update succeeded, the application should
 *                          // be restarted.
 *                          $ppu->forceRestart();
 *                      }
 *                  }
 *              }
 *          }
 *          // ...
 *      }
 *      // ...
 *  }
 * ?>
 * </code>
 *
 * @category   PEAR
 * @package    PEAR_PackageUpdate
 * @author     Scott Mattocks
 * @copyright  2006 Scott Mattocks
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 0.5.0
 * @link       http://pear.php.net/package/PEAR_PackageUpdate
 * @since      Class available since Release 0.4.0a1
 */

class PEAR_PackageUpdate
{
    /**
     * The user's update preferences.
     *
     * @access public
     * @var    array
     * @since  0.4.0a1
     */
    var $preferences = array();

    /**
     * The name of the package.
     *
     * @access public
     * @var    string
     * @since  0.4.0a1
     */
    var $packageName;

    /**
     * The channel the package is hosted on.
     *
     * @access public
     * @var    string
     * @since  0.4.0a1
     */
    var $channel;

    /**
     * The latest version available for the given package.
     *
     * @access public
     * @var    string
     * @since  0.4.0a1
     */
    var $latestVersion;

    /**
     * Information about the latest version of the package.
     *
     * @access public
     * @var    array
     * @since  0.4.0a1
     */
    var $info = array();

    /**
     * The current installed version of the package.
     *
     * @access public
     * @var    string
     * @since  0.4.0a1
     */
    var $instVersion;

    /**
     * A collection of errors that have occurred.
     *
     * @access public
     * @var    object
     * @since  0.4.0a1
     */
    var $errors;

    /**
     * PHP 4 style constructor. Calls the PHP 5 style constructor.
     *
     * @access public
     * @param  string $packageName The package to update.
     * @param  string $channel     The channel the package resides on.
     * @return void
     * @since  0.4.0a1
     */
    function PEAR_PackageUpdate($packageName, $channel)
    {
        PEAR_PackageUpdate::__construct($packageName, $channel);
    }

    /**
     * PHP 5 style constructor. Loads the user preferences.
     *
     * @access public
     * @param  string $packageName The package to update.
     * @param  string $channel     The channel the package resides on.
     * @return void
     * @since  0.4.0a1
     */
    function __construct($packageName, $channel)
    {
        // Create a pear error stack.
        $this->errors =& PEAR_ErrorStack::singleton(get_class($this));
        $this->errors->setContextCallback(array(&$this, '_getBacktrace'));

        // Set the package name and channel.
        $this->packageName = $packageName;
        $this->channel     = $channel;

        // Load the user's preferences.
        $this->loadPreferences();
    }

    /**
     * Callback that generates context information (location of error)
     * for the package error stack.
     *
     * @access private
     * @return mixed  backtrace context array or false is unavailable
     * @since  0.4.3
     */
    function _getBacktrace()
    {
        if (function_exists('debug_backtrace')) {
            $backtrace = debug_backtrace();
            $backtrace = $backtrace[count($backtrace)-1];
        } else {
            $backtrace = false;
        }
        return $backtrace;
    }

    /**
     * Creates an instance of the given update class.
     *
     * @access public
     * @param  string $driver The type of PPU to create.
     * @param  string $packageName The package to update.
     * @param  string $channel     The channel the package resides on.
     * @return object An instance of type PEAR_PackageUpdate_$driver
     * @since  0.4.0a1
     * @throws PEAR_PACKAGEUPDATE_ERROR_NONEXISTENTDRIVER
     */
    function &factory($driver, $packageName, $channel)
    {
        $class = 'PEAR_PackageUpdate_' . $driver;

        // Attempt to include a custom version of the named class, but don't treat
        // a failure as fatal.  The caller may have already included their own
        // version of the named class.
        if (!class_exists($class)) {

            // Try to include the driver.
            $file = 'PEAR/PackageUpdate/' . $driver . '.php';

            if (!PEAR_PackageUpdate::isIncludable($file)) {
                PEAR_ErrorStack::staticPush('PEAR_PackageUpdate',
                                            PEAR_PACKAGEUPDATE_ERROR_NONEXISTENTDRIVER,
                                            null,
                                            array('drivername' => $driver),
                                            $GLOBALS['_PEAR_PACKAGEUPDATE_ERRORS'][PEAR_PACKAGEUPDATE_ERROR_NONEXISTENTDRIVER]
                                            );
                // Must assign a variable to avoid notice about references.
                $false = false;
                return $false;
            }
            include_once $file;
        }

        // See if the class exists now.
        if (!class_exists($class)) {
            // Must assign a variable to avoid notice about references.
            $false = false;
            return $false;
        }

        // Try to instantiate the class.
        $instance =& new $class($packageName, $channel);
        return $instance;
    }

    /**
     * Returns whether or not a path is in the include path.
     *
     * @static
     * @access public
     * @param  string  $path
     * @return boolean true if the path is in the include path.
     * @since  0.4.2
     */
    function isIncludable($path)
    {
        // Break up the include path and check to see if the path is readable.
        foreach (explode(PATH_SEPARATOR, get_include_path()) as $ip) {
            if (file_exists($ip . DIRECTORY_SEPARATOR . $path) &&
                is_readable($ip . DIRECTORY_SEPARATOR . $path)
                ) {
                return true;
            }
        }

        // If we got down here, the path is not readable from the include path.
        return false;
    }

    /**
     * Loads the user's preferences from a file.
     *
     * The preferences are stored in the user's home directory
     * as the file .ppurc. The file contains a serialized array
     * of preferences for each package that has been checked for
     * updates so far.
     *
     * @access protected
     * @return boolean   true on success, false on error
     * @since  0.4.0a1
     * @throws PEAR_PACKAGEUPDATE_ERROR_PREFFILE_READACCESS,
     *         PEAR_PACKAGEUPDATE_ERROR_PREFFILE_CORRUPTED
     */
    function loadPreferences()
    {
        // Get the preferences file.
        $prefFile = $this->determinePrefFile();

        // Make sure the prefFile exists.
        if (!@file_exists($prefFile)) {
            // Try to create it by saving the current preferences (probably
            // just an empty array).
            $this->savePreferences();
        }

        // Make sure the prefFile is readable.
        if (!@is_readable($prefFile)) {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_PREFFILE_READACCESS,
                             NULL, array('file' => $prefFile)
                             );
            return false;
        }

        // Get the contents of the prefFile.
        $contents = file_get_contents($prefFile);

        // Unserialize the data.
        $preferences = unserialize($contents);

        // Make sure the contents were unserialized properly.
        // Borrowed from PEAR_Config.
        if (!$preferences && strlen($contents) > 7) {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_PREFFILE_CORRUPTED);
            return false;
        }

        $this->preferences = $preferences;

        return true;
    }

    /**
     * Returns the path to the preferences file.
     *
     * @access protected
     * @return string
     * @since  0.4.0a1
     */
    function determinePrefFile()
    {
        // Determine the preferences file.
        // Borrowed from PEAR_Config

        $ds = DIRECTORY_SEPARATOR;
        if (OS_WINDOWS) {
            $prefFile = PEAR_CONFIG_SYSCONFDIR . $ds . 'ppurc.ini';
        } else {
            $prefFile = getenv('HOME') . $ds . '.ppurc';
        }

        return $prefFile;
    }

    /**
     * Checks to see if an update is available.
     *
     * Respects the user preferences when determining if an
     * update is avaiable. Returns true if an update is available
     * and the user may want to update the package.
     *
     * @access public
     * @return boolean true if an update is available.
     * @since  0.4.0a1
     */
    function checkUpdate()
    {
        // Check to see if an update is available.
        if (empty($this->latestVersion) || empty ($this->info)) {
            if (!$this->getPackageInfo()) {
                return false;
            }
        }

        // See if the installed version is older than the current version.
        if (version_compare($this->latestVersion, $this->instVersion, '>')) {
            // Check to see if the user's preferences allow an update.
            if (!$this->preferencesAllowUpdate()) {
                // User doesn't want to update to the latest version.
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns the latest information about the given package.
     *
     * @access protected
     * @return boolean   true on success, false on error
     * @since  0.4.0a1
     * @throws PEAR_PACKAGEUPDATE_ERROR_NOPACKAGE,
     *         PEAR_PACKAGEUPDATE_ERROR_NOCHANNEL,
     *         PEAR_PACKAGEUPDATE_ERROR_NOINFO
     */
    function getPackageInfo()
    {
        // Only check once.
        if (isset($this->latestVersion) && isset($this->info)) {
            return true;
        }

        // Make sure the channel and package are set.
        if (empty($this->packageName)) {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_NOPACKAGE);
            return false;
        }

        if (empty($this->channel)) {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_NOCHANNEL);
            return false;
        }

        // Create a config object.
        $config = new PEAR_Config();

        // Get the config's registry object.
        $reg = $config->getRegistry();

        // Parse the package name.
        $parsed = $reg->parsePackageName($this->channel . '/' . $this->packageName);

        // Check for errors.
        if (PEAR::isError($parsed)) {
            $this->pushError($parsed);
            return false;
        }

        // Get a PEAR_Remote instance.
        $r = $config->getRemote();

        // Get the package info.
        $info = $r->call('package.info', $parsed['package']);

        // Check to make sure the package was found.
        if (PEAR::isError($info)) {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_NOINFO, NULL,
                             array('packagename' => $this->packageName)
                             );
            return false;
        }

        // Get the installed version of the package.
        $this->instVersion = $reg->packageInfo($parsed['package'],
                                               'version',
                                               $parsed['channel']
                                               );

        // If the package is not installed, create a dummy version.
        if (empty($this->instVersion)) {
            $this->instVersion = '0.0.0';
        }

        // Pull out the latest information.
        $this->latestVersion = reset(array_keys($info['releases']));
        $this->info          = reset($info['releases']);

        return true;
    }

    /**
     * Returns the preferences associated with the given package.
     *
     * The preferences returned are an array with the folling values:
     * - don't ask again
     * - don't ask until next version
     * - only ask for state x
     * - bug/minor/major updates only
     *
     * @access public
     * @return array
     * @since  0.4.0a1
     */
    function getPackagePreferences()
    {
        if (isset($this->preferences[$this->channel][$this->packageName])) {
            return $this->preferences[$this->channel][$this->packageName];
        } else {
            return array();
        }
    }

    /**
     * Saves the current prefernces to the RC file.
     *
     * @access public
     * @return boolean true on success, false on error
     * @since  0.4.0a1
     * @throws PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEACCESS,
     *         PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEERROR
     */
    function savePreferences()
    {
        // Get the file to save the preferences to.
        $prefFile = $this->determinePrefFile();

        // Open the file for writing.
        $fp = fopen($prefFile, 'w');
        if ($fp === false) {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEACCESS,
                             NULL, array('file' => $prefFile)
                             );
            return false;
        }

        // Serialize the contents.
        $serialCont = serialize($this->preferences);

        // Write the contents to the file.
        if (fwrite($fp, $serialCont) === false) {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEERROR,
                             NULL, array('file' => $prefFile)
                             );
            return false;
        }

        // Close the file.
        if (!fclose($fp)) {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEERROR,
                             NULL, array('file' => $prefFile)
                             );
            return false;
        } else {
            return true;
        }
    }

    /**
     * Returns whether or not the user's preferences will allow an update to
     * take place.
     *
     * The user's preferences may define restrictions such as:
     *   - don't update
     *   - don't ask until next version (remembers last version asked)
     *   - only ask for state XXXX or higher
     *   - minor or higher (no bug fix)
     *   - major only
     *
     * @access public
     * @return boolean true if the preferences will allow an update for the
     *                 latest version.
     * @since  0.4.0a1
     */
    function preferencesAllowUpdate()
    {
        // Get the preferences for the package.
        $prefs = $this->getPackagePreferences();

        // Check to see if the user wants to be notified about any updates for
        // this package.
        if (isset($prefs[PEAR_PACKAGEUPDATE_PREF_NOUPDATES]) &&
            $prefs[PEAR_PACKAGEUPDATE_PREF_NOUPDATES]
            ) {
            return false;
        }

        // Check to see if the user has requested not to be asked until a new
        // version is released.
        if (isset($prefs[PEAR_PACKAGEUPDATE_PREF_NEXTRELEASE]) &&
            !version_compare($this->latestVersion,
                             $prefs[PEAR_PACKAGEUPDATE_PREF_NEXTRELEASE],
                             '>')
            ) {
            return false;
        }

        // Check to see if the user has requested not to be asked about the
        // state of the latest release.
        // Create an array of states.
        $states = array(PEAR_PACKAGEUPDATE_STATE_DEVEL  => 0,
                        PEAR_PACKAGEUPDATE_STATE_ALPHA  => 1,
                        PEAR_PACKAGEUPDATE_STATE_BETA   => 2,
                        PEAR_PACKAGEUPDATE_STATE_STABLE => 3
                        );
        if (isset($prefs[PEAR_PACKAGEUPDATE_PREF_STATE]) &&
            $states[$prefs[PEAR_PACKAGEUPDATE_PREF_STATE]] > $states[$this->info['state']]
            ) {
            return false;
        }

        // Check to see if the user only wants to be asked about a certain
        // type of release (minor|major).
        // Create an array for the types of releases.
        $releases = array(PEAR_PACKAGEUPDATE_TYPE_BUG   => 0,
                          PEAR_PACKAGEUPDATE_TYPE_MINOR => 1,
                          PEAR_PACKAGEUPDATE_TYPE_MAJOR => 2
                          );
        if (isset($prefs[PEAR_PACKAGEUPDATE_PREF_TYPE]) &&
            $releases[$prefs[PEAR_PACKAGEUPDATE_PREF_TYPE]] > $releases[$this->releaseType()]
            ) {
            return false;
        }

        // If we got down here, either there are no preferences for this
        // package or everything checked out.
        return true;
    }

    /**
     * Returns the type of release. (bug|minor|major);
     *
     * @access protected
     * @return string
     * @since  0.4.0a1
     */
    function releaseType()
    {
        // Break the two versions into pieces.
        $latest  = explode('.', $this->latestVersion);
        $current = explode('.', $this->instVersion);

        if ($latest[0] > $current[0]) {
            $type = PEAR_PACKAGEUPDATE_TYPE_MAJOR;
        } elseif ($latest[1] > $current[1]) {
            $type = PEAR_PACKAGEUPDATE_TYPE_MINOR;
        } else {
            $type = PEAR_PACKAGEUPDATE_TYPE_BUG;
        }

        return $type;
    }

    /**
     * Sets the user's preference for asking about all updates for this
     * package.
     *
     * @access public
     * @param  boolean $dontAsk
     * @return boolean true on success, false on failure
     * @since  0.4.0a1
     */
    function setDontAskAgain($dontAsk)
    {
        // Make sure the value is a boolean.
        settype($dontAsk, 'boolean');

        // Set the preference.
        return $this->setPreference(PEAR_PACKAGEUPDATE_PREF_NOUPDATES, $dontAsk);
    }

    /**
     * Sets the user's preference for asking about updates again until the next
     * release.
     *
     * @access public
     * @param  boolean $nextrelease
     * @return boolean true on success, false on failure
     * @since  0.4.0a1
     * @throws PEAR_PACKAGEUPDATE_ERROR_NOINFO
     */
    function setDontAskUntilNextRelease($nextrelease)
    {
        // If nextrelease is true, we have to swap its value out with the
        // latest version.
        if ($nextrelease) {
            // Make sure that the package info was found.
            if (empty($this->latestVersion)) {
                $this->pushError(PEAR_PACKAGEUPDATE_ERROR_NOINFO);
                return false;
            }
            $nextrelease = $this->latestVersion;
        }

        // Set the preference.
        return $this->setPreference(PEAR_PACKAGEUPDATE_PREF_NEXTRELEASE,
                                    $nextrelease);
    }

    /**
     * Sets the user's preference for asking about release types.
     *
     * @access public
     * @param  string  $minType The minimum release type to allow.
     * @return boolean true on success, false on failure
     * @since  0.4.0a1
     * @throws PEAR_PACKAGEUPDATE_ERROR_INVALIDTYPE
     */
    function setMinimumReleaseType($minType)
    {
        // Make sure the type is acceptable.
        if ($minType != PEAR_PACKAGEUPDATE_TYPE_BUG   &&
            $minType != PEAR_PACKAGEUPDATE_TYPE_MINOR &&
            $minType != PEAR_PACKAGEUPDATE_TYPE_MAJOR
            ) {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_INVALIDTYPE, NULL,
                             array('type' => $minType)
                             );
            return false;
        }

        // Set the preference.
        return $this->setPreference(PEAR_PACKAGEUPDATE_PREF_TYPE, $minType);
    }

    /**
     * Sets the user's preference for asking about release states.
     *
     * @access public
     * @param  string  $minState The minimum release state to allow.
     * @return boolean true on success, false on failure
     * @since  0.4.0a1
     * @throws PEAR_PACKAGEUPDATE_ERROR_INVALIDSTATE
     */
    function setMinimumState($minState)
    {
        // Make sure the type is acceptable.
        if ($minState != PEAR_PACKAGEUPDATE_STATE_DEVEL  &&
            $minState != PEAR_PACKAGEUPDATE_STATE_ALPHA  &&
            $minState != PEAR_PACKAGEUPDATE_STATE_BETA   &&
            $minState != PEAR_PACKAGEUPDATE_STATE_STABLE
            ) {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_INVALIDSTATE, NULL,
                             array('state' => $minState)
                             );
            return false;
        }

        // Set the preference.
        return $this->setPreference(PEAR_PACKAGEUPDATE_PREF_STATE, $minState);
    }

    /**
     * Sets the given preference to the given value.
     *
     * Don't take any chances. Anytime a preference is set, the preferences are
     * saved. We can't rely on the developer to call savePreferences.
     *
     * @access protected
     * @param  integer   $pref  One of the preference constants.
     * @param  mixed     $value The value of the preference.
     * @return boolean   true if the preference was set and saved properly.
     * @since  0.4.0a1
     * @throws PEAR_PACKAGEUPDATE_ERROR_INVALIDPREF
     */
    function setPreference($pref, $value)
    {
        // Make sure the preference is valid.
        if ($pref != PEAR_PACKAGEUPDATE_PREF_NOUPDATES   &&
            $pref != PEAR_PACKAGEUPDATE_PREF_NEXTRELEASE &&
            $pref != PEAR_PACKAGEUPDATE_PREF_TYPE        &&
            $pref != PEAR_PACKAGEUPDATE_PREF_STATE
            ) {
            // Invalid preference!
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_INVALIDPREF, NULL,
                             array('preference' => $pref)
                             );
            return false;
        }

        // Make sure the preferences for the channel exist.
        if (!isset($this->preferences[$this->channel])) {
            $this->preferences[$this->channel] = array();
        }

        // Make sure the preferences for the package exist.
        if (!isset($this->preferences[$this->channel][$this->packageName])) {
            $this->preferences[$this->channel][$this->packageName] = array();
        }

        // Set the preference value.
        $this->preferences[$this->channel][$this->packageName][$pref] = $value;

        // Save the preferences.
        return $this->savePreferences();
    }

    /**
     * Sets all preferences at once.
     *
     * @access public
     * @param  array   $preferences
     * @return boolean true if the preferences were set and saved.
     * @since  0.4.0a1
     */
    function setPreferences($preferences)
    {
        // Make sure preferences is an array.
        settype($preferences, 'array');

        // Make sure there is only valid preference information.
        foreach ($preferences as $pref => $value) {
            if ($pref != PEAR_PACKAGEUPDATE_PREF_NOUPDATES   &&
                $pref != PEAR_PACKAGEUPDATE_PREF_NEXTRELEASE &&
                $pref != PEAR_PACKAGEUPDATE_PREF_TYPE        &&
                $pref != PEAR_PACKAGEUPDATE_PREF_STATE
                ) {
                unset($preferences[$pref]);
            }
        }

        // Make sure that next release has the latest release.
        if ($preferences[PEAR_PACKAGEUPDATE_PREF_NEXTRELEASE]) {
            $preferences[PEAR_PACKAGEUPDATE_PREF_NEXTRELEASE] = $this->latestVersion;
        }

        // Set the preferences.
        $this->preferences[$this->channel][$this->packageName] = $preferences;

        // Save the preferences.
        return $this->savePreferences();
    }

    /**
     * Updates the source for the package.
     *
     * We have to update required dependencies automatically to make sure that
     * everything still works properly.
     *
     * It is the developers responsibility to make sure the user is given the
     * option to update any optional dependencies if needed. This can be done
     * by creating a new instance of PEAR_PackageUpdate for the optional
     * dependency.
     *
     * @access public
     * @return boolean true if the update was successful.
     * @since  0.4.0a1
     * @throws PEAR_PACKAGEUPDATE_ERROR_NOTINSTALLED
     */
    function update()
    {
        // Create a config object.
        $config  = new PEAR_Config();

        // Change the verbosity but keep track of the value to reset it just in
        // case this does something permanent.
        $verbose = $config->get('verbose');
        $config->set('verbose', 0);

        // Create a command object to do the upgrade.
        // If the current version is 0.0.0 don't upgrade. That would be a
        // sneaky way for devs to install packages without the use knowing.
        if ($this->instVersion == '0.0.0') {
            $this->pushError(PEAR_PACKAGEUPDATE_ERROR_NOTINSTALLED, NULL,
                             array('packagename' => $this->packageName)
                             );
            return false;
        }

        require_once 'PEAR/Command.php';
        $upgrade = PEAR_Command::factory('upgrade', $config);

        // Try to upgrade the application.
        $channelPackage = $this->channel . '/' . $this->packageName;
        $result = $upgrade->doInstall('upgrade',
                                      array('onlyreqdeps' => true),
                                      array($channelPackage));

        // Reset the verbose level just to be safe.
        $config->set('verbose', $verbose);

        // Check for errors.
        if (PEAR::isError($result)) {
            $this->pushError($result);
            return false;
        } else {
            return true;
        }
    }

    /**
     * Redirects or exits to force the user to restart the application.
     *
     * @abstract
     * @access public
     * @return void
     * @since  0.4.0a1
     */
    function forceRestart()
    {
        $this->pushError('forceRestart is an abstract method that must be' .
                         ' overridden in the child class.');
    }

    /**
     * Presents the user with the option to update.
     *
     * @abstract
     * @access public
     * @return boolean true if the user wants to update
     * @since  0.4.0a1
     */
    function presentUpdate()
    {
        $this->pushError('presentUpdate is an abstract method that must be' .
                         ' overridden in the child class.');

        // Return false just in case something odd has happened.
        return false;
    }

    /**
     * Pushes an error onto an error stack.
     *
     * This method is just for collecting errors that occur while checking for
     * updates and updating a package. The child class is responsible for
     * displaying all errors and handling them properly. This is because the
     * way errors are handled varies greatly depending on the driver used.
     *
     * @access public
     * @param int    $code      Package-specific error code
     * @param string $level     Error level.  This is NOT spell-checked
     * @param array  $params    associative array of error parameters
     * @param string $msg       Error message, or a portion of it if the
     *                          message is to be generated
     * @param array  $repackage If this error re-packages an error pushed by
     *                          another package, place the array returned from
     *                          {@link pop()} in this parameter
     * @param array  $backtrace Protected parameter: use this to pass in the
     *                          {@link debug_backtrace()} that should be used
     *                          to find error context
     * @return PEAR_Error|array|Exception
     *                          if compatibility mode is on, a PEAR_Error is
     *                          also thrown.  If the class Exception exists,
     *                          then one is returned.
     * @since  0.4.0a1
     */
    function pushError($code, $level = 'error', $params = array(),
                        $msg = false, $repackage = false, $backtrace = false)
    {
        // Check to see if a PEAR_Error was pushed.
        if (PEAR::isError($code)) {
            return $this->repackagePEAR_Error($code);
        }

        // Check the arguments to see if just a code was submitted.
        if (is_int($code) &&
            !(bool) $msg &&
            isset($GLOBALS['_PEAR_PACKAGEUPDATE_ERRORS'][$code])
            ) {
            $msg = $GLOBALS['_PEAR_PACKAGEUPDATE_ERRORS'][$code];
        }

        // Append the error onto the stack.
        return $this->errors->push($code, null, $params, $msg,
                                   $repackage, $backtrace
                                   );
    }

    /**
     * Repackages PEAR_Errors for use with ErrorStack.
     *
     * @author Ian Eure
     *
     * @access public
     * @param  object $error A PEAR_Error
     * @return mixed  The return from PEAR::ErrorStack::push()
     * @since  0.4.0a1
     */
    function repackagePEAR_Error(&$error)
    {
        static $map;
        if (!isset($map)) {
            $map = array(
                         E_ERROR            => 'error',
                         E_WARNING          => 'warning',
                         E_PARSE            => 'exception',
                         E_NOTICE           => 'notice',
                         E_CORE_ERROR       => 'error',
                         E_CORE_WARNING     => 'warning',
                         E_COMPILE_ERROR    => 'exception',
                         E_COMPILE_WARNING  => 'warning',
                         E_USER_ERROR       => 'error',
                         E_USER_WARNING     => 'warning',
                         E_USER_NOTICE      => 'notice'
                         );
        }

        // Strip this function from the trace
        if (is_array($error->backtrace)) {
            array_shift($error->backtrace);
            $error->userinfo['backtrace'] =& $error->backtrace;
        }

        return $this->errors->push($error->code, $map[$error->level],
                                   $error->userinfo, $error->message, false,
                                   $error->backtrace
                                   );
    }

    /**
     * Pops an error off the error stack.
     *
     * This method is just for collecting errors that occur while checking for
     * updates and updating a package. The child class is responsible for
     * displaying all errors and handling them properly. This is because the
     * way errors are handled varies greatly depending on the driver used.
     *
     * @access public
     * @return object A PEAR_Error instance or false if no errors exist.
     * @since  0.4.0a1
     */
    function popError()
    {
        return $this->errors->pop();
    }

    /**
     * Returns whether or not errors have occurred (and been captured).
     *
     * @access public
     * @return boolean
     * @since  0.4.0a1
     */
    function hasErrors()
    {
        return $this->errors->hasErrors();
    }
}
/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 */
?>