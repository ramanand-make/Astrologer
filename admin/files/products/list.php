<?php
require_once dirname(__DIR__, 2) . "/app/init.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";

$pageTitle = "Product List";

// Fetch products directly from DB for the admin table
$conn = getSashDBConnection();
$products = [];
if ($conn) {
    $result = $conn->query("SELECT p.*, GROUP_CONCAT(c.name SEPARATOR ', ') as categories 
                           FROM products p 
                           LEFT JOIN product_category pc ON p.id = pc.product_id
                           LEFT JOIN categories c ON pc.category_id = c.id
                           GROUP BY p.id
                           ORDER BY p.created_at DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
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
                            <h1 class="page-title">Products</h1>
                            <div>
                                <a href="<?= file_url("products/add") ?>" class="btn btn-primary"><i class="fe fe-plus"></i> Add New Product</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Manage Products</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">Image</th>
                                                        <th class="wd-15p border-bottom-0">Name</th>
                                                        <th class="wd-20p border-bottom-0">Categories</th>
                                                        <th class="wd-15p border-bottom-0">Price</th>
                                                        <th class="wd-10p border-bottom-0">Status</th>
                                                        <th class="wd-25p border-bottom-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($products as $product): ?>
                                                    <tr>
                                                        <td><img src="<?= BASE_URL . '/../' . $product['image'] ?>" alt="" style="width:50px; height:50px; object-fit:cover; border-radius:5px;"></td>
                                                        <td><?= htmlspecialchars($product['name']) ?></td>
                                                        <td><?= htmlspecialchars($product['categories'] ?: 'Uncategorized') ?></td>
                                                        <td>
                                                            <?php if ($product['sale_price']): ?>
                                                                <del>₹<?= $product['price'] ?></del> <span class="text-success">₹<?= $product['sale_price'] ?></span>
                                                            <?php else: ?>
                                                                ₹<?= $product['price'] ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-<?= $product['status'] ? 'success' : 'danger' ?>">
                                                                <?= $product['status'] ? 'Active' : 'Inactive' ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="<?= file_url("products/edit.php?id=" . $product['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                                            <button class="btn btn-sm btn-danger delete-product" data-id="<?= $product['id'] ?>">Delete</button>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
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

    <!-- Delete Form -->
    <form id="deleteProductForm" action="<?= file_url("products/delete.php") ?>" method="POST" style="display:none;">
        <input type="hidden" name="id" id="deleteProductId">
    </form>

    <?php include LAYOUT_PATH . "/scripts.php"; ?>
    <script>
        $(document).ready(function() {
            $('.delete-product').click(function() {
                if (confirm('Are you sure you want to delete this product?')) {
                    var id = $(this).data('id');
                    $('#deleteProductId').val(id);
                    $('#deleteProductForm').submit();
                }
            });
        });
    </script>
</body>
</html>
