<?php
require 'config.php';
$id=(int)($_GET['id']??0); $stmt=$pdo->prepare("SELECT * FROM products WHERE id=? AND active=1"); $stmt->execute([$id]); $p=$stmt->fetch();
if(!$p){http_response_code(404); exit('Product not found.');}
$pageTitle=$p['name'].' — Shopease'; require 'header.php';
?>
<div class="breadcrumbs"><a href="index.php">Home</a> / <?= e($p['category']) ?> / <?= e($p['name']) ?></div>
<section class="product-detail"><div class="detail-image"><img src="<?= e($p['image']) ?>" alt="<?= e($p['name']) ?>"></div><div class="detail-copy"><p class="eyebrow"><?= e($p['category']) ?></p><h1><?= e($p['name']) ?></h1><p class="price-large"><?= money($p['price']) ?></p><p><?= nl2br(e($p['description'])) ?></p>
<form method="post" action="cart.php"><input type="hidden" name="product_id" value="<?= $p['id'] ?>"><input type="hidden" name="action" value="add"><label>Quantity</label><input class="quantity" type="number" name="quantity" min="1" max="10" value="1"><button class="btn gold full">Add to bag</button></form><p class="muted">Complimentary shipping on orders over ₹3,999.</p></div></section>
<?php require 'footer.php'; ?>
