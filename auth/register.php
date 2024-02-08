<?php

use modul\User;

require_once './../MModulodul/Errormessage.php';
require_once './../MModul/User.php';

var_dump($_POST);
$errors=new ErrorMessage();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(trim($name) == '')
        $errors->set('name' , 'فیلد نام نمی تواند خالی باشد');

    if(trim($username) == '')
        $errors->set('username' , 'فیلد نام کاربری نمی تواند خالی باشد');

    if(trim($email) == '')
        $errors->set('email' , 'فیلد ایمیل نمی تواند خالی باشد');

    if(trim($password) == '')
        $errors->set('password' ,  'فیلد پسورد نمی تواند خالی باشد');

    if( $errors->count() <= 0) {
        try {
            $user = new User();
            $result = $user->create(compact('name' , 'username' , 'email' , 'password'));

            if($result) {
                header("Location: http://localhost:8000/auth/register.php");
                return;
            }

            $errors->set('name' , 'اضافه شدن کاربر با موفقیت انجام نشد');
        } catch (Exception $e) {
            echo $e;
        }
    }
}
?>
<!doctype html>
<html dir="rtl" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ساخت حساب کاربری</title>
    <link rel="stylesheet" href="./../NEW.CSS.css">
    <link rel="stylesheet" href="./vazirfont">
    <link rel="stylesheet" href="./vazir.css">
</head>
<body class="bdy_stl">
<div class="container">
    <div class="form-title">
        <h3 class="form-title">ساخت حساب کاربری</h3>
    </div>
   <div class="form">
       <form action="./register.php" method="POST" novalidate>
           <div><label for="" class="lb_stl">نام:</label>
               <div>
                   <input type="text" name="name"  class="form-control" placeholder="لطفا نام ونام خانوادگی خودرا وارد کنید" required minlength="6">
                   <?php if($errors->has('name')) : ?>
                       <span class="text-red-500 text-sm"><?= $errors->first('name') ?></span>
                   <?php endif; ?>
               </div>
           </div>
           <div><label for="" class="lb_stl">نام کاربری:</label>
               <div>
                   <input type="text" name="username"  class="form-control" placeholder="لطفا نام کاربری وارد کنید" minlength="6">
                   <?php if($errors->has('username')) : ?>
                       <span class="text-red-500 text-sm"><?= $errors->first('username') ?></span>
                   <?php endif; ?>
               </div>
           </div>
           <div><label for="" class="lb_stl">ایمیل:</label>
               <div>
                   <input type="email" name="email"  class="form-control" required minlength="6">
                   <?php if($errors->has('email')) : ?>
                       <span class="text-red-500 text-sm"><?= $errors->first('email') ?></span>
                   <?php endif; ?>
               </div>
           </div>
           <div><label for="" class="lb_stl">پسورد:</label>
               <div>
                   <input type="password" name="password"  class="form-control" required minlength="6">
                   <?php if($errors->has('password')) : ?>
                       <span class="text-red-500 text-sm"><?= $errors->first('password') ?></span>
                   <?php endif; ?>
               </div>
           </div>
           <button type="submit" class="sabt_btn"><a href="./register.php">ثبت نام</a></button>
       </form>

   </div>
