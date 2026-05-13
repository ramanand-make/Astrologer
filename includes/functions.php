<?php
require_once __DIR__ . '/../admin/config/database.php';

function getNavbarMenu($conn) {
    $sql = "SELECT * FROM navbar_menu WHERE status = 1 AND parent_id = 0 ORDER BY order_no ASC";
    $result = $conn->query($sql);
    $menu = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $menuItem = $row;
            // Check if it has sub-items in navbar_menu
            $sqlSub = "SELECT * FROM navbar_menu WHERE parent_id = ? AND status = 1 ORDER BY order_no ASC";
            $stmt = $conn->prepare($sqlSub);
            $stmt->bind_param("i", $row['id']);
            $stmt->execute();
            $subResult = $stmt->get_result();
            if ($subResult->num_rows > 0) {
                $menuItem['children'] = $subResult->fetch_all(MYSQLI_ASSOC);
            } else {
                // If no sub-items in navbar_menu, check categories
                $menuItem['children'] = getCategoriesByName($conn, $row['title']);
            }
            $menu[] = $menuItem;
        }
    }
    return $menu;
}

function getCategoriesByName($conn, $name) {
    $sql = "SELECT id FROM categories WHERE name = ? AND status = 1 LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $parentId = $row['id'];
        $sqlSub = "SELECT name, slug FROM categories WHERE parent_id = ? AND status = 1 ORDER BY id ASC";
        $stmtSub = $conn->prepare($sqlSub);
        $stmtSub->bind_param("i", $parentId);
        $stmtSub->execute();
        $subResult = $stmtSub->get_result();
        return $subResult->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}

function getProducts($conn, $limit = 8, $category_id = null) {
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.status = 1";
    
    if ($category_id) {
        $sql .= " AND p.category_id = ?";
    }
    
    $sql .= " ORDER BY p.id DESC LIMIT ?";
    
    $stmt = $conn->prepare($sql);
    if ($category_id) {
        $stmt->bind_param("ii", $category_id, $limit);
    } else {
        $stmt->bind_param("i", $limit);
    }
    
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function getProductBySlug($conn, $slug) {
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.slug = ? AND p.status = 1 LIMIT 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getProductImages($conn, $product_id) {
    $sql = "SELECT image FROM product_images WHERE product_id = ? ORDER BY id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $images = [];
    while ($row = $result->fetch_assoc()) {
        $images[] = $row['image'];
    }
    return $images;
}

function get_image_url($path) {
    if (empty($path)) return 'assets/images/placeholder.jpg';
    if (filter_var($path, FILTER_VALIDATE_URL)) return $path;
    // Check if it already has admin prefix
    if (strpos($path, 'admin/') === 0) return $path;
    return 'admin/' . ltrim($path, '/');
}
