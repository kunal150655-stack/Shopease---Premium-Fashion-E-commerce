<?php
require 'config.php';
$pageTitle = 'Shopease — Timeless by Nature';
$category = $_GET['category'] ?? '';
$sql = "SELECT * FROM products WHERE active=1";
$params = [];
if ($category) { $sql .= " AND category=?"; $params[] = $category; }
$sql .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql); $stmt->execute($params); $products = $stmt->fetchAll();
$categories = $pdo->query("SELECT DISTINCT category FROM products WHERE active=1 ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
require 'header.php';
?>
<section class="hero">
 <div class="hero-copy"><p class="eyebrow">THE NEW EVERYDAY COLLECTION</p><h1>TIMELESS<br>BY NATURE.</h1>
 <p>Premium essentials crafted for<br>the modern wardrobe.</p><a class="btn gold" href="#shop">Shop now <span>→</span></a></div>
 <div class="hero-image" role="img" aria-label="Modern neutral fashion editorial"></div>
</section>
<section class="promise">
 <div><span>✧</span><strong>PREMIUM FABRICS</strong><small>Carefully selected materials</small></div>
 <div><span>◇</span><strong>TIMELESS DESIGN</strong><small>Built to last beyond trends</small></div>
 <div><span>□</span><strong>WORLDWIDE SHIPPING</strong><small>Delivering style everywhere</small></div>
</section>
<section class="section" id="categories">
 <div class="section-heading centered"><p class="eyebrow">SHOP BY CATEGORY</p><h2>Elevated Essentials</h2></div>
 <div class="category-grid">
  <a class="category-card cat-men" href="index.php?category=Men"><span>MEN</span><small>SHOP NOW ↗</small></a>
  <a class="category-card cat-women" href="index.php?category=Women"><span>WOMEN</span><small>SHOP NOW ↗</small></a>
  <a class="category-card cat-tops" href="index.php?category=Tops"><span>TOPS</span><small>SHOP NOW ↗</small></a>
  <a class="category-card cat-accessories" href="index.php?category=Accessories"><span>ACCESSORIES</span><small>SHOP NOW ↗</small></a>
 </div>
</section>
<section class="section products-section" id="shop">
 <div class="section-heading"><div><p class="eyebrow">CURATED FOR YOU</p><h2><?= $category ? e($category) : 'New Arrivals' ?></h2></div><a class="text-link" href="index.php">VIEW ALL →</a></div>
 <div class="filter-row"><a class="<?= !$category?'active':'' ?>" href="index.php#shop">All</a><?php foreach($categories as $c): ?><a class="<?= $category===$c?'active':'' ?>" href="index.php?category=<?= urlencode($c) ?>#shop"><?= e($c) ?></a><?php endforeach; ?></div>
 <div class="product-grid">
 <?php foreach($products as $p): ?>
  <article class="product-card"><a class="product-image" href="product.php?id=<?= $p['id'] ?>"><img src="<?= e($p['image']) ?>" alt="<?= e($p['name']) ?>"><span class="tag">NEW</span></a>
   <div class="product-info"><a href="product.php?id=<?= $p['id'] ?>"><?= e($p['name']) ?></a><span><?= money($p['price']) ?></span></div>
   <form method="post" action="cart.php"><input type="hidden" name="product_id" value="<?= $p['id'] ?>"><input type="hidden" name="action" value="add"><button class="quick-add">ADD TO BAG +</button></form>
  </article>
 <?php endforeach; ?>
 </div>
 <?php if (!$products): ?><p class="empty">No products in this collection yet.</p><?php endif; ?>
</section>
<section class="editorial"><p class="eyebrow">LESS, BUT BETTER</p><h2>Make room for<br>what matters.</h2><a class="btn outline" href="#shop">Discover the collection →</a></section>
<?php require 'footer.php'; ?>
