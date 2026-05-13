<?php
require_once dirname(__DIR__, 2) . "/app/init.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";
require_once APP_ROOT . "/../includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . file_url("products/list.php"));
    exit();
}

$conn = getSashDBConnection();
if (!$conn) {
    header("Location: " . file_url("products/list.php") . "?error=db_connection");
    exit();
}

$id = intval($_POST['id']);
$name = $conn->real_escape_string($_POST['name']);
$slug = generate_slug($name);
$description = $conn->real_escape_string($_POST['description'] ?? '');
$gotanyquestion = $conn->real_escape_string($_POST['gotanyquestion'] ?? '');
$returnexchange = $conn->real_escape_string($_POST['returnexchange'] ?? '');
$disclaimer = $conn->real_escape_string($_POST['disclaimer'] ?? '');

$price = floatval($_POST['price']);
$sale_price = !empty($_POST['sale_price']) ? floatval($_POST['sale_price']) : "NULL";
$stock = intval($_POST['stock']);
$status = intval($_POST['status']);
$categories = isset($_POST['categories']) ? $_POST['categories'] : [];

// Process deleting selected images
if (!empty($_POST['delete_images'])) {
    foreach ($_POST['delete_images'] as $del_id) {
        $del_id = intval($del_id);
        $res = $conn->query("SELECT image FROM product_images WHERE id = $del_id AND product_id = $id");
        if ($res && $row = $res->fetch_assoc()) {
            $path = APP_ROOT . "/../" . $row['image'];
            if (file_exists($path) && is_file($path)) {
                unlink($path);
            }
            $conn->query("DELETE FROM product_images WHERE id = $del_id");
        }
    }
}

// Handle Multiple Image Upload
if (isset($_FILES['images'])) {
    $uploadDir = APP_ROOT . "/../assets/images/products/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['images']['error'][$key] === 0) {
            $fileName = $_FILES['images']['name'][$key];
            $fileInfo = pathinfo($fileName);
            $extension = strtolower($fileInfo['extension']);
            $newFileName = $slug . "-" . time() . "-" . $key . "." . $extension;
            $targetFile = $uploadDir . $newFileName;

            if (move_uploaded_file($tmp_name, $targetFile)) {
                $imagePath = "assets/images/products/" . $newFileName;
                $conn->query("INSERT INTO product_images (product_id, image) VALUES ($id, '$imagePath')");
                
                // If main image is empty, set this as main image (optional, depends on schema constraints)
                $res_main = $conn->query("SELECT image FROM products WHERE id = $id");
                if ($res_main && $row_main = $res_main->fetch_assoc()) {
                    if (empty($row_main['image'])) {
                        $conn->query("UPDATE products SET image = '$imagePath' WHERE id = $id");
                    }
                }
            }
        }
    }
}

// Update Product
$query = "UPDATE products SET 
          name = '$name', 
          slug = '$slug', 
          description = '$description', 
          gotanyquestion = '$gotanyquestion',
          returnexchange = '$returnexchange',
          disclaimer = '$disclaimer',
          price = $price, 
          sale_price = $sale_price, 
          stock = $stock, 
          status = $status 
          WHERE id = $id";

if ($conn->query($query)) {
    // Refresh Categories in pivot table
    $conn->query("DELETE FROM product_category WHERE product_id = $id");
    if (!empty($categories)) {
        foreach ($categories as $catId) {
            $catId = intval($catId);
            $conn->query("INSERT INTO product_category (product_id, category_id) VALUES ($id, $catId)");
        }
    }
    
    $conn->close();
    header("Location: " . file_url("products/list.php") . "?updated=1");
    exit();
} else {
    $error = $conn->error;
    $conn->close();
    header("Location: " . file_url("products/edit.php?id=$id") . "&error=" . urlencode($error));
    exit();
}
