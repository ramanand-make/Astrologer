<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../admin/config/database.php';

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/";
define('BASE_URL', $base_url);


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

function getCategoryBySlug($conn, $slug) {
    $sql = "SELECT * FROM categories WHERE slug = ? AND status = 1 LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

/**
 * Category id plus all active child category ids (for parent collections).
 */
function getCategoryTreeIds($conn, $category_id) {
    $category_id = (int) $category_id;
    $ids = [$category_id];
    $queue = [$category_id];

    $stmt = $conn->prepare("SELECT id FROM categories WHERE parent_id = ? AND status = 1");
    if (!$stmt) {
        return $ids;
    }

    while (!empty($queue)) {
        $parentId = array_shift($queue);
        $stmt->bind_param("i", $parentId);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $childId = (int) $row['id'];
            if (!in_array($childId, $ids, true)) {
                $ids[] = $childId;
                $queue[] = $childId;
            }
        }
    }
    $stmt->close();

    return $ids;
}

/**
 * Active products; when $category_id is set, matches product_category (many-to-many).
 */
function getProducts($conn, $limit = 8, $category_id = null) {
    $sql = "SELECT DISTINCT p.*,
            (SELECT c.name
             FROM product_category pc2
             INNER JOIN categories c ON c.id = pc2.category_id
             WHERE pc2.product_id = p.id AND c.status = 1
             ORDER BY pc2.id ASC
             LIMIT 1) AS category_name
            FROM products p
            WHERE p.status = 1";

    $types = '';
    $params = [];

    if ($category_id !== null) {
        $categoryIds = getCategoryTreeIds($conn, (int) $category_id);
        if (empty($categoryIds)) {
            return [];
        }
        $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));
        $sql .= " AND EXISTS (
            SELECT 1 FROM product_category pc
            WHERE pc.product_id = p.id
            AND pc.category_id IN ($placeholders)
        )";
        $types .= str_repeat('i', count($categoryIds));
        foreach ($categoryIds as $id) {
            $params[] = $id;
        }
    }

    $sql .= " ORDER BY p.id DESC LIMIT ?";
    $types .= 'i';
    $params[] = (int) $limit;

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return [];
    }

    $stmt->bind_param($types, ...$params);
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
    
    $cleanPath = ltrim($path, '/');
    
    // Check if file exists in root
    if (file_exists(__DIR__ . '/../' . $cleanPath)) {
        return $cleanPath;
    }
    
    // Check if it already has admin prefix
    if (strpos($cleanPath, 'admin/') === 0) return $cleanPath;
    
    // Default to admin path
    return 'admin/' . $cleanPath;
}
