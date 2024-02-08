<?php
//var_dump($_POST);
require_once './vendor/autoload.php';

$errors= new \App\Modul\Errorsmessage();
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['email'];
    $password=$_POST['password'];


    if (trim($email)=='')
        $errors->email='فیلد ایمیل نمی تواند خالی باشد';

    if (trim($password)=='')
        $errors->password='فیلد پسورد نمی تواند خالی باشد';

    if ($errors->count()<=0){
        try {
           $user1=new \App\Modul\User();
          $stamt=$user1->Login(compact('email','password'));

            if ($stamt){
                if ($stamt->password== $password){
                    header("Location:./Login.php");
                }else{
                    $errors->email='چنین کاربری وجود ندارد';
                }
            }else{
                $errors->email='چنین کاربری وجود ندارد';
            }
        }catch (Exception $e){
            echo $e;
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="view port" content="width=device-width, user-scalable=no, intial-scale=1.0, maximum-scale=1.0, minimum-scale=0.5">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="./NEW.CSS.css">
    <link rel="stylesheet" href="./vazirfont">
    <link rel="stylesheet" href="./vazir.css">


</head>
<body class="bdy-stl">

<div class="container">
    <div class="form-title">
        <h2 class="form-title">
            login page
        </h2>
    </div>
    <div class="form">
        <?php if(isset($_SESSION['login'])): ?>
        <?= "you are login" ?>
        <?php else: ?>
        <form  action="./Login.php" method="POST">
            <div><label for="" class="label-form">email:</label>
                <div class="in-div">
                    <input name="email" type="email" class="input-form" minlength="8">
                    <?php if (isset($errors->email)): ?>
                        <span class="text-red-500 text-sm input-span"><?= $errors->email ?></span>
                    <?php  endif;?>
                </div>
            </div>

            <div><label for="" class="label-form">password:</label>
                <div class="in-div">
                    <input name="password" type="password" class="input-form"   minlength="8">
                    <?php if (isset($errors->password)): ?>
                        <span class="text-red-500 text-sm input-span"><?= $errors->password ?></span>>
                    <?php  endif;?>
                </div>
            </div>

            <div><button type="submit" class="btn-sabt">Login</button></div>
        </form>
    </div>
    <?php endif;?>

</body>
