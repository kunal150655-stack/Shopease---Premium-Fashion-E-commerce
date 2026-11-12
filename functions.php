<?php
function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function money($amount) { return '₹' . number_format((float)$amount, 0); }
function cart_count() { return array_sum($_SESSION['cart'] ?? []); }
function cart_items(PDO $pdo) {
    $cart = $_SESSION['cart'] ?? [];
    if (!$cart) return [];
    $ids = array_keys($cart);
    $marks = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($marks)");
    $stmt->execute($ids);
    $items = [];
    foreach ($stmt->fetchAll() as $p) {
        $p['quantity'] = (int)$cart[$p['id']];
        $p['line_total'] = $p['price'] * $p['quantity'];
        $items[] = $p;
    }
    return $items;
}
function require_login() {
    if (empty($_SESSION['user'])) {
        header('Location: login.php?next=checkout.php'); exit;
    }
}
function require_admin() {
    if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        http_response_code(403); exit('Access denied. Admin account required.');
    }
}
function flash($message = null) {
    if ($message !== null) { $_SESSION['flash'] = $message; return; }
    $m = $_SESSION['flash'] ?? ''; unset($_SESSION['flash']); return $m;
}
