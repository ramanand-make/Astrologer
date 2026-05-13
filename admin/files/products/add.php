<?php
require_once dirname(__DIR__, 2) . "/app/init.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";

$pageTitle = "Add New Product";

// Fetch categories for the multi-select
$conn = getSashDBConnection();
$categories_grouped = [];
if ($conn) {
    // Fetch all categories
    $result = $conn->query("SELECT * FROM categories WHERE status = 1 ORDER BY parent_id ASC, name ASC");
    if ($result) {
        $all_cats = [];
        while ($row = $result->fetch_assoc()) {
            $all_cats[] = $row;
        }
        
        // Group them
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
                            <h1 class="page-title">Add New Product</h1>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Details</h3>
                                    </div>
                                    <div class="card-body">
                                        <form id="addProductForm" action="<?= file_url('products/save.php') ?>" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Price (₹)</label>
                                                    <input type="number" step="0.01" class="form-control" name="price" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Sale Price (₹)</label>
                                                    <input type="number" step="0.01" class="form-control" name="sale_price">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Categories (Select Multiple)</label>
                                                    <select class="form-control select2" name="categories[]" multiple="multiple">
                                                        <?php foreach ($categories_grouped as $p_id => $p_data): ?>
                                                            <optgroup label="<?= htmlspecialchars($p_data['name']) ?>">
                                                                <option value="<?= $p_id ?>"><?= htmlspecialchars($p_data['name']) ?> (Main)</option>
                                                                <?php foreach ($p_data['sub'] as $sub): ?>
                                                                    <option value="<?= $sub['id'] ?>"><?= htmlspecialchars($sub['name']) ?></option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Description</label>
                                        
                                                    <textarea 
                                                        class="form-control editor" 
                                                        id="description" 
                                                        name="description" 
                                                        rows="10">
                                                    </textarea>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Product Images</label>
                                                
                                                    <input 
                                                        type="file" 
                                                        class="form-control" 
                                                        name="images[]" 
                                                        accept="image/*" 
                                                        multiple 
                                                        required>
                                                        
                                                    <small class="text-muted">
                                                        You can select multiple images
                                                    </small>
                                                </div>
                                                <!-- Got Any Questions -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Got any questions</label>
                                                
                                                    <textarea 
                                                        class="form-control editor" 
                                                        name="gotanyquestion">
                                                    </textarea>
                                                </div>
                                                
                                                <!-- Return & Exchange -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Return and Exchange</label>
                                                
                                                    <textarea 
                                                        class="form-control editor" 
                                                        name="returnexchange">
                                                    </textarea>
                                                </div>
                                                
                                                <!-- Disclaimer -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Disclaimer</label>
                                                
                                                    <textarea 
                                                        class="form-control editor" 
                                                        name="disclaimer">
                                                    </textarea>
                                                </div>

                                                
                                                
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Stock</label>
                                                    <input type="number" class="form-control" name="stock" value="100">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary">Save Product</button>
                                                <a href="<?= file_url("products/list") ?>" class="btn btn-light">Cancel</a>
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
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    '|',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'insertTable',
                    'blockQuote',
                    '|',
                    'undo',
                    'redo'
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
