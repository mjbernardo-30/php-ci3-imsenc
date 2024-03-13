<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('APP_ENV') OR define("APP_ENV", "Development");
defined('DEFAULT_PW') OR define('DEFAULT_PW', 'WEBAPP2023');
defined('APP_NAME') OR define('APP_NAME', 'Emperador Academy');

// Email Configuration for SMTP
/*$email_user             = "emperadoracademy@redbin.com.ph";
$email_pwd              = "emper@dor2024!$";
$email_server           = "smtp.gmail.com";
$email_server_port      = 587;
$email_server_security  = "tls";*/
//admin@emperadoracademy.com
//Admin@!2023
$email_user             = "no-reply@emperadoracademy.com";
$email_pwd              = "Emperador@2024";
$email_server           = "smtp.hostinger.com";
$email_server_port      = 587;
$email_server_security  = "tls";

/*$email_user             = "joshbernardo324@gmail.com";
$email_pwd              = "Marc@2022";*/

// GMAIL ssl - 465
// GMAIL tls - 587

define("EMAIL", $email_user);
define("EMAIL_PASS", $email_pwd);
define("EMAIL_SMTP", $email_server);
define("EMAIL_SMTP_PORT", $email_server_port);
define("EMAIL_SMTP_ENCRYPT", $email_server_security);

define("APP_ACTIVE", true);
define("APP_THEME", "dark");

define("REG_STARTDATE", "2023-01-15");
define("REG_ENDDATE", "2024-03-31");
define("ELIGIBLE_AGE", 18);
define("LOC_MACHINE", true);

$baseUrl    = null;
$dbServer   = null;
$dbName     = null;
$dbUser     = null;
$dbPwd      = null;
if (APP_ENV == "Development") {
    if (LOC_MACHINE) {
        $dbServer   = "localhost";
        $dbName     = "dims";
        $dbUser     = "root";
        $dbPwd      = "";
        $baseUrl    = "http://localhost:8080/emp/";
    } else {
        $dbServer   = "localhost";
        $dbName     = "u231355288_uims";
        $dbUser     = "u231355288_ownuims";
        $dbPwd      = "IMSNov@!2023";
        $baseUrl    = "https://emperadoracademy.com/dev/";
    }
} else if (APP_ENV == "Production") {
    $dbServer   = "localhost";
    $dbName     = "u231355288_pims";
    $dbUser     = "u231355288_ownpims";
    $dbPwd      = "IMSJan@!2024";
    $baseUrl    = "http://emperadoracademy.com/";
} else {
    $dbServer   = "localhost";
    $dbName     = "u231355288_pims";
    $dbUser     = "u231355288_ownpims";
    $dbPwd      = "IMSDec@!2023";
}

define("DB_HOST", $dbServer);
define("DB_NAME", $dbName);
define("DB_USER", $dbUser);
define("DB_PWD", $dbPwd);
defined('BASE_URL') OR define('BASE_URL', $baseUrl);
defined('ASSETS_URL') OR define('ASSETS_URL', BASE_URL.'assets/web/');
defined('TZ_CONVERT') OR define('TZ_CONVERT', false);