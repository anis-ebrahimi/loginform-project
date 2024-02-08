<?php

require_once 'bootsrap.php';

$errors= new \App\Modul\Errorsmessage();

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $name= $_POST['name'];
    $username= $_POST['username'];
    $email= $_POST['email'];
    $password= $_POST['password'];


    if (trim($name)=='')
        $errors->name='فیلد نام نمی تواند خالی باشد';

    if (trim($username)=='')
        $errors->username='فیلد نام کاربری نمی تواند خالی باشد';

    if (trim($email)=='')
        $errors->email='فیلد ایمیل نمی تواند خالی باشد';

    if (trim($password)=='')
        $errors->password='فیلد پسورد نمی تواند خالی باشد';

    if ($errors->count()<=0){
        try {
            $user=new \App\Modul\User();
            $stmt=$user->create(compact('name','username','email','password'));
//            $pdo= new PDO("mysql:host=localhost;dbname=oop" , "root","");
//            $stmt=$pdo->prepare("INSERT INTO user (name, username, email, password) values(:name, :username, :email ,:password)");
//            $stmt->execute(compact('name','username','email','password'));
            if ($stmt){
                header("location:./NEW.php");
                return;
            }
            echo $errors->set($name,'اطلاعات شما ذخیره نشد');
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
    <title>register</title>
    <link rel="stylesheet" href="./NEW.CSS.css">
    <link rel="stylesheet" href="./vazirfont">
    <link rel="stylesheet" href="./vazir.css">


</head>
<body class="bdy-stl">

<div class="container">
    <div class="form-title">
        <h2 class="form-title">
            register page
        </h2>
    </div>
    <div>
        <form  class="form" action="./Login.php" method="POST">
            <div><label for="" class="label-form">name:</label>
                <div class="in-div">
                    <input name="name" type="text" class="input-form"  placeholder="لطفا نام و نام خانوادگی خود را وارد کنید"  minlength="6">
               <?php if (isset($errors->name)): ?>
                    <span class="text-red-500 text-sm input-span"><?= $errors->name ?></span>
               <?php  endif;?>
                </div>
            </div>

            <div><label for="" class="label-form">username:</label>
                <div class="in-div">
                    <input name="username" type="text" class="input-form" placeholder="لطفا نام کاربری خود را وارد کنید"  minlength="4">
                    <?php if (isset($errors->username)): ?>
                        <span class="text-red-500 text-sm input-span"><?= $errors->username ?></span>
                    <?php  endif;?>
                </div>
            </div>

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

            <div><button type="submit" class="btn-sabt">register</button></div>

        </form>
    </div>
</div>
</body>
</html>
