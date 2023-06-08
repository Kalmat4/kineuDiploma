<?php

require "pagesHead.php";

?>

<div class="template">

<?php
require "header.php";

?>

<div class="content">
    <?php
    require 'connect.php';
    $link = $_SESSION['db'];

    $sqlAuth = mysqli_query($link,'SELECT * FROM `admin`');
    
    $login = $_POST['login'];
    $password = $_POST['pass'];

    if (strlen($_POST['login']) >= 1 && strlen($_POST['pass']) >= 1){
        
        while ($check = mysqli_fetch_assoc($sqlAuth)){
            if ($check['login'] == $login && $check['password'] == $password){
                $_SESSION['login'] = $login;
                $_SESSION['password'] = $password;
                echo "<script> location.href='adminForm.php?page-0'; </script>";
                exit;
            }else{
                $_SESSION['login'] = $login;
                $_SESSION['password'] = $password;
                $status = 'Вы ввели неправильный логин или пароль!';
            }
        }
    }

    $status;

    
    

    ?>
    <span class="title">
        Панель администратора
    </span>
    <p class="simpleText">
        Войдите в аккаунт
    </p>
    <form action="" method="POST" class="authForm">
        <label for="login">Введите Логин</label>
        <input type="text" name='login' autocomplete="off">
        <label for="pass">Введите Пароль</label>
        <input type="password" name='pass' autocomplete="off" class="passInput">
        <img src="../images/eye.png"  onclick="switchEye()" class="eye">

        <input type="submit" value="Войти">
    </form>

    <p class="status">
        <?=$status?>
    </p>
</div>
<?php

require "footer.php";

?>