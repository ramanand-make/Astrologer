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

$id = intval($_POST['id']);
$name = $conn->real_escape_string($_POST['name']);
$slug = generate_slug($name);
$parent_id = intval($_POST['parent_id']);
$status = intval($_POST['status']);

// Prevent a category from being its own parent
if ($id === $parent_id) {
    $parent_id = 0;
}

$query = "UPDATE categories SET name = '$name', slug = '$slug', parent_id = $parent_id, status = $status WHERE id = $id";

if ($conn->query($query)) {
    $conn->close();
    header("Location: " . file_url("categories/list.php") . "?updated=1");
    exit();
} else {
    $error = $conn->error;
    $conn->close();
    header("Location: " . file_url("categories/list.php") . "?error=" . urlencode($error));
    exit();
}
