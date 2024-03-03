<?php
date_default_timezone_set("Asia/Manila");
function logger($message, $logFile) {
    $content = date("Y-m-d H:i:s")." - ".$message;
    $content .= PHP_EOL;
    return file_put_contents("logs/".$logFile, $content, FILE_APPEND);
}
?>