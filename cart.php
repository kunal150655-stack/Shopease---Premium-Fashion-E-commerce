<?php
require 'config.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $id=(int)($_POST['product_id']??($_GET['remove_id']??0)); $action=$_POST['action']??'';
 if($action==='add' && $id){$q=max(1,min(10,(int)($_POST['quantity']??1)));$_SESSION['cart'][$id]=min(10,($_SESSION['cart'][$id]??0)+$q);flash('Added to your bag.');}
 if($action==='remove'){unset($_SESSION['cart'][$id]);flash('Item removed.');}
 if($action==='update'){foreach($_POST['qty']??[] as $pid=>$qty){$qty=(int)$qty;if($qty<1)unset($_SESSION['cart'][$pid]);else $_SESSION['cart'][$pid]=min(10,$qty);}flash('Bag updated.');}
 header('Location: cart.php');exit;
}
$items=cart_items($pdo);$subtotal=array_sum(array_column($items,'line_total'));$pageTitle='Your Bag — Shopease';require 'header.php';
?>
<section class="page-wrap"><p class="eyebrow">YOUR SELECTION</p><h1 class="page-title">Shopping bag</h1>
<?php if(!$items): ?><div class="empty-state"><h2>Your bag is waiting.</h2><p>Discover pieces made to stay in your rotation.</p><a class="btn gold" href="index.php#shop">Continue shopping</a></div>
<?php else: ?><form method="post"><div class="cart-layout"><div><?php foreach($items as $p): ?><div class="cart-item"><img src="<?= e($p['image']) ?>" alt=""><div class="cart-item-info"><a href="product.php?id=<?= $p['id'] ?>"><strong><?= e($p['name']) ?></strong></a><small><?= e($p['category']) ?></small><span><?= money($p['price']) ?></span><label>Qty <input type="number" name="qty[<?= $p['id'] ?>]" min="0" max="10" value="<?= $p['quantity'] ?>"></label></div><button class="remove" type="submit" name="action" value="remove" formaction="cart.php?remove_id=<?= $p['id'] ?>">Remove</button></div><?php endforeach; ?><button class="text-link update-btn" name="action" value="update">UPDATE BAG</button></div>
<aside class="summary"><h3>Order summary</h3><div><span>Subtotal</span><strong><?= money($subtotal) ?></strong></div><div><span>Shipping</span><span><?= $subtotal>=3999?'Free':'Calculated at checkout' ?></span></div><hr><div class="total"><span>Total</span><strong><?= money($subtotal) ?></strong></div><a class="btn gold full" href="checkout.php">Continue to checkout</a><small>Secure checkout · Cash on delivery available</small></aside></div></form><?php endif; ?></section>
<?php require 'footer.php'; ?>
