<!DOCTYPE html>
<html>
<head>
    <title>Draco Forum</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/registerAndLog.css">
    <link rel="stylesheet" href="/public/css/menu.css"> <!--v2-->
    <meta charset="utf-8">
</head>
<body>
<div id="wrapper">
    <header>
        <a href="index.php"><img src="/public/images/logo.png"></a>
        <div id="menu2">
            <!--v2-->
            <div id="userbar">
                <?php
                if(isset($_SESSION['isLogged']))
                    echo '<span style="color: #F56505">Hello,'.htmlentities($_SESSION['user']) .' </span> <a class="item" href="/public/user/logout">Logout</a>';
                else {
                    echo '<a class="item" href="/public/forum/login">Login</a> <a class="item" href="/public/forum/register">Register</a>';
                }
                ?>
            </div>
            <div id="rightmenu">
                <a class="item" href="/public/">Home</a>
                <a class="item" href="/public/forum/search">Search</a>
                <a class="item" href="#">FAQ</a>
                <a class="item" href="https://softuni.bg" target="_blank">SoftUni</a>
            </div>
            <!--end v2-->
</header>
    <section>
        <?=$this->getLayoutData('body');?>
    </section>
<footer>
    <div> &copy; Copyright by team Draco</div>
</footer>
</div>
</body>
</html>