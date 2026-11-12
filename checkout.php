<?php
require 'config.php';require_login();
$items=cart_items($pdo);if(!$items){header('Location: cart.php');exit;}
$total=array_sum(array_column($items,'line_total'));$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $name=trim($_POST['name']??'');$phone=trim($_POST['phone']??'');$address=trim($_POST['address']??'');$city=trim($_POST['city']??'');$pin=trim($_POST['pin']??'');
 if(!$name||!preg_match('/^[0-9]{10}$/',$phone)||!$address||!$city||!preg_match('/^[0-9]{6}$/',$pin))$error='Please complete all fields with a valid 10-digit phone number and 6-digit PIN code.';
 else{
  $pdo->beginTransaction();
  try{
   $stmt=$pdo->prepare("INSERT INTO orders(user_id,customer_name,phone,address,city,pin_code,total,payment_method,status) VALUES(?,?,?,?,?,?,?,'Cash on Delivery','Placed')");
   $stmt->execute([$_SESSION['user']['id'],$name,$phone,$address,$city,$pin,$total]);$orderId=$pdo->lastInsertId();
   $line=$pdo->prepare("INSERT INTO order_items(order_id,product_id,product_name,price,quantity) VALUES(?,?,?,?,?)");
   foreach($items as $p)$line->execute([$orderId,$p['id'],$p['name'],$p['price'],$p['quantity']]);
   $pdo->commit();unset($_SESSION['cart']);header('Location: order_success.php?id='.$orderId);exit;
  }catch(Exception $ex){$pdo->rollBack();$error='Could not place your order. Please try again.';}
 }
}
$pageTitle='Checkout — Shopease';require 'header.php';
?>
<section class="page-wrap narrow"><p class="eyebrow">ALMOST YOURS</p><h1 class="page-title">Checkout</h1><?php if($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>
<form method="post" class="form-card"><label>Full name<input name="name" required value="<?= e($_SESSION['user']['name']) ?>"></label><label>Phone number<input name="phone" required inputmode="numeric" maxlength="10" placeholder="10-digit mobile number"></label><label>Street address<textarea name="address" required rows="3"></textarea></label><div class="two-fields"><label>City<input name="city" required></label><label>PIN code<input name="pin" required maxlength="6" inputmode="numeric"></label></div><div class="checkout-total"><span>Order total</span><strong><?= money($total) ?></strong></div><p class="muted">Payment method: Cash on Delivery</p><button class="btn gold full">Place order</button></form></section>
<?php require 'footer.php'; ?>
