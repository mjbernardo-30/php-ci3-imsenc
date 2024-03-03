<?php
defined('APP_ENV') OR define("APP_ENV", "Development");
defined('LOC_MACHINE') OR define("LOC_MACHINE", true);

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
        $baseUrl    = "http://localhost:8080/webapp/";
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
?>