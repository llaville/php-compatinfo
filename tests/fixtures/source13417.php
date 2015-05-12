<?php
/**
 * Copyright (c) 2005-2008, Laurent Laville <pear@laurent-laville.org>
 *
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the authors nor the names of its contributors
 *       may be used to endorse or promote products derived from this software
 *       without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS
 * BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * PHP versions 4 and 5
 *
 * @category  HTML
 * @package   HTML_CSS
 * @author    Laurent Laville <pear@laurent-laville.org>
 * @copyright 2005-2008 Laurent Laville
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD
 * @version   CVS: $Id: Error.php,v 1.13 2008/01/10 20:08:13 farell Exp $
 * @link      http://pear.php.net/package/HTML_CSS
 * @since     File available since Release 1.0.0RC1
 */

require_once 'PEAR.php';

/**
 * This class creates a css error object, extending the PEAR_Error class.
 *
 * @category  HTML
 * @package   HTML_CSS
 * @author    Laurent Laville <pear@laurent-laville.org>
 * @copyright 2005-2008 Laurent Laville
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD
 * @version   Release: 1.5.1
 * @link      http://pear.php.net/package/HTML_CSS
 * @since     Class available since Release 1.0.0RC1
 */

class HTML_CSS_Error extends PEAR_Error
{
    /**
     * Constructor (ZE1)
     *
     * @param string $message  (optional) message
     * @param int    $code     (optional) error code
     * @param int    $mode     (optional) error mode, one of: PEAR_ERROR_RETURN,
     *                         PEAR_ERROR_PRINT, PEAR_ERROR_DIE, PEAR_ERROR_TRIGGER,
     *                         PEAR_ERROR_CALLBACK or PEAR_ERROR_EXCEPTION
     * @param mixed  $options  (optional) error level, _OR_ in the case of
     *                         PEAR_ERROR_CALLBACK, the callback function
     *                         or object/method tuple.
     * @param string $userinfo (optional) additional user/debug info
     *
     * @since      version 1.0.0 (2006-06-24)
     * @access     public
     */
    function HTML_CSS_Error($message = null,
                            $code = null,
                            $mode = null, $options = null,
                            $userinfo = null)
    {
        $this->__construct($message, $code, $mode, $options, $userinfo);
    }

    /**
     * Constructor (ZE2)
     *
     * @param string $message  (optional) message
     * @param int    $code     (optional) error code
     * @param int    $mode     (optional) error mode, one of: PEAR_ERROR_RETURN,
     *                         PEAR_ERROR_PRINT, PEAR_ERROR_DIE, PEAR_ERROR_TRIGGER,
     *                         PEAR_ERROR_CALLBACK or PEAR_ERROR_EXCEPTION
     * @param mixed  $options  (optional) error level, _OR_ in the case of
     *                         PEAR_ERROR_CALLBACK, the callback function
     *                         or object/method tuple.
     * @param string $userinfo (optional) additional user/debug info
     *
     * @since      version 1.0.0 (2006-06-24)
     * @access     public
     */
    function __construct($message = null,
                         $code = null,
                         $mode = null, $options = null,
                         $userinfo = null)
    {
        if ($mode === null) {
            $mode = PEAR_ERROR_RETURN;
        }
        $this->message   = $message;
        $this->code      = $code;
        $this->mode      = $mode;
        $this->userinfo  = $userinfo;
        $this->backtrace = debug_backtrace();

        if ($mode & PEAR_ERROR_CALLBACK) {
            $this->level    = E_USER_NOTICE;
            $this->callback = $options;
        } else {
            if ($options === null) {
                switch ($userinfo['level']) {
                case 'exception':
                case 'error':
                    $options = E_USER_ERROR;
                    break;
                case 'warning':
                    $options = E_USER_WARNING;
                    break;
                default:
                    $options = E_USER_NOTICE;
                }
            }
            $this->level    = $options;
            $this->callback = null;
        }
        if ($this->mode & PEAR_ERROR_PRINT) {
            echo $this->_display($userinfo);
        }
        if ($this->mode & PEAR_ERROR_TRIGGER) {
            trigger_error($this->getMessage(), $this->level);
        }
        if ($this->mode & PEAR_ERROR_DIE) {
            $this->log();
            die();
        }
        if ($this->mode & PEAR_ERROR_CALLBACK) {
            if (is_callable($this->callback)) {
                call_user_func($this->callback, $this);
            } else {
                $this->log();
            }
        }
    }

    /**
     * Get error level from an error object
     *
     * @return     int                      error level
     * @since      version 1.0.0 (2006-06-24)
     * @access     public
     */
    function getLevel()
    {
        return $this->level;
    }

    /**
     * Default callback function/method from an error object
     *
     * @return     void
     * @since      version 1.0.0 (2006-06-24)
     * @access     public
     */
    function log()
    {
        $userinfo = $this->getUserInfo();

        $display_errors = ini_get('display_errors');
        $log_errors     = ini_get('log_errors');

        if ($display_errors) {
            echo $this->_display($userinfo);
        }

        if ($log_errors) {
            $this->_log($userinfo);
        }
    }

    /**
     * Returns the context of execution formatted.
     *
     * @param string $format the context of execution format
     *
     * @return     string
     * @since      version 1.0.0 (2006-06-24)
     * @access     public
     */
    function sprintContextExec($format)
    {
        $userinfo = $this->getUserInfo();

        if (isset($userinfo['context'])) {
            $context = $userinfo['context'];
        } else {
            $context = $this->getBacktrace();
            $context = @array_pop($context);
        }

        if ($context) {
            $file = $context['file'];
            $line = $context['line'];

            if (isset($context['class'])) {
                $func  = $context['class'];
                $func .= $context['type'];
                $func .= $context['function'];
            } elseif (isset($context['function'])) {
                $func = $context['function'];
            } else {
                $func = '';
            }
            return sprintf($format, $file, $line, $func);
        }
        return '';
    }

    /**
     * Print an error message
     *
     * @param array $userinfo hash of parameters
     *
     * @return     void
     * @since      version 1.0.0 (2006-06-24)
     * @access     private
     */
    function _display($userinfo)
    {
        $displayDefault = array(
            'eol' => "<br/>\n",
            'lineFormat' => '<b>%1$s</b>: %2$s %3$s',
            'contextFormat' => 'in <b>%3$s</b> ' .
                               '(file <b>%1$s</b> on line <b>%2$s</b>)'
        );

        $displayConf = $userinfo['display'];
        $display     = array_merge($displayDefault, $displayConf);
        $contextExec = $this->sprintContextExec($display['contextFormat']);

        return sprintf($display['lineFormat'] . $display['eol'],
                   ucfirst($userinfo['level']), $this->getMessage(), $contextExec);
    }

    /**
     * Send an error message somewhere
     *
     * @param array $userinfo hash of parameters
     *
     * @return     void
     * @since      version 1.0.0 (2006-06-24)
     * @access     private
     */
    function _log($userinfo)
    {
        $logDefault = array(
            'eol' => "\n",
            'lineFormat' => '%1$s %2$s [%3$s] %4$s %5$s',
            'contextFormat' => 'in %3$s (file %1$s on line %2$s)',
            'timeFormat' => '%b %d %H:%M:%S',
            'ident' => $_SERVER['REMOTE_ADDR'],
            'message_type' => 3,
            'destination' => get_class($this) . '.log',
            'extra_headers' => ''
        );

        $logConf = $userinfo['log'];
        $log     = array_merge($logDefault, $logConf);

        $message_type  = $log['message_type'];
        $destination   = '';
        $extra_headers = '';
        $send          = true;

        switch ($message_type) {
        case 0:  // LOG_TYPE_SYSTEM:
            break;
        case 1:  // LOG_TYPE_MAIL:
            $destination   = $log['destination'];
            $extra_headers = $log['extra_headers'];
            break;
        case 3:  // LOG_TYPE_FILE:
            $destination = $log['destination'];
            break;
        default:
            $send = false;
        }

        if ($send) {
            $time        = explode(' ', microtime());
            $time        = $time[1] + $time[0];
            $timestamp   = isset($userinfo['time']) ? $userinfo['time'] : $time;
            $contextExec = $this->sprintContextExec($log['contextFormat']);

            $message = sprintf($log['lineFormat'] . $log['eol'],
                           strftime($log['timeFormat'], $timestamp),
                           $log['ident'],
                           $userinfo['level'],
                           $this->getMessage(),
                           $contextExec);

            error_log(strip_tags($message), $message_type, $destination,
                $extra_headers);
        }
    }

    /**
     * Default internal error handler
     *
     * Dies if the error is an exception (and would have died anyway)
     *
     * @param int    $code  a numeric error code.
     *                      Valid are HTML_CSS_ERROR_* constants
     * @param string $level error level ('exception', 'error', 'warning', ...)
     *
     * @return     mixed
     * @since      version 0.3.3 (2004-05-20)
     * @access     private
     */
    function _handleError($code, $level)
    {
        if ($level == 'exception') {
            return PEAR_ERROR_DIE;
        } else {
            return null;
        }
    }

    /**
     * User callback to generate error messages for any instance
     *
     * @param int   $code     a numeric error code.
     *                        Valid are HTML_CSS_ERROR_* constants
     * @param mixed $userinfo if you need to pass along parameters
     *                        for dynamic messages
     *
     * @return     string
     * @since      version 1.0.0 (2006-06-24)
     * @access     private
     */
    function _msgCallback($code, $userinfo)
    {
        $errorMessages = HTML_CSS_Error::_getErrorMessage();

        if (isset($errorMessages[$code])) {
            $mainmsg = $errorMessages[$code];
        } else {
            $mainmsg = $errorMessages[HTML_CSS_ERROR_UNKNOWN];
        }

        if (is_array($userinfo)) {
            foreach ($userinfo as $name => $val) {
                if (is_array($val)) {
                    // @ is needed in case $val is a multi-dimensional array
                    $val = @implode(', ', $val);
                }
                if (is_object($val)) {
                    if (method_exists($val, '__toString')) {
                        $val = $val->__toString();
                    } else {
                        continue;
                    }
                }
                $mainmsg = str_replace('%' . $name . '%', $val, $mainmsg);
            }
        }

        return $mainmsg;
    }

    /**
     * Error Message Template array
     *
     * @return     string
     * @since      version 1.0.0 (2006-06-24)
     * @access     private
     */
    function _getErrorMessage()
    {
        $messages = array(
            HTML_CSS_ERROR_UNKNOWN =>
                'unknown error',
            HTML_CSS_ERROR_INVALID_INPUT =>
                'invalid input, parameter #%paramnum% '
              . '"%var%" was expecting '
              . '"%expected%", instead got "%was%"',
            HTML_CSS_ERROR_INVALID_GROUP =>
                'group "%identifier%" already exist ',
            HTML_CSS_ERROR_NO_GROUP =>
                'group "%identifier%" does not exist ',
            HTML_CSS_ERROR_NO_ELEMENT =>
                'element "%identifier%" does not exist ',
            HTML_CSS_ERROR_NO_ELEMENT_PROPERTY =>
                'element "%identifier%" does not have property "%property%" ',
            HTML_CSS_ERROR_NO_FILE =>
                'filename "%identifier%" does not exist ',
            HTML_CSS_ERROR_WRITE_FILE =>
                'failed to write to "%filename%"',
            HTML_CSS_ERROR_INVALID_DEPS =>
                'invalid dependencies, %funcname% function '
              . 'require %dependency% '
              . 'but found %currentdep%',
            HTML_CSS_ERROR_INVALID_SOURCE =>
                'invalid input, source #%sourcenum% : '
              . '%errcount% error(s), '
              . '%warncount% warning(s)',
            HTML_CSS_ERROR_NO_ATRULE =>
                'At-Rule "%identifier%" does not exist '
        );
        return $messages;
    }
}
?>