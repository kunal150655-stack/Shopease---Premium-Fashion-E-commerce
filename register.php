<?php
require 'config.php';$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){$name=trim($_POST['name']??'');$email=strtolower(trim($_POST['email']??''));$pass=$_POST['password']??'';
 if(!$name||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($pass)<8)$error='Enter a name, valid email and password of at least 8 characters.';
 else{try{$s=$pdo->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");$s->execute([$name,$email,password_hash($pass,PASSWORD_DEFAULT)]);$_SESSION['user']=['id'=>$pdo->lastInsertId(),'name'=>$name,'email'=>$email,'role'=>'customer'];header('Location: index.php');exit;}catch(PDOException $e){$error='That email address is already registered.';}}
}
$pageTitle='Create account — Shopease';require 'header.php';?>
<section class="page-wrap narrow"><p class="eyebrow">JOIN SHOPEASE</p><h1 class="page-title">Create account</h1><?php if($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-card"><label>Your name<input name="name" required></label><label>Email address<input type="email" name="email" required></label><label>Password<input type="password" name="password" minlength="8" required></label><button class="btn gold full">Create account</button><p class="muted">Already have an account? <a href="login.php">Sign in</a></p></form></section><?php require 'footer.php'; ?>
