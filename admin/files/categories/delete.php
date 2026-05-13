<?php
require_once dirname(__DIR__, 2) . "/app/init.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . file_url("categories/list.php"));
    exit();
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id > 0) {
    $conn = getSashDBConnection();
    if ($conn) {
        // Remove relationships first
        $conn->query("DELETE FROM product_category WHERE category_id = $id");
        // Update subcategories to have no parent
        $conn->query("UPDATE categories SET parent_id = 0 WHERE parent_id = $id");
        
        $query = "DELETE FROM categories WHERE id = $id";
        $success = $conn->query($query);
        $conn->close();
        
        header("Location: " . file_url("categories/list.php") . "?deleted=" . ($success ? "1" : "0"));
        exit();
    }
}

header("Location: " . file_url("categories/list.php") . "?deleted=0");
exit();
