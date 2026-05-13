<?php
define("APP_ROOT", dirname(__DIR__));
$docRoot = isset($_SERVER["DOCUMENT_ROOT"]) ? realpath($_SERVER["DOCUMENT_ROOT"]) : "";
$appPath = str_replace("\\", "/", APP_ROOT);
$relativePath = "";
if ($docRoot !== "" && strpos($appPath, $docRoot) === 0) {
    $relativePath = substr($appPath, strlen($docRoot)) ?: "";
}
echo "APP_ROOT: " . APP_ROOT . "\n";
echo "DOCUMENT_ROOT: " . $docRoot . "\n";
echo "Relative Path: " . $relativePath . "\n";
?>
