<?php require_once __DIR__ . '/functions.php'; ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= e($pageTitle ?? 'Shopease — Elevated Essentials') ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="topbar">
  <a class="logo" href="index.php">SHOPEASE<span>.</span></a>
  <nav><a href="index.php">Home</a><a href="index.php#shop">Shop</a><a href="index.php#categories">Collections</a><a href="index.php#about">About</a></nav>
  <div class="nav-actions">
    <a href="index.php#shop" aria-label="Search">⌕</a>
    <?php if (!empty($_SESSION['user'])): ?>
      <a href="account.php"><?= e($_SESSION['user']['name']) ?></a>
      <?php if ($_SESSION['user']['role'] === 'admin'): ?><a href="admin/index.php">Admin</a><?php endif; ?>
      <a href="logout.php">Logout</a>
    <?php else: ?><a href="login.php">Sign in</a><?php endif; ?>
    <a href="cart.php" class="cart-link">Bag <b><?= cart_count() ?></b></a>
  </div>
</header>
<?php if ($message = flash()): ?><div class="notice"><?= e($message) ?></div><?php endif; ?>
<main>
