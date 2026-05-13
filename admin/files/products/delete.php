<?php
require_once dirname(__DIR__, 2) . "/app/init.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . file_url("products/list.php"));
    exit();
}

$productId = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($productId > 0) {
    $conn = getSashDBConnection();
    if ($conn) {
        // Delete associated images from storage
        $img_res = $conn->query("SELECT image FROM product_images WHERE product_id = $productId");
        if ($img_res) {
            while ($row = $img_res->fetch_assoc()) {
                $path = APP_ROOT . "/../" . $row['image'];
                if (file_exists($path) && is_file($path)) {
                    unlink($path);
                }
            }
        }
        
        // Check main image
        $main_res = $conn->query("SELECT image FROM products WHERE id = $productId");
        if ($main_res && $main_row = $main_res->fetch_assoc()) {
            if (!empty($main_row['image'])) {
                $path = APP_ROOT . "/../" . $main_row['image'];
                if (file_exists($path) && is_file($path)) {
                    unlink($path);
                }
            }
        }

        // Pivot records and product_images are automatically deleted due to ON DELETE CASCADE in SQL,
        // but we delete the product manually
        $query = "DELETE FROM products WHERE id = $productId";
        $success = $conn->query($query);
        $conn->close();
        
        header("Location: " . file_url("products/list.php") . "?deleted=" . ($success ? "1" : "0"));
        exit();
    }
}

header("Location: " . file_url("products/list.php") . "?deleted=0");
exit();
