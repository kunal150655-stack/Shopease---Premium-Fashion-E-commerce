<?php
require 'config.php';$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){$email=strtolower(trim($_POST['email']??''));$pass=$_POST['password']??'';$s=$pdo->prepare("SELECT * FROM users WHERE email=?");$s->execute([$email]);$u=$s->fetch();
 if($u&&password_verify($pass,$u['password'])){session_regenerate_id(true);$_SESSION['user']=['id'=>$u['id'],'name'=>$u['name'],'email'=>$u['email'],'role'=>$u['role']];$next=$_GET['next']??'index.php';if(!preg_match('/^[a-zA-Z0-9_.-]+\.php$/',$next))$next='index.php';header('Location: '.$next);exit;}else $error='Email or password is incorrect.';
}
$pageTitle='Sign in — Shopease';require 'header.php';?>
<section class="page-wrap narrow"><p class="eyebrow">WELCOME BACK</p><h1 class="page-title">Sign in</h1><?php if($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-card"><label>Email address<input type="email" name="email" required></label><label>Password<input type="password" name="password" required></label><button class="btn gold full">Sign in</button><p class="muted">New to Shopease? <a href="register.php">Create an account</a></p></form></section><?php require 'footer.php'; ?>
