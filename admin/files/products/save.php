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
    header("Location: " . file_url("products/add.php") . "?error=db_connection");
    exit();
}

/* =========================
   GET FORM DATA
========================= */

$name               = $conn->real_escape_string($_POST['name']);
$slug               = generate_slug($name);
$description        = $conn->real_escape_string($_POST['description']);

$gotanyquestion     = $conn->real_escape_string($_POST['gotanyquestion']);
$returnexchange     = $conn->real_escape_string($_POST['returnexchange']);
$disclaimer         = $conn->real_escape_string($_POST['disclaimer']);

$price              = floatval($_POST['price']);

$sale_price         = !empty($_POST['sale_price'])
                        ? floatval($_POST['sale_price'])
                        : "NULL";

$stock              = intval($_POST['stock']);
$status             = intval($_POST['status']);

$categories         = isset($_POST['categories'])
                        ? $_POST['categories']
                        : [];

/* =========================
   INSERT PRODUCT
========================= */

$query = "INSERT INTO products (
            name,
            slug,
            description,
            gotanyquestion,
            returnexchange,
            disclaimer,
            price,
            sale_price,
            stock,
            status
          ) VALUES (
            '$name',
            '$slug',
            '$description',
            '$gotanyquestion',
            '$returnexchange',
            '$disclaimer',
            $price,
            $sale_price,
            $stock,
            $status
          )";

if ($conn->query($query)) {

    $productId = $conn->insert_id;

    /* =========================
       SAVE CATEGORIES
    ========================= */

    if (!empty($categories)) {

        foreach ($categories as $catId) {

            $catId = intval($catId);

            $conn->query("
                INSERT INTO product_category (
                    product_id,
                    category_id
                ) VALUES (
                    $productId,
                    $catId
                )
            ");
        }
    }

    /* =========================
       MULTIPLE IMAGE UPLOAD
    ========================= */

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

                    // Save image in DB
                    $conn->query("
                        INSERT INTO product_images (
                            product_id,
                            image
                        ) VALUES (
                            $productId,
                            '$imagePath'
                        )
                    ");
                }
            }
        }
    }

    $conn->close();

    header("Location: " . file_url("products/list.php") . "?success=1");
    exit();

} else {

    $error = $conn->error;

    $conn->close();

    header("Location: " . file_url("products/add.php") . "?error=" . urlencode($error));
    exit();
}