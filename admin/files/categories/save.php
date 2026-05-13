<?php
require_once dirname(__DIR__, 2) . "/app/init.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";
require_once APP_ROOT . "/../includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . file_url("categories/list.php"));
    exit();
}

$conn = getSashDBConnection();
if (!$conn) {
    header("Location: " . file_url("categories/list.php") . "?error=db_connection");
    exit();
}

$name = $conn->real_escape_string($_POST['name']);
$slug = generate_slug($name);
$parent_id = intval($_POST['parent_id']);
$status = intval($_POST['status']);

$query = "INSERT INTO categories (name, slug, parent_id, status) VALUES ('$name', '$slug', $parent_id, $status)";

if ($conn->query($query)) {
    $conn->close();
    header("Location: " . file_url("categories/list.php") . "?success=1");
    exit();
} else {
    $error = $conn->error;
    $conn->close();
    header("Location: " . file_url("categories/list.php") . "?error=" . urlencode($error));
    exit();
}
