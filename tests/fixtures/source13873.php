<?php

/*======================================================================
Copyright Project Beehive Forum 2002

This file is part of Beehive Forum.

Beehive Forum is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

Beehive Forum is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Beehive; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307
USA
======================================================================*/

/* */

// We shouldn't be accessing this file directly.

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header("Request-URI: ../index.php");
    header("Content-Location: ../index.php");
    header("Location: ../index.php");
    exit;
}

include_once(BH_INCLUDE_PATH. "attachments.inc.php");
include_once(BH_INCLUDE_PATH. "constants.inc.php");
include_once(BH_INCLUDE_PATH. "db.inc.php");
include_once(BH_INCLUDE_PATH. "fixhtml.inc.php");
include_once(BH_INCLUDE_PATH. "folder.inc.php");
include_once(BH_INCLUDE_PATH. "form.inc.php");
include_once(BH_INCLUDE_PATH. "format.inc.php");
include_once(BH_INCLUDE_PATH. "header.inc.php");
include_once(BH_INCLUDE_PATH. "html.inc.php");
include_once(BH_INCLUDE_PATH. "install.inc.php");
include_once(BH_INCLUDE_PATH. "lang.inc.php");
include_once(BH_INCLUDE_PATH. "perm.inc.php");
include_once(BH_INCLUDE_PATH. "pm.inc.php");
include_once(BH_INCLUDE_PATH. "session.inc.php");
include_once(BH_INCLUDE_PATH. "stats.inc.php");
include_once(BH_INCLUDE_PATH. "text_captcha.inc.php");
include_once(BH_INCLUDE_PATH. "threads.inc.php");
include_once(BH_INCLUDE_PATH. "user.inc.php");
include_once(BH_INCLUDE_PATH. "word_filter.inc.php");

function get_forum_data()
{
    static $forum_data = false;

    if (!$db_get_forum_data = db_connect()) return false;

    if (($uid = bh_session_get_value('UID')) === false) return false;

    if (isset($_GET['webtag']) && strlen(trim(_stripslashes($_GET['webtag']))) > 0) {
        $webtag = trim(_stripslashes($_GET['webtag']));
    }elseif (isset($_POST['webtag']) && strlen(trim(_stripslashes($_POST['webtag']))) > 0) {
        $webtag = trim(_stripslashes($_POST['webtag']));
    }elseif (isset($_SERVER['argv'][1]) && strlen(trim(_stripslashes($_SERVER['argv'][1]))) > 0) {
        $webtag = trim(_stripslashes($_SERVER['argv'][1]));
    }

    if (!is_array($forum_data) || !isset($forum_data['WEBTAG']) || !isset($forum_data['PREFIX'])) {

        if (isset($webtag) && preg_match("/^[A-Z0-9_]+$/", $webtag) > 0) {

            // Check #1: See if the webtag specified in GET/POST
            // actually exists.

            $webtag = db_escape_string($webtag);

            $sql = "SELECT FORUMS.FID, FORUMS.WEBTAG, FORUMS.ACCESS_LEVEL, ";
            $sql.= "CONCAT(FORUMS.DATABASE_NAME, '.', FORUMS.WEBTAG, '_') AS PREFIX ";
            $sql.= "FROM FORUMS WHERE WEBTAG = '$webtag'";

            if ($result = db_query($sql, $db_get_forum_data)) {

                if (db_num_rows($result) > 0) {

                    $forum_data = db_fetch_array($result);

                    if (!isset($forum_data['ACCESS_LEVEL'])) $forum_data['ACCESS_LEVEL'] = 0;
                    if (!isset($forum_data['ALLOWED'])) $forum_data['ALLOWED'] = 0;

                    return $forum_data;
                }
            }

            return array('WEBTAG_SEARCH' => $webtag);

        }else {

            // Check #2: Try and select a default webtag from
            // the database

            $sql = "SELECT FORUMS.FID, FORUMS.WEBTAG, FORUMS.ACCESS_LEVEL, ";
            $sql.= "CONCAT(FORUMS.DATABASE_NAME, '.', FORUMS.WEBTAG, '_') AS PREFIX ";
            $sql.= "FROM FORUMS WHERE DEFAULT_FORUM = 1";

            if ($result = db_query($sql, $db_get_forum_data)) {

                if (db_num_rows($result) > 0) {

                    $forum_data = db_fetch_array($result);

                    if (!isset($forum_data['ACCESS_LEVEL'])) $forum_data['ACCESS_LEVEL'] = 0;
                    if (!isset($forum_data['ALLOWED'])) $forum_data['ALLOWED'] = 0;
                }
            }
        }
    }

    return $forum_data;
}

function get_webtag(&$webtag_search)
{
    $forum_data = get_forum_data();

    if (is_array($forum_data) && isset($forum_data['WEBTAG'])) {
        return $forum_data['WEBTAG'];
    }

    if (is_array($forum_data) && isset($forum_data['WEBTAG_SEARCH'])) {
        $webtag_search = $forum_data['WEBTAG_SEARCH'];
    }

    return false;
}

function get_table_prefix()
{
    $forum_data = get_forum_data();

    if (is_array($forum_data) && isset($forum_data['WEBTAG'])) {
        return $forum_data;
    }

    return false;
}

function forum_check_access_level()
{
    static $forum_data = false;

    if (!$db_forum_check_access_level = db_connect()) return false;

    if (($uid = bh_session_get_value('UID')) === false) return false;

    if (!$table_data = get_table_prefix()) return true;

    $forum_fid = $table_data['FID'];

    if (!is_array($forum_data) || !isset($forum_data['ACCESS_LEVEL']) || !isset($forum_data['ALLOWED'])) {

        $sql = "SELECT FORUMS.FID, FORUMS.ACCESS_LEVEL, USER_FORUM.ALLOWED FROM FORUMS ";
        $sql.= "LEFT JOIN USER_FORUM ON (USER_FORUM.FID = FORUMS.FID ";
        $sql.= "AND USER_FORUM.UID = '$uid') WHERE FORUMS.FID = '$forum_fid'";

        if (!$result = db_query($sql, $db_forum_check_access_level)) return false;

        if (db_num_rows($result) > 0) {

            $forum_data = db_fetch_array($result);
        }
    }

    if (isset($forum_data['ACCESS_LEVEL'])) {

        if ($forum_data['ACCESS_LEVEL'] < FORUM_UNRESTRICTED) {

            return forum_closed_message();

        }elseif ($forum_data['ACCESS_LEVEL'] == FORUM_RESTRICTED && $forum_data['ALLOWED'] <> FORUM_USER_ALLOWED) {

            return forum_restricted_message();

        }elseif ($forum_data['ACCESS_LEVEL'] == FORUM_PASSWD_PROTECTED) {

            return forum_check_password($forum_data['FID']);
        }
    }

    return true;
}

function forum_closed_message()
{
    $lang = load_language_file();

    html_draw_top();

    $forum_name = forum_get_setting('forum_name', false, 'A Beehive Forum');

    echo "<h1>{$lang['closed']}</h1>\n";

    if ($closed_message = forum_get_setting('closed_message', false)) {

        html_display_error_msg(fix_html($closed_message), '600', 'center');

    }else {

        html_display_error_msg(sprintf($lang['forumiscurrentlyclosed'], _htmlentities($forum_name)), '600', 'center');
    }

    if (bh_session_check_perm(USER_PERM_ADMIN_TOOLS, 0) || bh_session_check_perm(USER_PERM_FORUM_TOOLS, 0)) {

        html_display_warning_msg($lang['adminforumclosedtip'], '600', 'center');
    }

    html_draw_bottom();
    exit;
}

function forum_restricted_message()
{
    $lang = load_language_file();

    html_draw_top();

    $forum_name = forum_get_setting('forum_name', false, 'A Beehive Forum');

    echo "<h1>{$lang['restricted']}</h1>\n";

    if ($restricted_message = forum_get_setting('restricted_message', false)) {

        html_display_error_msg(fix_html($restricted_message), '600', 'center');

    }else {

        html_display_error_msg(sprintf($lang['youdonothaveaccesstoforum'], _htmlentities($forum_name)), '600', 'center');
        html_display_warning_msg($lang['toapplyforaccessplease'], '600', 'center');
    }

    if (bh_session_check_perm(USER_PERM_ADMIN_TOOLS, 0) || bh_session_check_perm(USER_PERM_FORUM_TOOLS, 0)) {

        html_display_warning_msg($lang['adminforumclosedtip'], '600', 'center');
    }

    html_draw_bottom();
    exit;
}

function forum_get_password($forum_fid)
{
    if (!$db_forum_get_password = db_connect()) return false;

    if (!is_numeric($forum_fid)) return false;

    $sql = "SELECT FORUM_PASSWD FROM FORUMS WHERE FID = '$forum_fid'";

    if (!$result = db_query($sql, $db_forum_get_password)) return false;

    if (db_num_rows($result) > 0) {

        list($forum_passwd) = db_fetch_array($result, DB_RESULT_NUM);
        return is_md5($forum_passwd) ? $forum_passwd : false;
    }

    return false;
}

function forum_get_saved_password(&$password, &$passhash, &$sesshash)
{
    $webtag = get_webtag($webtag_search);

    if (isset($_COOKIE["bh_{$webtag}_password"]) && strlen(_stripslashes($_COOKIE["bh_{$webtag}_password"])) > 0) {
        $password = _stripslashes($_COOKIE["bh_{$webtag}_password"]);
    }else {
        $password = "";
    }

    if (isset($_COOKIE["bh_{$webtag}_passhash"]) && is_md5($_COOKIE["bh_{$webtag}_passhash"])) {
        $passhash = trim(_stripslashes($_COOKIE["bh_{$webtag}_passhash"]));
    }else {
        $passhash = "";
    }

    if (isset($_COOKIE["bh_{$webtag}_sesshash"]) && is_md5($_COOKIE["bh_{$webtag}_sesshash"])) {
        $sesshash = trim(_stripslashes($_COOKIE["bh_{$webtag}_sesshash"]));
    }else {
        $sesshash = "";
    }

    return true;
}

function forum_check_password($forum_fid)
{
    $frame_top_target = html_get_top_frame_name();

    if (!$db_forum_check_password = db_connect()) return false;

    $webtag = get_webtag($webtag_search);

    if (!is_numeric($forum_fid)) return false;

    if ($forum_passhash = forum_get_password($forum_fid)) {

        forum_get_saved_password($password, $passhash, $sesshash);

        if ($sesshash == $forum_passhash) return true;

        // If we got this far then the password verification failed or
        // the user hasn't seen the password dialog before.

        $lang = load_language_file();

        html_draw_top();

        echo "<h1>{$lang['passwdprotectedforum']}</h1>\n";

        if (isset($_COOKIE["bh_{$webtag}_sesshash"]) && strlen(trim(_stripslashes($_COOKIE["bh_{$webtag}_sesshash"]))) > 0) {

            bh_setcookie("bh_{$webtag}_sesshash", "", time() - YEAR_IN_SECONDS);
            html_display_error_msg($lang['usernameorpasswdnotvalid'], '550', 'center');
        }

        echo "<br />\n";
        echo "<div align=\"center\">\n";
        echo "  <form method=\"post\" action=\"forum_password.php\" target=\"", html_get_top_frame_name(), "\">\n";
        echo "    ", form_input_hidden('webtag', _htmlentities($webtag)), "\n";
        echo "    ", form_input_hidden('final_uri', _htmlentities(get_request_uri())), "\n";
        echo "    <table cellpadding=\"0\" cellspacing=\"0\" width=\"550\">\n";

        if ($password_protected_message = forum_get_setting('password_protected_message', false)) {

            echo "      <tr>\n";
            echo "        <td align=\"left\">", fix_html($password_protected_message), "</td>\n";
            echo "      </tr>\n";

        }else {

            echo "      <tr>\n";
            echo "        <td align=\"center\">{$lang['passwdprotectedwarning']}</td>\n";
            echo "      </tr>\n";
        }

        echo "      <tr>\n";
        echo "        <td align=\"left\">&nbsp;</td>\n";
        echo "      </tr>\n";
        echo "      <tr>\n";
        echo "        <td align=\"center\">\n";
        echo "          <table class=\"box\" width=\"400\">\n";
        echo "            <tr>\n";
        echo "              <td class=\"posthead\" align=\"center\">\n";
        echo "                <table class=\"posthead\" width=\"100%\">\n";
        echo "                  <tr>\n";
        echo "                    <td align=\"left\" class=\"subhead\" colspan=\"2\">{$lang['enterpasswd']}</td>\n";
        echo "                  </tr>\n";
        echo "                </table>\n";
        echo "                <table class=\"posthead\" width=\"90%\">\n";
        echo "                  <tr>\n";
        echo "                    <td align=\"left\">{$lang['passwd']}:</td>\n";
        echo "                    <td align=\"left\">", form_input_password('forum_password', _htmlentities($password), 40, false, "autocomplete=\"off\""), form_input_hidden("forum_passhash", _htmlentities($passhash)), "</td>\n";
        echo "                  </tr>\n";
        echo "                  <tr>\n";
        echo "                    <td align=\"left\">&nbsp;</td>\n";
        echo "                    <td align=\"left\">", form_checkbox('remember_password', 'Y', $lang['rememberpassword'], (strlen($password) > 0 && strlen($passhash) > 0)), "</td>\n";
        echo "                  </tr>\n";
        echo "                  <tr>\n";
        echo "                    <td align=\"left\" colspan=\"2\">&nbsp;</td>\n";
        echo "                  </tr>\n";
        echo "                </table>\n";
        echo "              </td>\n";
        echo "            </tr>\n";
        echo "          </table>\n";
        echo "        </td>\n";
        echo "      </tr>\n";
        echo "      <tr>\n";
        echo "        <td align=\"left\">&nbsp;</td>\n";
        echo "      </tr>\n";
        echo "      <tr>\n";
        echo "        <td align=\"center\">", form_submit("submit", $lang['logon']), "&nbsp;", form_submit("cancel", $lang['cancel']), "</td>\n";
        echo "      </tr>\n";

        if (bh_session_check_perm(USER_PERM_ADMIN_TOOLS, 0) || bh_session_check_perm(USER_PERM_FORUM_TOOLS, 0)) {

            echo "      <tr>\n";
            echo "        <td align=\"left\">&nbsp;</td>\n";
            echo "      </tr>\n";
            echo "      <tr>\n";
            echo "        <td align=\"center\">{$lang['adminforumclosedtip']}</td>\n";
            echo "      </tr>\n";
        }

        echo "    </table>\n";
        echo "  </form>\n";
        echo "</div>\n";

        html_draw_bottom();
        exit;
    }

    return true;
}

function forum_get_settings()
{
    if (!$db_forum_get_settings = db_connect()) return false;

    static $forum_settings_array = false;

    if (!$table_data = get_table_prefix()) return false;

    $forum_fid = $table_data['FID'];

    if (!is_array($forum_settings_array)) {

        $forum_settings_array = array('fid' => $forum_fid);

        // Get the named settings from FORUM_SETTINGS table.

        $sql = "SELECT SNAME, SVALUE FROM FORUM_SETTINGS WHERE FID = '$forum_fid'";

        if (!$result = db_query($sql, $db_forum_get_settings)) return false;

        if (db_num_rows($result) > 0) {

            if (!is_array($forum_settings_array)) $forum_settings_array = array();

            while ($forum_data = db_fetch_array($result)) {

                $forum_settings_array[$forum_data['SNAME']] = $forum_data['SVALUE'];
            }
        }

        // Get the forum timezone, GMT offset and DST offset.

        $sql = "SELECT FORUM_SETTINGS.SVALUE, TIMEZONES.GMT_OFFSET, ";
        $sql.= "TIMEZONES.DST_OFFSET FROM FORUM_SETTINGS FORUM_SETTINGS ";
        $sql.= "LEFT JOIN TIMEZONES ON (TIMEZONES.TZID = FORUM_SETTINGS.SVALUE) ";
        $sql.= "WHERE FORUM_SETTINGS.SNAME = 'forum_timezone' ";
        $sql.= "AND FORUM_SETTINGS.FID = '$forum_fid'";

        if (!$result = db_query($sql, $db_forum_get_settings)) return false;

        if (db_num_rows($result) > 0) {

            if (!is_array($forum_settings_array)) $forum_settings_array = array();

            while ($forum_timezone_data = db_fetch_array($result)) {

                $forum_settings_array['forum_timezone'] = $forum_timezone_data['SVALUE'];
                $forum_settings_array['forum_gmt_offset'] = $forum_timezone_data['GMT_OFFSET'];
                $forum_settings_array['forum_dst_offset'] = $forum_timezone_data['DST_OFFSET'];
            }
        }

        // Get the WEBTAG and ACCESS_LEVEL

        $sql = "SELECT WEBTAG, ACCESS_LEVEL FROM FORUMS WHERE FID = '$forum_fid'";

        if (!$result = db_query($sql, $db_forum_get_settings)) return false;

        list($webtag, $access_level) = db_fetch_array($result, DB_RESULT_NUM);

        $forum_settings_array['webtag'] = $webtag;
        $forum_settings_array['access_level'] = $access_level;
    }

    return $forum_settings_array;
}

function forum_get_global_settings()
{
    if (!$db_forum_get_global_settings = db_connect()) return false;

    static $forum_global_settings_array = false;

    if (!is_array($forum_global_settings_array)) {

        $sql = "SELECT SNAME, SVALUE FROM FORUM_SETTINGS WHERE FID = '0'";

        if (!$result = db_query($sql, $db_forum_get_global_settings)) return false;

        if (db_num_rows($result) > 0) {

            if (!is_array($forum_global_settings_array)) $forum_global_settings_array = array();

            while ($forum_data = db_fetch_array($result)) {

                $forum_global_settings_array[$forum_data['SNAME']] = $forum_data['SVALUE'];
            }
        }

        $sql = "SELECT FORUM_SETTINGS.SVALUE, TIMEZONES.GMT_OFFSET, ";
        $sql.= "TIMEZONES.DST_OFFSET FROM FORUM_SETTINGS FORUM_SETTINGS ";
        $sql.= "LEFT JOIN TIMEZONES ON (TIMEZONES.TZID = FORUM_SETTINGS.SVALUE) ";
        $sql.= "WHERE FORUM_SETTINGS.SNAME = 'forum_timezone' ";
        $sql.= "AND FORUM_SETTINGS.FID = '0'";

        if (!$result = db_query($sql, $db_forum_get_global_settings)) return false;

        if (db_num_rows($result) > 0) {

            if (!is_array($forum_global_settings_array)) $forum_global_settings_array = array();

            while ($forum_timezone_data = db_fetch_array($result)) {

                $forum_global_settings_array['forum_timezone'] = $forum_timezone_data['SVALUE'];
                $forum_global_settings_array['forum_gmt_offset'] = $forum_timezone_data['GMT_OFFSET'];
                $forum_global_settings_array['forum_dst_offset'] = $forum_timezone_data['DST_OFFSET'];
            }
        }
    }

    return $forum_global_settings_array;
}

function forum_get_settings_by_fid($fid, $include_global_settings = true)
{
    if (!$db_forum_get_settings_by_fid = db_connect()) return false;

    if (!is_numeric($fid)) return false;

    $forum_settings_array = array('fid' => $fid);

    $sql = "SELECT WEBTAG, ACCESS_LEVEL FROM FORUMS WHERE FID = '$fid'";

    if (!$result = db_query($sql, $db_forum_get_settings_by_fid)) return false;

    list($webtag, $access_level) = db_fetch_array($result, DB_RESULT_NUM);

    $forum_settings_array['webtag'] = $webtag;
    $forum_settings_array['access_level'] = $access_level;

    $sql = "SELECT SNAME, SVALUE FROM FORUM_SETTINGS WHERE FID = '$fid'";

    if (!$result = db_query($sql, $db_forum_get_settings_by_fid)) return false;

    while ($forum_data = db_fetch_array($result)) {

        $forum_settings_array[$forum_data['SNAME']] = $forum_data['SVALUE'];
    }

    $sql = "SELECT FORUM_SETTINGS.SVALUE AS TIMEZONE, TIMEZONES.GMT_OFFSET, ";
    $sql.= "TIMEZONES.DST_OFFSET FROM FORUM_SETTINGS FORUM_SETTINGS ";
    $sql.= "LEFT JOIN TIMEZONES ON (TIMEZONES.TZID = FORUM_SETTINGS.SVALUE) ";
    $sql.= "WHERE FORUM_SETTINGS.SNAME = 'forum_timezone' ";
    $sql.= "AND FID = '$fid'";

    if (!$result = db_query($sql, $db_forum_get_settings_by_fid)) return false;

    list($timezone, $gmt_offset, $dst_offset) = db_fetch_array($result, DB_RESULT_NUM);

    $forum_settings_array['forum_timezone'] = $timezone;
    $forum_settings_array['forum_gmt_offset'] = $gmt_offset;
    $forum_settings_array['forum_dst_offset'] = $dst_offset;

    if ($include_global_settings === true) {

        $forum_global_settings = forum_get_global_settings();
        return array_merge($forum_global_settings, $forum_settings_array);
    }

    return $forum_settings_array;
}

function forum_save_settings($forum_settings_array)
{
    if (!is_array($forum_settings_array)) return false;

    if (!$db_forum_save_settings = db_connect()) return false;

    if (!$table_data = get_table_prefix()) return false;

    $forum_fid = $table_data['FID'];

    foreach ($forum_settings_array as $sname => $svalue) {

        if (forum_check_setting_name($sname)) {

            $sname  = db_escape_string($sname);
            $svalue = db_escape_string($svalue);

            $sql = "SELECT SVALUE FROM FORUM_SETTINGS WHERE FID = '$forum_fid' ";
            $sql.= "AND SNAME = '$sname'";

            if (!$result = db_query($sql, $db_forum_save_settings)) return false;

            if (db_num_rows($result) > 0) {

                $sql = "UPDATE LOW_PRIORITY FORUM_SETTINGS SET SVALUE = '$svalue' WHERE FID = '$forum_fid' ";
                $sql.= "AND SNAME = '$sname'";

                if (!$result = db_query($sql, $db_forum_save_settings)) return false;

            }else {

                $sql = "INSERT INTO FORUM_SETTINGS (FID, SNAME, SVALUE) ";
                $sql.= "VALUES ($forum_fid, '$sname', '$svalue')";

                if (!$result = db_query($sql, $db_forum_save_settings)) return false;
            }
        }
    }

    return true;
}

function forum_save_default_settings($forum_settings_array)
{
    if (!is_array($forum_settings_array)) return false;

    if (!$db_forum_save_default_settings = db_connect()) return false;

    foreach ($forum_settings_array as $sname => $svalue) {

        if (forum_check_global_setting_name($sname)) {

            $sname = db_escape_string($sname);
            $svalue = db_escape_string($svalue);

            $sql = "SELECT SVALUE FROM FORUM_SETTINGS WHERE FID = '0' ";
            $sql.= "AND SNAME = '$sname'";

            if (!$result = db_query($sql, $db_forum_save_default_settings)) return false;

            if (db_num_rows($result) > 0) {

                $sql = "UPDATE LOW_PRIORITY FORUM_SETTINGS SET SVALUE = '$svalue' WHERE FID = '0' ";
                $sql.= "AND SNAME = '$sname'";

                if (!$result = db_query($sql, $db_forum_save_default_settings)) return false;

            }else {

                $sql = "INSERT INTO FORUM_SETTINGS (FID, SNAME, SVALUE) ";
                $sql.= "VALUES ('0', '$sname', '$svalue')";

                if (!$result = db_query($sql, $db_forum_save_default_settings)) return false;
            }
        }
    }

    return true;
}

function forum_check_setting_name($setting_name)
{
    $valid_forum_settings = array('allow_polls', 'allow_post_editing', 'allow_search_spidering',
                                  'closed_message', 'default_emoticons', 'default_language',
                                  'default_style', 'enable_wiki_integration', 'enable_wiki_quick_links',
                                  'force_word_filter', 'forum_desc', 'forum_dl_saving', 'forum_email',
                                  'forum_keywords', 'forum_name', 'forum_timezone', 'guest_account_enabled',
                                  'guest_show_recent', 'maximum_post_length', 'minimum_post_frequency',
                                  'password_protected_message', 'poll_allow_guests', 'post_edit_grace_period',
                                  'post_edit_time', 'require_post_approval', 'restricted_message', 'show_links',
                                  'show_stats', 'wiki_integration_uri');

    return in_array($setting_name, $valid_forum_settings);
}

function forum_check_global_setting_name($setting_name)
{
    $valid_global_forum_settings = array('active_sess_cutoff', 'allow_new_registrations', 'allow_search_spidering',
                                         'allow_username_changes', 'attachments_allow_embed', 'attachments_enabled',
                                         'attachments_max_user_space', 'attachment_allow_guests', 'attachment_dir',
                                         'attachment_use_old_method', 'forum_desc', 'forum_email',
                                         'forum_keywords', 'forum_name', 'forum_noreply_email',
                                         'forum_rules_enabled', 'forum_rules_message', 'guest_account_enabled',
                                         'guest_show_recent', 'messages_unread_cutoff', 'messages_unread_cutoff_custom',
                                         'new_user_email_notify', 'new_user_mark_as_of_int', 'new_user_pm_notify_email',
                                         'pm_allow_attachments', 'pm_auto_prune', 'pm_max_user_messages',
                                         'require_email_confirmation', 'require_unique_email', 'require_user_approval',
                                         'search_min_frequency', 'session_cutoff', 'showpopuponnewpm', 'show_pms',
                                         'text_captcha_dir', 'text_captcha_enabled', 'text_captcha_key');

    return in_array($setting_name, $valid_global_forum_settings);
}

function forum_get_name($fid)
{
    if (!$db_forum_get_name = db_connect()) return false;

    if (!is_numeric($fid)) return "A Beehive Forum";

    $sql = "SELECT SVALUE AS FORUM_NAME FROM FORUM_SETTINGS ";
    $sql.= "WHERE SNAME = 'forum_name' AND FID = '$fid'";

    if (!$result = db_query($sql, $db_forum_get_name)) return false;

    if (db_num_rows($result) > 0) {

        list($forum_name) = db_fetch_array($result, DB_RESULT_NUM);
        return $forum_name;
    }

    return "A Beehive Forum";
}

function forum_get_webtag($fid)
{
    if (!$db_forum_get_webtag = db_connect()) return false;

    if (!is_numeric($fid)) return false;

    $sql = "SELECT WEBTAG FROM FORUMS WHERE FID = '$fid'";

    if (!$result = db_query($sql, $db_forum_get_webtag)) return false;

    if (db_num_rows($result) > 0) {

        list($forum_webtag) = db_fetch_array($result, DB_RESULT_NUM);
        return $forum_webtag;
    }

    return false;
}

function forum_get_table_prefix($fid)
{
    if (!$db_forum_get_webtag = db_connect()) return false;

    if (!is_numeric($fid)) return false;

    $sql = "SELECT CONCAT(FORUMS.DATABASE_NAME, '.', FORUMS.WEBTAG, '_') AS PREFIX, ";
    $sql.= "FID, WEBTAG FROM FORUMS WHERE FID = '$fid'";

    if (!$result = db_query($sql, $db_forum_get_webtag)) return false;

    if (db_num_rows($result) > 0) {

        $forum_data = db_fetch_array($result);
        return $forum_data;
    }

    return false;
}

function forum_get_setting($setting_name, $value = false, $default = false)
{
    $forum_settings = (isset($GLOBALS['forum_settings'])) ? $GLOBALS['forum_settings'] : false;
    $forum_global_settings = (isset($GLOBALS['forum_global_settings'])) ? $GLOBALS['forum_global_settings'] : false;

    if (is_array($forum_settings) && isset($forum_settings[$setting_name])) {

        if ($value !== false) {

            if (strtoupper($forum_settings[$setting_name]) == strtoupper($value)) {

                return true;
            }

        }else {

            return $forum_settings[$setting_name];
        }
    }

    if (is_array($forum_global_settings) && isset($forum_global_settings[$setting_name])) {

        if ($value !== false) {

            if (strtoupper($forum_global_settings[$setting_name]) == strtoupper($value)) {

                return true;
            }

        }else {

            return $forum_global_settings[$setting_name];
        }
    }

    return $default;
}

/**
* Get Unread Cutoff
*
* Retrieves and validates the current forum's unread cut-off value.
*
* @return mixed - False if unread messages are disabled or integer number of seconds the cut-off is set to.
* @param void
*/

function forum_get_unread_cutoff()
{
    // Array of valid Unread cutoff periods.

    $unread_cutoff_periods = array(THIRTY_DAYS_IN_SECONDS, SIXTY_DAYS_IN_SECONDS,
                                   NINETY_DAYS_IN_SECONDS, HUNDRED_EIGHTY_DAYS_IN_SECONDS,
                                   YEAR_IN_SECONDS);

    // Fetch the unread cutoff value

    $messages_unread_cutoff = forum_get_setting('messages_unread_cutoff');

    // If unread message support is disabled we return false.

    if ($messages_unread_cutoff == UNREAD_MESSAGES_DISABLED) return false;

    // If unread message support isn't disabled we should check that
    // It is a valid value and return it or return the default of one year.

    return in_array($messages_unread_cutoff, $unread_cutoff_periods) ? $messages_unread_cutoff : YEAR_IN_SECONDS;
}

/**
* Process Unread Cutoff
*
* Processes and validates a forum unread cut-off value saved in a settings array.
* Works the same as forum_get_unread_cutoff() but is intended to be passed an
* array of forum settings from forum_get_settings() or other.
*
* @return mixed - False if unread messages are disabled or integer number of seconds the cut-off is set to.
* @param void
*/

function forum_process_unread_cutoff($forum_settings)
{
    // Check the $forum_settings array.

    if (!is_array($forum_settings)) return YEAR_IN_SECONDS;

    // Array of valid Unread cutoff periods.

    $unread_cutoff_periods = array(THIRTY_DAYS_IN_SECONDS, SIXTY_DAYS_IN_SECONDS,
                                   NINETY_DAYS_IN_SECONDS, HUNDRED_EIGHTY_DAYS_IN_SECONDS,
                                   YEAR_IN_SECONDS);

    // Fetch the unread cutoff value from the settings array

    if (isset($forum_settings['messages_unread_cutoff'])) {
        $messages_unread_cutoff = $forum_settings['messages_unread_cutoff'];
    }else {
        $messages_unread_cutoff = YEAR_IN_SECONDS;
    }

    // If unread message support is disabled we return false.

    if ($messages_unread_cutoff == UNREAD_MESSAGES_DISABLED) return false;

    // If unread message support isn't disabled we should check that
    // It is a valid value and return it or return the default of one year.

    return in_array($messages_unread_cutoff, $unread_cutoff_periods) ? $messages_unread_cutoff : YEAR_IN_SECONDS;
}

function forum_update_unread_data($unread_cutoff_stamp)
{
    if (!$db_forum_update_unread_data = db_connect()) return false;

    if (!$table_data = get_table_prefix()) return false;

    if (!is_numeric($unread_cutoff_stamp)) return false;

    if ($unread_cutoff_stamp > 0) {

        if ($forum_prefix_array = forum_get_all_prefixes()) {

            foreach($forum_prefix_array as $forum_prefix) {

                $sql = "INSERT INTO {$forum_prefix}THREAD_STATS (TID, UNREAD_PID, UNREAD_CREATED) ";
                $sql.= "SELECT POST.TID, MAX(POST.PID), MAX(POST.CREATED) FROM {$forum_prefix}POST POST ";
                $sql.= "LEFT JOIN {$forum_prefix}THREAD_STATS THREAD_STATS ON (THREAD_STATS.TID = POST.TID) ";
                $sql.= "WHERE POST.CREATED < FROM_UNIXTIME(UNIX_TIMESTAMP(NOW()) - $unread_cutoff_stamp) ";
                $sql.= "AND (THREAD_STATS.UNREAD_PID < POST.PID OR THREAD_STATS.UNREAD_PID IS NULL) ";
                $sql.= "GROUP BY POST.TID ON DUPLICATE KEY UPDATE UNREAD_PID = VALUES(UNREAD_PID), ";
                $sql.= "UNREAD_CREATED = VALUES(UNREAD_CREATED)";

                if (!$result = db_query($sql, $db_forum_update_unread_data)) return false;

                $sql = "DELETE QUICK FROM {$forum_prefix}USER_THREAD ";
                $sql.= "USING {$forum_prefix}USER_THREAD ";
                $sql.= "LEFT JOIN {$forum_prefix}THREAD ";
                $sql.= "ON ({$forum_prefix}USER_THREAD.TID = ";
                $sql.= "{$forum_prefix}THREAD.TID) ";
                $sql.= "WHERE {$forum_prefix}THREAD.MODIFIED IS NOT NULL ";
                $sql.= "AND {$forum_prefix}THREAD.MODIFIED < ";
                $sql.= "FROM_UNIXTIME(UNIX_TIMESTAMP(NOW()) - $unread_cutoff_stamp) ";
                $sql.= "AND ({$forum_prefix}USER_THREAD.INTEREST IS NULL ";
                $sql.= "OR {$forum_prefix}USER_THREAD.INTEREST = 0) ";

                if (!$result = db_query($sql, $db_forum_update_unread_data)) return false;
            }
        }
    }

    return true;
}

function forum_load_start_page()
{
    $webtag = get_webtag($webtag_search);

    if (@file_exists("forums/$webtag/start_main.php")) {

        $filesize = filesize("forums/$webtag/start_main.php");

        if ($filesize > 0 && @$fp = fopen("forums/$webtag/start_main.php", "r")) {

            $content = fread($fp, $filesize);
            fclose($fp);
            return $content;
        }
    }

    return false;
}

function forum_start_page_get_html($content)
{
    ob_start();

    html_draw_top();
    echo $content;
    html_draw_bottom();

    $content = ob_get_contents();

    ob_end_clean();

    return word_filter_rem_ob_tags($content);
}

function forum_save_start_page($content)
{
    $webtag = get_webtag($webtag_search);

    if (@!is_dir("forums")) @mkdir("forums", 0755);
    if (@!is_dir("forums/$webtag")) @mkdir("forums/$webtag", 0755);

    $content = forum_start_page_get_html($content);

    if (@$fp = fopen("forums/$webtag/start_main.php", "w")) {

        fwrite($fp, $content);
        fclose($fp);

        return true;
    }

    return false;
}

function forum_create($webtag, $forum_name, $owner_uid, $database_name, $access, &$error_str)
{
    // Load the language

    $lang = load_language_file();

    // Ensure the variables we've been given are valid

    if (!preg_match("/^[A-Z]{1}[A-Z0-9_]+$/", $webtag)) return false;
    if (!preg_match("/^[A-Z]{1}[A-Z0-9_]+$/i", $database_name)) return false;

    if (!is_numeric($owner_uid)) $owner_uid = 0;
    if (!is_numeric($access)) $access = 0;

    // Only users with access to the forum tools can create / delete forums.

    if (bh_session_check_perm(USER_PERM_FORUM_TOOLS, 0)) {

        if (($uid = bh_session_get_value('UID')) === false) return false;

        if (!$db_forum_create = db_connect()) return false;

        // Check that the WEBTAG is unique.

        $sql = "SELECT FID FROM FORUMS WHERE WEBTAG = '$webtag'";

        if (!$result = @db_query($sql, $db_forum_create)) return false;

        if (db_num_rows($result) > 0) {

            $error_str = $lang['selectedwebtagisalreadyinuse'];
            return false;
        }

        // Check for any conflicting tables.

        if ($conflicting_tables_array = install_get_table_conflicts($webtag, true, false)) {

            $error_str = $lang['selecteddatabasecontainsconflictingtables'];
            $error_str.= sprintf("<p>%s</p>\n", implode(", ", $conflicting_tables_array));

            return false;
        }

        // Create the tables

        $sql = "CREATE TABLE {$database_name}.{$webtag}_ADMIN_LOG (";
        $sql.= "  ID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  CREATED DATETIME DEFAULT NULL,";
        $sql.= "  ACTION MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  ENTRY TEXT,";
        $sql.= "  PRIMARY KEY  (ID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_BANNED (";
        $sql.= "  ID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  BANTYPE TINYINT(4) NOT NULL DEFAULT '0',";
        $sql.= "  BANDATA VARCHAR(255) NOT NULL DEFAULT '',";
        $sql.= "  COMMENT VARCHAR(255) NOT NULL DEFAULT '',";
        $sql.= "  PRIMARY KEY  (ID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_FOLDER (";
        $sql.= "  FID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  TITLE VARCHAR(32) DEFAULT NULL,";
        $sql.= "  DESCRIPTION VARCHAR(255) DEFAULT NULL,";
        $sql.= "  PREFIX VARCHAR(16) DEFAULT NULL,";
        $sql.= "  ALLOWED_TYPES TINYINT(3) DEFAULT NULL,";
        $sql.= "  POSITION MEDIUMINT(8) UNSIGNED DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (FID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_FORUM_LINKS (";
        $sql.= "  LID SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  POS MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  URI VARCHAR(255) DEFAULT NULL,";
        $sql.= "  TITLE VARCHAR(64) DEFAULT NULL,";
        $sql.= "  PRIMARY KEY  (LID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_LINKS (";
        $sql.= "  LID SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  FID SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  URI VARCHAR(255) NOT NULL DEFAULT '',";
        $sql.= "  TITLE VARCHAR(64) NOT NULL DEFAULT '',";
        $sql.= "  DESCRIPTION TEXT NOT NULL,";
        $sql.= "  CREATED DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
        $sql.= "  VISIBLE CHAR(1) NOT NULL DEFAULT 'N',";
        $sql.= "  CLICKS MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (LID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_LINKS_COMMENT (";
        $sql.= "  CID SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  LID SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  CREATED DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
        $sql.= "  COMMENT TEXT NOT NULL,";
        $sql.= "  PRIMARY KEY  (CID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_LINKS_FOLDERS (";
        $sql.= "  FID SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  PARENT_FID SMALLINT(5) UNSIGNED DEFAULT NULL,";
        $sql.= "  NAME VARCHAR(32) NOT NULL DEFAULT '',";
        $sql.= "  VISIBLE CHAR(1) NOT NULL DEFAULT '',";
        $sql.= "  PRIMARY KEY  (FID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_LINKS_VOTE (";
        $sql.= "  LID SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  RATING SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  TSTAMP DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
        $sql.= "  PRIMARY KEY  (LID,UID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_POLL (";
        $sql.= "  TID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  QUESTION VARCHAR(64) DEFAULT NULL,";
        $sql.= "  CLOSES DATETIME DEFAULT NULL,";
        $sql.= "  CHANGEVOTE TINYINT(1) NOT NULL DEFAULT '1',";
        $sql.= "  POLLTYPE TINYINT(1) NOT NULL DEFAULT '0',";
        $sql.= "  SHOWRESULTS TINYINT(1) NOT NULL DEFAULT '1',";
        $sql.= "  VOTETYPE TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  OPTIONTYPE TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  ALLOWGUESTS TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (TID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_POLL_VOTES (";
        $sql.= "  TID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  OPTION_ID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  OPTION_NAME CHAR(255) NOT NULL DEFAULT '',";
        $sql.= "  GROUP_ID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (TID,OPTION_ID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_POST (";
        $sql.= "  TID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  PID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  REPLY_TO_PID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  FROM_UID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  TO_UID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  VIEWED DATETIME DEFAULT NULL,";
        $sql.= "  CREATED DATETIME DEFAULT NULL,";
        $sql.= "  STATUS TINYINT(4) DEFAULT '0',";
        $sql.= "  APPROVED DATETIME DEFAULT NULL,";
        $sql.= "  APPROVED_BY MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  EDITED DATETIME DEFAULT NULL,";
        $sql.= "  EDITED_BY MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  IPADDRESS VARCHAR(15) NOT NULL DEFAULT '',";
        $sql.= "  MOVED_TID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  MOVED_PID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  PRIMARY KEY  (TID,PID),";
        $sql.= "  KEY TO_UID (TO_UID),";
        $sql.= "  KEY FROM_UID (FROM_UID),";
        $sql.= "  KEY IPADDRESS (IPADDRESS, FROM_UID),";
        $sql.= "  KEY CREATED (CREATED),";
        $sql.= "  KEY APPROVED (APPROVED)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_POST_CONTENT (";
        $sql.= "  TID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  PID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  CONTENT TEXT,";
        $sql.= "  PRIMARY KEY  (TID,PID),";
        $sql.= "  FULLTEXT KEY CONTENT (CONTENT)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_PROFILE_ITEM (";
        $sql.= "  PIID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  PSID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  NAME VARCHAR(64) DEFAULT NULL,";
        $sql.= "  TYPE TINYINT(3) UNSIGNED DEFAULT '0',";
        $sql.= "  OPTIONS TEXT NOT NULL, ";
        $sql.= "  POSITION MEDIUMINT(3) UNSIGNED DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (PIID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "INSERT INTO {$database_name}.{$webtag}_PROFILE_ITEM ";
        $sql.= "(PSID, NAME, TYPE, OPTIONS, POSITION) ";
        $sql.= "VALUES (1, 'Location', 0, '', 1)";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "INSERT INTO {$database_name}.{$webtag}_PROFILE_ITEM ";
        $sql.= "(PSID, NAME, TYPE, OPTIONS, POSITION) ";
        $sql.= "VALUES (1, 'Age', 0, '', 2)";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "INSERT INTO {$database_name}.{$webtag}_PROFILE_ITEM ";
        $sql.= "(PSID, NAME, TYPE, OPTIONS, POSITION) VALUES ";
        $sql.= "(1, 'Gender', 5, 'Male\nFemale\nUnspecified', 3)";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "INSERT INTO {$database_name}.{$webtag}_PROFILE_ITEM ";
        $sql.= "(PSID, NAME, TYPE, OPTIONS, POSITION) ";
        $sql.= "VALUES (1, 'Quote', 0, '', 4)";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "INSERT INTO {$database_name}.{$webtag}_PROFILE_ITEM ";
        $sql.= "(PSID, NAME, TYPE, OPTIONS, POSITION) ";
        $sql.= "VALUES (1, 'Occupation', 0, '', 5)";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_PROFILE_SECTION (";
        $sql.= "  PSID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  NAME VARCHAR(64) DEFAULT NULL,";
        $sql.= "  POSITION MEDIUMINT(3) UNSIGNED DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (PSID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }


        $sql = "INSERT INTO {$database_name}.{$webtag}_PROFILE_SECTION ";
        $sql.= "(NAME, POSITION) VALUES ('Personal', 1)";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_RSS_FEEDS (";
        $sql.= "  RSSID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  NAME VARCHAR(255) NOT NULL DEFAULT '',";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  FID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  URL VARCHAR(255) DEFAULT NULL,";
        $sql.= "  PREFIX VARCHAR(16) DEFAULT NULL,";
        $sql.= "  FREQUENCY MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  LAST_RUN DATETIME DEFAULT NULL,";
        $sql.= "  PRIMARY KEY  (RSSID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_RSS_HISTORY (";
        $sql.= "  RSSID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  LINK VARCHAR(255) DEFAULT NULL,";
        $sql.= "  KEY RSSID (RSSID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_STATS (";
        $sql.= "  ID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  MOST_USERS_DATE DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
        $sql.= "  MOST_USERS_COUNT MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  MOST_POSTS_DATE DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
        $sql.= "  MOST_POSTS_COUNT MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (ID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_THREAD (";
        $sql.= "  TID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  FID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  BY_UID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  TITLE VARCHAR(64) DEFAULT NULL,";
        $sql.= "  LENGTH MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  POLL_FLAG CHAR(1) DEFAULT NULL,";
        $sql.= "  CREATED DATETIME DEFAULT NULL,";
        $sql.= "  MODIFIED DATETIME DEFAULT NULL,";
        $sql.= "  CLOSED DATETIME DEFAULT NULL,";
        $sql.= "  STICKY CHAR(1) DEFAULT NULL,";
        $sql.= "  STICKY_UNTIL DATETIME DEFAULT NULL,";
        $sql.= "  ADMIN_LOCK DATETIME DEFAULT NULL,";
        $sql.= "  PRIMARY KEY  (TID),";
        $sql.= "  KEY BY_UID (BY_UID),";
        $sql.= "  KEY STICKY (STICKY, MODIFIED), ";
        $sql.= "  KEY LENGTH (LENGTH), ";
        $sql.= "  KEY TITLE (TITLE)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_THREAD_STATS (";
        $sql.= "  TID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  VIEWCOUNT MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  UNREAD_PID MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  UNREAD_CREATED DATETIME DEFAULT NULL,";
        $sql.= "  PRIMARY KEY  (TID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_THREAD_TRACK (";
        $sql.= "  TID MEDIUMINT(8) NOT NULL DEFAULT '0',";
        $sql.= "  NEW_TID MEDIUMINT(8) NOT NULL DEFAULT '0',";
        $sql.= "  CREATED DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
        $sql.= "  TRACK_TYPE TINYINT(4) NOT NULL DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (TID, NEW_TID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_USER_FOLDER (";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  FID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  INTEREST TINYINT(4) DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (UID, FID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_USER_PEER (";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  PEER_UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  RELATIONSHIP TINYINT(4) DEFAULT NULL,";
        $sql.= "  PEER_NICKNAME VARCHAR(32) DEFAULT NULL,";
        $sql.= "  PRIMARY KEY  (UID,PEER_UID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_USER_POLL_VOTES (";
        $sql.= "  TID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  VOTE_ID MEDIUMINT(8) NOT NULL AUTO_INCREMENT,";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  OPTION_ID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  TSTAMP DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
        $sql.= "  PRIMARY KEY (TID, VOTE_ID),";
        $sql.= "  KEY UID (UID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_USER_PREFS (";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  HOMEPAGE_URL VARCHAR(255) NOT NULL DEFAULT '',";
        $sql.= "  PIC_URL VARCHAR(255) NOT NULL DEFAULT '',";
        $sql.= "  PIC_AID CHAR(32) NOT NULL DEFAULT '',";
        $sql.= "  AVATAR_URL VARCHAR(255) NOT NULL DEFAULT '',";
        $sql.= "  AVATAR_AID CHAR(32) NOT NULL DEFAULT '',";
        $sql.= "  EMAIL_NOTIFY CHAR(1) NOT NULL DEFAULT 'Y',";
        $sql.= "  MARK_AS_OF_INT CHAR(1) NOT NULL DEFAULT 'Y',";
        $sql.= "  POSTS_PER_PAGE VARCHAR(3) NOT NULL DEFAULT '20',";
        $sql.= "  FONT_SIZE VARCHAR(2) NOT NULL DEFAULT '10',";
        $sql.= "  STYLE VARCHAR(255) NOT NULL DEFAULT '',";
        $sql.= "  EMOTICONS VARCHAR(255) NOT NULL DEFAULT '',";
        $sql.= "  VIEW_SIGS CHAR(1) NOT NULL DEFAULT 'Y',";
        $sql.= "  START_PAGE VARCHAR(3) NOT NULL DEFAULT '0',";
        $sql.= "  LANGUAGE VARCHAR(32) NOT NULL DEFAULT '',";
        $sql.= "  DOB_DISPLAY CHAR(1) NOT NULL DEFAULT '2',";
        $sql.= "  ANON_LOGON CHAR(1) NOT NULL DEFAULT '0',";
        $sql.= "  SHOW_STATS CHAR(1) NOT NULL DEFAULT 'Y',";
        $sql.= "  IMAGES_TO_LINKS CHAR(1) NOT NULL DEFAULT 'N',";
        $sql.= "  USE_WORD_FILTER CHAR(1) NOT NULL DEFAULT 'N',";
        $sql.= "  USE_ADMIN_FILTER CHAR(1) NOT NULL DEFAULT 'N',";
        $sql.= "  ALLOW_EMAIL CHAR(1) NOT NULL DEFAULT 'Y',";
        $sql.= "  ALLOW_PM CHAR(1) NOT NULL DEFAULT 'Y',";
        $sql.= "  SHOW_THUMBS VARCHAR(2) NOT NULL DEFAULT '2',";
        $sql.= "  ENABLE_WIKI_WORDS CHAR(1) NOT NULL DEFAULT 'Y',";
        $sql.= "  USE_MOVER_SPOILER CHAR(1) DEFAULT 'N', ";
        $sql.= "  USE_LIGHT_MODE_SPOILER CHAR(1) DEFAULT 'N', ";
        $sql.= "  USE_OVERFLOW_RESIZE CHAR(1) DEFAULT 'Y', ";
        $sql.= "  PRIMARY KEY  (UID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_USER_PROFILE (";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  PIID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  ENTRY VARCHAR(255) DEFAULT NULL,";
        $sql.= "  PRIVACY TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (UID,PIID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_USER_SIG (";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  CONTENT TEXT,";
        $sql.= "  HTML CHAR(1) DEFAULT NULL,";
        $sql.= "  PRIMARY KEY  (UID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_USER_THREAD (";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  TID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  LAST_READ MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  LAST_READ_AT DATETIME DEFAULT NULL,";
        $sql.= "  INTEREST TINYINT(4) DEFAULT NULL,";
        $sql.= "  PRIMARY KEY  (UID,TID),";
        $sql.= "  KEY TID (TID),";
        $sql.= "  KEY LAST_READ (LAST_READ)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_USER_TRACK (";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  DDKEY DATETIME DEFAULT NULL,";
        $sql.= "  LAST_POST DATETIME DEFAULT NULL,";
        $sql.= "  LAST_SEARCH DATETIME DEFAULT NULL,";
        $sql.= "  LAST_SEARCH_KEYWORDS TEXT DEFAULT NULL,";
        $sql.= "  POST_COUNT MEDIUMINT(8) UNSIGNED DEFAULT NULL,";
        $sql.= "  USER_TIME_BEST DATETIME DEFAULT NULL,";
        $sql.= "  USER_TIME_TOTAL DATETIME DEFAULT NULL,";
        $sql.= "  USER_TIME_UPDATED DATETIME DEFAULT NULL,";
        $sql.= "  PRIMARY KEY  (UID)";
        $sql.= ") TYPE=MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        $sql = "CREATE TABLE {$database_name}.{$webtag}_WORD_FILTER (";
        $sql.= "  UID MEDIUMINT(8) UNSIGNED NOT NULL,";
        $sql.= "  FID MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,";
        $sql.= "  FILTER_NAME VARCHAR(255) NOT NULL,";
        $sql.= "  MATCH_TEXT TEXT NOT NULL,";
        $sql.= "  REPLACE_TEXT TEXT NOT NULL,";
        $sql.= "  FILTER_TYPE TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  FILTER_ENABLED TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',";
        $sql.= "  PRIMARY KEY  (UID, FID)";
        $sql.= ") TYPE = MYISAM";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return;
        }

        // Save Webtag, Database name and Access Level.

        $sql = "INSERT INTO FORUMS (WEBTAG, OWNER_UID, DATABASE_NAME, ACCESS_LEVEL) ";
        $sql.= "VALUES ('$webtag', '$owner_uid', '$database_name', $access)";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete_tables($webtag, $database_name);

            if (defined("BEEHIVE_INSTALL_NOWARN")) {
                db_trigger_error($sql, $db_forum_create);
            }

            return false;
        }

        // Get the new FID so we can save the settings

        $forum_fid = db_insert_id($db_forum_create);

        // Create General Folder

        $sql = "INSERT INTO {$database_name}.{$webtag}_FOLDER (TITLE, DESCRIPTION, ALLOWED_TYPES, POSITION) ";
        $sql.= "VALUES ('General', NULL, NULL, 0)";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete($forum_fid);
            return false;
        }

        $folder_fid = db_insert_id($db_forum_create);

        // Create folder permissions

        $sql = "INSERT INTO GROUP_PERMS (GID, FORUM, FID, PERM) ";
        $sql.= "VALUES (0, '$forum_fid', '$folder_fid', 14588);";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete($forum_fid);
            return false;
        }

        // Add some default forum links

        $sql = "INSERT INTO {$database_name}.{$webtag}_FORUM_LINKS (POS, TITLE, URI) ";
        $sql.= "VALUES (2, 'Project Beehive Home', 'http://www.beehiveforum.net/')";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete($forum_fid);
            return false;
        }

        $sql = "INSERT INTO {$database_name}.{$webtag}_FORUM_LINKS (POS, TITLE, URI) ";
        $sql.= "VALUES (2, 'Teh Forum', 'http://www.tehforum.co.uk/forum/')";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete($forum_fid);
            return false;
        }

        // Create user permissions for forum leader

        if (!forum_apply_user_permissions($forum_fid, $owner_uid)) {

            forum_delete($forum_fid);
            return false;
        }

        // Create Welcome thread and post.

        $sql = "INSERT INTO {$database_name}.{$webtag}_THREAD ";
        $sql.= "(FID, BY_UID, TITLE, LENGTH, POLL_FLAG, CREATED, MODIFIED, CLOSED, STICKY, STICKY_UNTIL, ADMIN_LOCK) ";
        $sql.= "VALUES (1, 1, 'Welcome', 1, 'N', NOW(), NOW(), NULL, 'N', NULL, NULL)";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete($forum_fid);
            return false;
        }

        $sql = "INSERT INTO {$database_name}.{$webtag}_POST ";
        $sql.= "(TID, REPLY_TO_PID, FROM_UID, TO_UID, VIEWED, CREATED, STATUS, APPROVED, ";
        $sql.= "APPROVED_BY, EDITED, EDITED_BY, IPADDRESS) VALUES (1, 0, 1, 0, NULL, NOW(), ";
        $sql.= "0, NOW(), 1, NULL, 0, '')";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete($forum_fid);
            return false;;
        }

        $sql = "INSERT INTO {$database_name}.{$webtag}_POST_CONTENT (TID, PID, CONTENT) ";
        $sql.= "VALUES (1, 1, 'Welcome to your new Beehive Forum')";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete($forum_fid);
            return false;;
        }

        // Create Top Level Links Folder

        $sql = "INSERT INTO {$database_name}.{$webtag}_LINKS_FOLDERS ";
        $sql.= "(PARENT_FID, NAME, VISIBLE) VALUES (NULL, 'Top Level', 'Y')";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete($forum_fid);
            return false;
        }

        // Store Forum settings

        $forum_settings = array('wiki_integration_uri'    => 'http://en.wikipedia.org/wiki/[WikiWord]',
                                'enable_wiki_quick_links' => 'Y',
                                'enable_wiki_integration' => 'N',
                                'minimum_post_frequency'  => '0',
                                'maximum_post_length'     => '6226',
                                'post_edit_time'          => '0',
                                'allow_post_editing'      => 'Y',
                                'require_post_approval'   => 'N',
                                'forum_dl_saving'         => 'Y',
                                'forum_timezone'          => '27',
                                'default_language'        => 'en',
                                'default_emoticons'       => 'default',
                                'default_style'           => 'Default',
                                'forum_keywords'          => 'A Beehive Forum, Beehive Forum, Project Beehive Forum',
                                'forum_desc'              => 'A Beehive Forum',
                                'forum_email'             => 'admin@abeehiveforum.net',
                                'forum_name'              => $forum_name,
                                'show_links'              => 'Y',
                                'allow_polls'             => 'Y',
                                'show_stats'              => 'Y',
                                'allow_search_spidering'  => 'Y',
                                'guest_account_enabled'   => 'Y',
                                'forum_links_top_link'    => 'Forum Links:');

        foreach ($forum_settings as $sname => $svalue) {

            $sname = db_escape_string($sname);
            $svalue = db_escape_string($svalue);

            $sql = "INSERT INTO FORUM_SETTINGS (FID, SNAME, SVALUE) ";
            $sql.= "VALUES ($forum_fid, '$sname', '$svalue')";

            if (!$result = @db_query($sql, $db_forum_create)) {

                forum_delete($forum_fid);
                return false;
            }
        }

        // Make sure at least the current user can access the forum
        // even if it's not protected.

        $sql = "INSERT INTO USER_FORUM (UID, FID, ALLOWED) VALUES('$uid', $forum_fid, 1)";

        if (!$result = @db_query($sql, $db_forum_create)) {

            forum_delete($forum_fid);
            return false;
        }

        return $forum_fid;
    }

    return false;
}

function forum_update($fid, $forum_name, $owner_uid, $access_level)
{
    if (!is_numeric($fid)) return false;
    if (!is_numeric($owner_uid)) return false;
    if (!is_numeric($access_level)) return false;

    if (bh_session_check_perm(USER_PERM_FORUM_TOOLS, 0)) {

        if (!$db_forum_update = db_connect()) return false;

        $forum_name = db_escape_string($forum_name);

        $sql = "UPDATE LOW_PRIORITY FORUMS SET ACCESS_LEVEL = '$access_level', ";
        $sql.= "OWNER_UID = '$owner_uid' WHERE FID = '$fid'";

        if (!$result = db_query($sql, $db_forum_update)) return false;

        $sql = "UPDATE LOW_PRIORITY FORUM_SETTINGS SET SVALUE = '$forum_name' ";
        $sql.= "WHERE SNAME = 'forum_name' AND FID = '$fid'";

        if (!$result = db_query($sql, $db_forum_update)) return false;

        if (db_affected_rows($result) < 1) {

            $sql = "INSERT IGNORE INTO FORUM_SETTINGS (FID, SNAME, SVALUE) ";
            $sql.= "VALUES ('$fid', 'forum_name', '$forum_name')";

            if (!$result = db_query($sql, $db_forum_update)) return false;
        }

        return true;
    }

    return false;
}

function forum_apply_user_permissions($forum_fid, $uid)
{
    if (!$db_forum_apply_user_permissions = db_connect()) return false;

    if (!is_numeric($forum_fid)) return false;
    if (!is_numeric($uid)) return false;

    $forum_user_perms = USER_PERM_ADMIN_TOOLS | USER_PERM_FOLDER_MODERATE;

    $sql = "INSERT INTO GROUPS (FORUM, GROUP_NAME, GROUP_DESC, AUTO_GROUP) ";
    $sql.= "VALUES ('$forum_fid', NULL, NULL, 1);";

    if (!$result = db_query($sql, $db_forum_apply_user_permissions)) return false;

    $new_gid = db_insert_id($db_forum_apply_user_permissions);

    $sql = "INSERT INTO GROUP_PERMS (GID, FORUM, FID, PERM) ";
    $sql.= "VALUES ('$new_gid', '$forum_fid', 0, '$forum_user_perms');";

    if (!$result = db_query($sql, $db_forum_apply_user_permissions)) return false;

    $sql = "INSERT INTO GROUP_USERS VALUES ($new_gid, $uid);";

    if (!$result = db_query($sql, $db_forum_apply_user_permissions)) return false;

    return true;
}

function forum_delete($fid)
{
    if (bh_session_check_perm(USER_PERM_FORUM_TOOLS, 0)) {

        if (!$db_forum_delete = db_connect()) return false;

        if (!is_numeric($fid)) return false;

        $sql = "SELECT WEBTAG, DATABASE_NAME FROM FORUMS WHERE FID = '$fid'";

        if (!$result = db_query($sql, $db_forum_delete)) return false;

        if (db_num_rows($result) > 0) {

            list($webtag, $database_name) = db_fetch_array($result, DB_RESULT_NUM);

            $sql = "DELETE QUICK FROM FORUMS WHERE FID = '$fid'";

            if (!$result = db_query($sql, $db_forum_delete)) return false;

            $sql = "DELETE QUICK FROM FORUM_SETTINGS WHERE FID = '$fid'";

            if (!$result = db_query($sql, $db_forum_delete)) return false;

            $sql = "DELETE QUICK FROM GROUP_PERMS WHERE FORUM = '$fid'";

            if (!$result = db_query($sql, $db_forum_delete)) return false;

            $sql = "SELECT GID FROM GROUPS WHERE FORUM = '$fid'";

            if (!$result = db_query($sql, $db_forum_delete)) return false;

            while($user_perms = db_fetch_array($result)) {

                $sql = "DELETE QUICK FROM GROUP_USERS WHERE GID = '{$user_perms['GID']}'";

                if (!$result_remove = db_query($sql, $db_forum_delete)) return false;
            }

            $sql = "DELETE QUICK FROM GROUPS WHERE FORUM = '$fid'";

            if (!$result = db_query($sql, $db_forum_delete)) return false;

            $sql = "DELETE QUICK FROM USER_FORUM WHERE FID = '$fid'";

            if (!$result = db_query($sql, $db_forum_delete)) return false;

            $sql = "DELETE QUICK FROM VISITOR_LOG WHERE FORUM = '$fid'";

            if (!$result = db_query($sql, $db_forum_delete)) return false;

            $sql = "DELETE QUICK FROM SEARCH_RESULTS WHERE FORUM = '$fid'";

            if (!$result = db_query($sql, $db_forum_delete)) return false;

            $sql = "SELECT AID FROM POST_ATTACHMENT_IDS WHERE FID = '$fid'";

            if (!$result = db_query($sql, $db_forum_delete)) return false;

            while ($attachment_data = db_fetch_array($result)) {
                delete_attachment_by_aid($attachment_data['AID']);
            }

            $sql = "DELETE QUICK FROM POST_ATTACHMENT_IDS WHERE FID = '$fid'";

            if (!$result = db_query($sql, $db_forum_delete)) return false;

            if (forum_delete_tables($webtag, $database_name)) return true;
        }
    }

    return false;
}

function forum_delete_tables($webtag, $database_name)
{
    // Ensure the variables we've been given are valid

    if (!preg_match("/^[A-Z0-9_]+$/", $webtag)) return false;
    if (!preg_match("/^[A-Z0-9_]+$/i", $database_name)) return false;

    // Only users with access to the forum tools can create / delete forums.

    if (bh_session_check_perm(USER_PERM_FORUM_TOOLS, 0)) {

        if (!$db_forum_delete_tables = db_connect()) return false;

        $table_array = array('ADMIN_LOG',     'BANNED',          'FOLDER',
                             'FORUM_LINKS',   'GROUPS',          'GROUP_PERMS',
                             'GROUP_USERS',   'LINKS',           'LINKS_COMMENT',
                             'LINKS_FOLDERS', 'LINKS_VOTE',      'POLL',
                             'POLL_VOTES',    'POST',            'POST_CONTENT',
                             'PROFILE_ITEM',  'PROFILE_SECTION', 'RSS_FEEDS',
                             'RSS_HISTORY',   'STATS',           'THREAD',
                             'THREAD_STATS',  'THREAD_TRACK',    'USER_TRACK',
                             'USER_FOLDER',   'USER_PEER',       'USER_POLL_VOTES',
                             'USER_PREFS',    'USER_PROFILE',    'USER_SIG',
                             'USER_THREAD',   'VISITOR_LOG',     'WORD_FILTER');

        foreach ($table_array as $table_name) {

            $sql = "DROP TABLE IF EXISTS {$database_name}.{$webtag}_{$table_name}";

            if (!$result = db_query($sql, $db_forum_delete_tables)) return false;
        }

        return true;
    }

    return false;
}

function forum_update_access($fid, $access)
{
    if (!is_numeric($fid)) return false;
    if (!is_numeric($access)) return false;

    if (bh_session_check_perm(USER_PERM_ADMIN_TOOLS, 0) || bh_session_check_perm(USER_PERM_FORUM_TOOLS, 0)) {

        if (($uid = bh_session_get_value('UID')) === false) return false;

        if (!$db_forum_update_access = db_connect()) return false;

        $sql = "UPDATE LOW_PRIORITY FORUMS SET ACCESS_LEVEL = '$access' ";
        $sql.= "WHERE FID = '$fid'";

        if (!$result = db_query($sql, $db_forum_update_access)) return false;

        $sql = "SELECT UID FROM USER_FORUM WHERE FID = '$fid' ";
        $sql.= "AND UID = '$uid' LIMIT 0, 1";

        if (!$result = db_query($sql, $db_forum_update_access)) return false;

        if (db_num_rows($result) > 0) {

            $sql = "UPDATE LOW_PRIORITY USER_FORUM SET ALLOWED = 1 WHERE UID = '$uid' AND FID = '$fid'";

            if (!$result = db_query($sql, $db_forum_update_access)) return false;

        }else {

            $sql = "INSERT IGNORE INTO USER_FORUM (UID, FID, ALLOWED) ";
            $sql.= "VALUES ('$uid', '$fid', '1')";

            if (!$result = db_query($sql, $db_forum_update_access)) return false;
        }

        return true;
    }

    return false;
}

function forum_update_password($fid, $password)
{
    if (!$db_forum_update_password = db_connect()) return false;

    if (!is_numeric($fid)) return false;

    if (bh_session_check_perm(USER_PERM_ADMIN_TOOLS, 0) || bh_session_check_perm(USER_PERM_FORUM_TOOLS, 0)) {

        $password = db_escape_string(md5($password));

        $sql = "UPDATE LOW_PRIORITY FORUMS SET FORUM_PASSWD = '$password' ";
        $sql.= "WHERE FID = '$fid'";

        if (!$result = db_query($sql, $db_forum_update_password)) return false;

        return true;
    }

    return false;
}

function forum_get($fid)
{
    if (!is_numeric($fid)) return false;

    if (bh_session_check_perm(USER_PERM_ADMIN_TOOLS, 0)) {

        if (!$db_forum_get = db_connect()) return false;

        $sql = "SELECT FID, WEBTAG, OWNER_UID, DATABASE_NAME, DEFAULT_FORUM, ";
        $sql.= "ACCESS_LEVEL, FORUM_PASSWD FROM FORUMS WHERE FID = '$fid'";

        if (!$result = db_query($sql, $db_forum_get)) return false;

        if (db_num_rows($result) > 0) {

            $forum_get_array = db_fetch_array($result);
            $forum_get_array['FORUM_SETTINGS'] = array();

            if (isset($forum_get_array['OWNER_UID'])) {

                if ($forum_leader = user_get_logon($forum_get_array['OWNER_UID'])) {

                    $forum_get_array['FORUM_SETTINGS']['forum_leader'] = $forum_leader;
                }
            }

            $sql = "SELECT SNAME, SVALUE FROM FORUM_SETTINGS WHERE FID = '$fid'";

            if (!$result = db_query($sql, $db_forum_get)) return false;

            while ($forum_data = db_fetch_array($result)) {
                $forum_get_array['FORUM_SETTINGS'][$forum_data['SNAME']] = $forum_data['SVALUE'];
            }

            return $forum_get_array;
        }
    }

    return false;
}

function forum_get_permissions($fid, $offset = 0)
{
    if (!$db_forum_get_permissions = db_connect()) return false;

    if (!is_numeric($fid)) return false;
    if (!is_numeric($offset)) $offset = 0;

    $perms_user_array = array();

    $sql = "SELECT SQL_CALC_FOUND_ROWS USER.UID, USER.LOGON, USER.NICKNAME FROM USER USER ";
    $sql.= "LEFT JOIN USER_FORUM USER_FORUM ON (USER_FORUM.UID = USER.UID) ";
    $sql.= "WHERE USER_FORUM.FID = '$fid' AND USER_FORUM.ALLOWED = 1 ";
    $sql.= "LIMIT $offset, 20";

    if (!$result = db_query($sql, $db_forum_get_permissions)) return false;

    // Fetch the number of total results

    $sql = "SELECT FOUND_ROWS() AS ROW_COUNT";

    if (!$result_count = db_query($sql, $db_forum_get_permissions)) return false;

    list($perms_user_count) = db_fetch_array($result_count, DB_RESULT_NUM);

    if (db_num_rows($result) > 0) {

        while ($user_data = db_fetch_array($result)) {

            if (isset($user_data['LOGON']) && isset($user_data['PEER_NICKNAME'])) {
                if (!is_null($user_data['PEER_NICKNAME']) && strlen($user_data['PEER_NICKNAME']) > 0) {
                    $user_data['NICKNAME'] = $user_data['PEER_NICKNAME'];
                }
            }

            if (!isset($user_data['LOGON'])) $user_data['LOGON'] = $lang['unknownuser'];
            if (!isset($user_data['NICKNAME'])) $user_data['NICKNAME'] = "";

            $perms_user_array[] = $user_data;
        }

    }else if ($perms_user_count > 0) {

        $offset = floor(($group_user_count - 1) / 10) * 10;
        return perm_group_get_users($gid, $offset);
    }

    return array('user_count' => $perms_user_count,
                 'user_array' => $perms_user_array);
}

function forum_update_default($fid)
{
    if (!is_numeric($fid)) return false;

    if (bh_session_check_perm(USER_PERM_FORUM_TOOLS, 0)) {

        if (!$db_forum_get_permissions = db_connect()) return false;

        $sql = "UPDATE LOW_PRIORITY FORUMS SET DEFAULT_FORUM = 0";

        if (!$result = db_query($sql, $db_forum_get_permissions)) return false;

        if ($fid > 0) {

            $sql = "UPDATE LOW_PRIORITY FORUMS SET DEFAULT_FORUM = 1 WHERE FID = '$fid'";

            if (!$result = db_query($sql, $db_forum_get_permissions)) return false;
        }

        return $result;
    }

    return false;
}

function forum_get_post_count($webtag)
{
    if (!$db_forum_get_post_count = db_connect()) return false;

    if (preg_match("/^[a-z0-9_]+$/i", $webtag) < 1) return 0;

    $sql = "SELECT COUNT(PID) AS POST_COUNT FROM {$webtag}_POST POST ";

    if (!$result_post_count = db_query($sql, $db_forum_get_post_count)) return false;

    if (db_num_rows($result_post_count) > 0) {

        $$forum_data = db_fetch_array($result_post_count);
        return $$forum_data['POST_COUNT'];
    }

    return 0;
}

function forum_search_array_clean($forum_search)
{
    return db_escape_string(trim(str_replace("%", "", $forum_search)));
}

function forum_search($forum_search, $offset)
{
    if (!$db_forum_search = db_connect()) return false;

    if (!is_numeric($offset)) return false;

    if (($uid = bh_session_get_value('UID')) === false) return false;

    $lang = load_language_file();

    // Array to hold our forums in.

    $forums_array = array();

    if (strlen(trim($forum_search)) > 0) {

        $forum_search_array = explode(";", $forum_search);
        $forum_search_array = array_map('forum_search_array_clean', $forum_search_array);

        $forum_search_webtag = implode("%' OR FORUMS.WEBTAG LIKE '%", $forum_search_array);
        $forum_search_svalue = implode("%' OR FORUM_SETTINGS.SVALUE LIKE '%", $forum_search_array);

        $sql = "SELECT SQL_CALC_FOUND_ROWS CONCAT(FORUMS.DATABASE_NAME, '.', FORUMS.WEBTAG, '_') AS PREFIX, ";
        $sql.= "FORUMS.FID, FORUMS.ACCESS_LEVEL, USER_FORUM.INTEREST FROM FORUM_SETTINGS ";
        $sql.= "LEFT JOIN USER_FORUM ON (USER_FORUM.FID = FORUM_SETTINGS.FID ";
        $sql.= "AND USER_FORUM.UID = '$uid') LEFT JOIN FORUMS ON (FORUMS.FID = FORUM_SETTINGS.FID) ";
        $sql.= "WHERE FORUMS.ACCESS_LEVEL > -1 AND (FORUMS.WEBTAG LIKE ";
        $sql.= "'%$forum_search_webtag%' OR FORUM_SETTINGS.SVALUE LIKE ";
        $sql.= "'%$forum_search_svalue%') GROUP BY FORUMS.FID ";
        $sql.= "LIMIT $offset, 10";

        if (!$result_forums = db_query($sql, $db_forum_search)) return false;

        // Fetch the number of total results

        $sql = "SELECT FOUND_ROWS() AS ROW_COUNT";

        if (!$result_count = db_query($sql, $db_forum_search)) return false;

        list($forums_count) = db_fetch_array($result_count, DB_RESULT_NUM);

        if (db_num_rows($result_forums) > 0) {

            while ($forum_data = db_fetch_array($result_forums)) {

                $forum_fid = $forum_data['FID'];

                $forum_settings = forum_get_settings_by_fid($forum_fid);

                foreach($forum_settings as $key => $value) {

                    if (!isset($forum_data[strtoupper($key)])) {

                        $forum_data[strtoupper($key)] = $value;
                    }
                }

                // Check the forum name is set. If it isn't set it to 'A Beehive Forum'

                if (!isset($forum_data['FORUM_NAME']) || strlen(trim($forum_data['FORUM_NAME'])) < 1) {
                    $forum_data['FORUM_NAME'] = "A Beehive Forum";
                }

                // Check the forum description variable is set.

                if (!isset($forum_data['FORUM_DESC'])) {
                    $forum_data['FORUM_DESC'] = "";
                }

                // Unread cut-off stamp.

                $unread_cutoff_stamp = forum_process_unread_cutoff($forum_settings);

                // Get available folders for queries below

                $folders = folder_get_available_by_forum($forum_fid);

                // User relationship constants

                $user_ignored = USER_IGNORED;
                $user_ignored_completely = USER_IGNORED_COMPLETELY;

                // Get any unread messages

                if (is_numeric($unread_cutoff_stamp) && $unread_cutoff_stamp !== false) {

                    $sql = "SELECT SUM(THREAD.LENGTH) - SUM(COALESCE(USER_THREAD.LAST_READ, 0)) ";
                    $sql.= "AS UNREAD_MESSAGES FROM {$forum_data['PREFIX']}THREAD THREAD ";
                    $sql.= "LEFT JOIN {$forum_data['PREFIX']}USER_THREAD USER_THREAD ";
                    $sql.= "ON (USER_THREAD.TID = THREAD.TID AND USER_THREAD.UID = '$uid') ";
                    $sql.= "WHERE THREAD.FID IN ($folders) ";
                    $sql.= "AND (THREAD.MODIFIED > FROM_UNIXTIME(UNIX_TIMESTAMP(NOW()) - ";
                    $sql.= "$unread_cutoff_stamp) OR $unread_cutoff_stamp = 0) ";

                    if (!$result_unread_count = db_query($sql, $db_forum_search)) return false;

                    list($unread_messages) = db_fetch_array($result_unread_count, DB_RESULT_NUM);

                    $forum_data['UNREAD_MESSAGES'] = $unread_messages;

                }else {

                    $forum_data['UNREAD_MESSAGES'] = 0;
                }

                // Total number of messages

                $sql = "SELECT SUM(THREAD.LENGTH) AS NUM_MESSAGES ";
                $sql.= "FROM {$forum_data['PREFIX']}THREAD THREAD ";
                $sql.= "WHERE THREAD.FID IN ($folders) ";

                if (!$result_messages_count = db_query($sql, $db_forum_search)) return false;

                $num_messages_data = db_fetch_array($result_messages_count);

                if (!isset($num_messages_data['NUM_MESSAGES']) || is_null($num_messages_data['NUM_MESSAGES'])) {
                    $forum_data['NUM_MESSAGES'] = 0;
                }else {
                    $forum_data['NUM_MESSAGES'] = $num_messages_data['NUM_MESSAGES'];
                }

                // Get unread to me message count

                $sql = "SELECT COUNT(POST.PID) AS UNREAD_TO_ME ";
                $sql.= "FROM {$forum_data['PREFIX']}THREAD THREAD ";
                $sql.= "LEFT JOIN {$forum_data['PREFIX']}POST POST ";
                $sql.= "ON (POST.TID = THREAD.TID) WHERE THREAD.FID IN ($folders) ";
                $sql.= "AND POST.TO_UID = '$uid' AND POST.VIEWED IS NULL ";

                if (!$result_unread_to_me = db_query($sql, $db_forum_search)) return false;

                $post_count_data = db_fetch_array($result_unread_to_me);

                if (!isset($post_count_data['UNREAD_TO_ME']) || is_null($post_count_data['UNREAD_TO_ME'])) {
                    $forum_data['UNREAD_TO_ME'] = 0;
                }else {
                    $forum_data['UNREAD_TO_ME'] = $post_count_data['UNREAD_TO_ME'];
                }

                // Sometimes the USER_THREAD table might have a higher count that the thread
                // length due to table corruption. I've only seen this on the SF provided
                // webspace but none the less we do this check here anyway.

                if ($forum_data['NUM_MESSAGES'] < 0) $forum_data['NUM_MESSAGES'] = 0;
                if ($forum_data['UNREAD_MESSAGES'] < 0) $forum_data['UNREAD_MESSAGES'] = 0;
                if ($forum_data['UNREAD_TO_ME'] < 0) $forum_data['UNREAD_TO_ME'] = 0;

                // Get Last Visited

                $sql = "SELECT UNIX_TIMESTAMP(LAST_VISIT) AS LAST_VISIT FROM USER_FORUM ";
                $sql.= "WHERE UID = '$uid' AND FID = '$forum_fid' ";
                $sql.= "AND LAST_VISIT IS NOT NULL AND LAST_VISIT > 0";

                if (!$result_last_visit = db_query($sql, $db_forum_search)) return false;

                $user_last_visit_data = db_fetch_array($result_last_visit);

                if (!isset($user_last_visit_data['LAST_VISIT']) || is_null($user_last_visit_data['LAST_VISIT'])) {
                    $forum_data['LAST_VISIT'] = 0;
                }else {
                    $forum_data['LAST_VISIT'] = $user_last_visit_data['LAST_VISIT'];
                }

                $forums_array[] = $forum_data;
            }

        }else if ($forums_count > 0) {

            $offset = floor(($forums_count - 1) / 10) * 10;
            return forum_search($forum_search, $offset);
        }
    }

    return array('forums_array' => $forums_array,
                 'forums_count' => $forums_count);
}

function forum_get_all_prefixes()
{
    if (!$db_forum_get_all_prefixes = db_connect()) return false;

    $sql = "SELECT CONCAT(DATABASE_NAME, '.', WEBTAG, '_') AS PREFIX, ";
    $sql.= "FID FROM FORUMS ";

    if (!$result = db_query($sql, $db_forum_get_all_prefixes)) return false;

    if (db_num_rows($result) > 0) {

        $prefix_array = array();

        while ($forum_data = db_fetch_array($result)) {
            $prefix_array[$forum_data['FID']] = $forum_data['PREFIX'];
        }

        return $prefix_array;
    }

    return false;
}

function forum_get_all_webtags()
{
    if (!$db_forum_get_all_webtags = db_connect()) return false;

    $sql = "SELECT FID, WEBTAG FROM FORUMS ";

    if (!$result = db_query($sql, $db_forum_get_all_webtags)) return false;

    if (db_num_rows($result) > 0) {

        $webtag_array = array();

        while ($forum_data = db_fetch_array($result)) {
            $webtag_array[$forum_data['FID']] = $forum_data['WEBTAG'];
        }

        return $webtag_array;
    }

    return false;
}

function forum_get_all_fids()
{
    if (!$db_forum_get_all_fids = db_connect()) return false;

    $sql = "SELECT FID FROM FORUMS";

    if (!$result = db_query($sql, $db_forum_get_all_fids)) return false;

    if (db_num_rows($result) > 0) {

        $fids_array = array();

        while ($forum_data = db_fetch_array($result)) {
            $fids_array[] = $forum_data['FID'];
        }

        return $fids_array;
    }

    return false;
}

function forum_update_last_visit($uid)
{
    if (!$db_forum_update_last_visit = db_connect()) return false;

    if (!is_numeric($uid)) return false;

    if (!$table_data = get_table_prefix()) return false;

    $forum_fid = $table_data['FID'];

    if ($uid > 0) {

        $sql = "SELECT LAST_VISIT FROM USER_FORUM WHERE UID = '$uid'";
        $sql.= "AND FID = '$forum_fid'";

        if (!$result = db_query($sql, $db_forum_update_last_visit)) return false;

        if (db_num_rows($result) > 0) {

            $sql = "UPDATE LOW_PRIORITY USER_FORUM SET LAST_VISIT = NOW() ";
            $sql.= "WHERE UID = '$uid' AND FID = '$forum_fid'";

        }else {

            $sql = "INSERT INTO USER_FORUM (UID, FID, LAST_VISIT) ";
            $sql.= "VALUES ('$uid', '$forum_fid', NOW())";
        }

        if (!$result = db_query($sql, $db_forum_update_last_visit)) return false;
    }

    return true;
}

function forums_get_available_dbs()
{
    if (!$db_forums_get_available_dbs = db_connect()) return false;

    $sql = "SHOW DATABASES";

    if (!$result = db_query($sql, $db_forums_get_available_dbs)) return false;

    if (db_num_rows($result) > 0) {

        $database_array = array();

        while ($database = db_fetch_array($result)) {

            if (!stristr('information_schema', $database['Database'])) {

                $database_array[$database['Database']] = $database['Database'];
            }
        }

        return $database_array;
    }

    return false;
}

function forums_get_available_count()
{
    if (!$db_forums_get_available_count = db_connect()) return false;

    if (($uid = bh_session_get_value('UID')) === false) return 0;

    $sql = "SELECT COUNT(FORUMS.FID) FROM FORUMS FORUMS ";
    $sql.= "LEFT JOIN USER_FORUM USER_FORUM ON (USER_FORUM.FID = FORUMS.FID ";
    $sql.= "AND USER_FORUM.UID = '$uid') WHERE FORUMS.ACCESS_LEVEL = 0 ";
    $sql.= "OR FORUMS.ACCESS_LEVEL = 2 OR (FORUMS.ACCESS_LEVEL = 1 ";
    $sql.= "AND USER_FORUM.ALLOWED = 1) ";

    if (!$result = db_query($sql, $db_forums_get_available_count)) return false;

    if (db_num_rows($result) > 0) {

        list($forum_available_count) = db_fetch_array($result, DB_RESULT_NUM);
        return $forum_available_count;
    }

    return false;
}

// Forum self-preservation functions. Randomly picks a function to
// run which helps preserve functionality of Beehive.

function forum_perform_self_clean()
{
    $forum_self_clean_functions_array = array('update_stats',
                                              'pm_system_prune_folders',
                                              'bh_remove_stale_sessions',
                                              'thread_auto_prune_unread_data',
                                              'captcha_clean_up');

    $forum_self_clean_prob = intval(forum_get_setting('forum_self_clean_prob', false, 1000));

    if ($forum_self_clean_prob < 1) $forum_self_clean_prob = 1;
    if ($forum_self_clean_prob > 1000) $forum_self_clean_prob = 1000;

    if (($mt_result = mt_rand(1, $forum_self_clean_prob)) == 1) {

        $forum_self_clean_function = mt_rand(0, sizeof($forum_self_clean_functions_array) - 1);

        if (isset($forum_self_clean_functions_array[$forum_self_clean_function])
          && function_exists($forum_self_clean_functions_array[$forum_self_clean_function])) {

            return $forum_self_clean_functions_array[$forum_self_clean_function]();
        }
    }

    return false;
}

?>