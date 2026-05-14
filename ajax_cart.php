<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'add':
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 1;

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'qty' => $qty
            ];
        }
        echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart'], 'count' => count($_SESSION['cart'])]);
        break;

    case 'update':
        $id = $_POST['id'];
        $qty = (int)$_POST['qty'];
        if ($qty > 0) {
            $_SESSION['cart'][$id]['qty'] = $qty;
        } else {
            unset($_SESSION['cart'][$id]);
        }
        echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart'], 'count' => count($_SESSION['cart'])]);
        break;

    case 'remove':
        $id = $_POST['id'];
        unset($_SESSION['cart'][$id]);
        echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart'], 'count' => count($_SESSION['cart'])]);
        break;

    case 'get':
        echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart'], 'count' => count($_SESSION['cart'])]);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        break;
}
