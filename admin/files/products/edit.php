<?php
require_once dirname(__DIR__, 2) . "/app/init.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";
require_once APP_ROOT . "/../includes/functions.php";

$pageTitle = "Edit Product";
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$conn = getSashDBConnection();
$product = null;
$selected_categories = [];
$categories_grouped = [];
$existing_images = [];

if ($conn) {
    // Fetch product details
    $result = $conn->query("SELECT * FROM products WHERE id = $productId");
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        
        // Fetch selected categories
        $cat_res = $conn->query("SELECT category_id FROM product_category WHERE product_id = $productId");
        while ($cat_row = $cat_res->fetch_assoc()) {
            $selected_categories[] = $cat_row['category_id'];
        }

        // Fetch existing images
        $img_res = $conn->query("SELECT * FROM product_images WHERE product_id = $productId");
        if ($img_res) {
            while ($img_row = $img_res->fetch_assoc()) {
                $existing_images[] = $img_row;
            }
        }
    } else {
        header("Location: " . file_url("products/list.php"));
        exit();
    }

    // Fetch all categories for grouping
    $result = $conn->query("SELECT * FROM categories WHERE status = 1 ORDER BY parent_id ASC, name ASC");
    if ($result) {
        $all_cats = [];
        while ($row = $result->fetch_assoc()) {
            $all_cats[] = $row;
        }
        foreach ($all_cats as $cat) {
            if ($cat['parent_id'] == 0) {
                $categories_grouped[$cat['id']] = ['name' => $cat['name'], 'sub' => []];
            } else {
                if (isset($categories_grouped[$cat['parent_id']])) {
                    $categories_grouped[$cat['parent_id']]['sub'][] = $cat;
                }
            }
        }
    }
    $conn->close();
}

include LAYOUT_PATH . "/head.php";
?>

<body class="app sidebar-mini ltr light-mode">
    <div id="global-loader">
        <img src="<?= asset_url("images/loader.svg") ?>" class="loader-img" alt="Loader">
    </div>

    <div class="page">
        <div class="page-main">
            <?php include LAYOUT_PATH . "/header.php"; ?>
            <?php include LAYOUT_PATH . "/sidebar.php"; ?>

            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <div class="main-container container-fluid">
                        <div class="page-header">
                            <h1 class="page-title">Edit Product</h1>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Details: <?= htmlspecialchars($product['name']) ?></h3>
                                    </div>
                                    <div class="card-body">
                                        <form id="editProductForm" action="<?= file_url('products/update.php') ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Price (₹)</label>
                                                    <input type="number" step="0.01" class="form-control" name="price" value="<?= $product['price'] ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Sale Price (₹)</label>
                                                    <input type="number" step="0.01" class="form-control" name="sale_price" value="<?= $product['sale_price'] ?>">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Categories (Select Multiple)</label>
                                                    <select class="form-control select2" name="categories[]" multiple="multiple">
                                                        <?php foreach ($categories_grouped as $p_id => $p_data): ?>
                                                            <optgroup label="<?= htmlspecialchars($p_data['name']) ?>">
                                                                <option value="<?= $p_id ?>" <?= in_array($p_id, $selected_categories) ? 'selected' : '' ?>><?= htmlspecialchars($p_data['name']) ?> (Main)</option>
                                                                <?php foreach ($p_data['sub'] as $sub): ?>
                                                                    <option value="<?= $sub['id'] ?>" <?= in_array($sub['id'], $selected_categories) ? 'selected' : '' ?>><?= htmlspecialchars($sub['name']) ?></option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control editor" id="description" name="description" rows="10"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                                                </div>

                                                <!-- Got Any Questions -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Got any questions</label>
                                                    <textarea class="form-control editor" name="gotanyquestion"><?= htmlspecialchars($product['gotanyquestion'] ?? '') ?></textarea>
                                                </div>
                                                
                                                <!-- Return & Exchange -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Return and Exchange</label>
                                                    <textarea class="form-control editor" name="returnexchange"><?= htmlspecialchars($product['returnexchange'] ?? '') ?></textarea>
                                                </div>
                                                
                                                <!-- Disclaimer -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Disclaimer</label>
                                                    <textarea class="form-control editor" name="disclaimer"><?= htmlspecialchars($product['disclaimer'] ?? '') ?></textarea>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Product Images (Add new images)</label>
                                                    <input type="file" class="form-control" name="images[]" accept="image/*" multiple>
                                                    <small class="text-muted">You can select multiple images to add to the existing ones.</small>
                                                    
                                                    <?php if (!empty($existing_images) || !empty($product['image'])): ?>
                                                    <div class="mt-3">
                                                        <label class="form-label">Existing Images</label>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <?php if (!empty($product['image'])): ?>
                                                            <div class="position-relative">
                                                                <img src="<?= BASE_URL . '/../' . htmlspecialchars($product['image']) ?>" alt="Main Image" style="width:100px; height:100px; object-fit:cover; border-radius:5px; border:1px solid #ccc;">
                                                                <span class="badge bg-primary position-absolute top-0 start-0">Main</span>
                                                            </div>
                                                            <?php endif; ?>
                                                            
                                                            <?php foreach ($existing_images as $img): ?>
                                                            <div class="position-relative">
                                                                <img src="<?= BASE_URL . '/../' . htmlspecialchars($img['image']) ?>" alt="Image" style="width:100px; height:100px; object-fit:cover; border-radius:5px; border:1px solid #ccc;">
                                                                <div class="position-absolute top-0 end-0">
                                                                    <label class="bg-danger text-white px-1 rounded" style="cursor:pointer; font-size:12px;">
                                                                        <input type="checkbox" name="delete_images[]" value="<?= $img['id'] ?>"> Delete
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Stock</label>
                                                    <input type="number" class="form-control" name="stock" value="<?= $product['stock'] ?>">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1" <?= $product['status'] ? 'selected' : '' ?>>Active</option>
                                                        <option value="0" <?= !$product['status'] ? 'selected' : '' ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary">Update Product</button>
                                                <a href="<?= file_url("products/list.php") ?>" class="btn btn-light">Cancel</a>
                                            </div>
                                        </form>

                                        <!-- CKEditor CDN -->
                                        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

                                        <style>
                                            .ck-editor__editable_inline {
                                                min-height: 200px;
                                            }
                                        </style>

                                        <script>
                                            document.querySelectorAll('.editor').forEach((element) => {
                                                ClassicEditor
                                                    .create(element, {
                                                        toolbar: [
                                                            'heading', '|', 'bold', 'italic', 'underline', '|', 
                                                            'link', 'bulletedList', 'numberedList', '|', 
                                                            'insertTable', 'blockQuote', '|', 'undo', 'redo'
                                                        ]
                                                    })
                                                    .catch(error => {
                                                        console.error(error);
                                                    });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include LAYOUT_PATH . "/footer.php"; ?>
    </div>
    <?php include LAYOUT_PATH . "/scripts.php"; ?>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Categories",
                width: '100%'
            });
        });
    </script>
</body>
</html>
