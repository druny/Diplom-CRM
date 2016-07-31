<!--<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Вход</title>
    <link type="text/css" rel="stylesheet" href="/template/themes/first/css/style.css" />
</head>
<body>
<div id="wrapper">
    <div class="container">
        <h1>Вход</h1>
<form action="/verification/login" method="post">
    <label for="">
        Login:
        <input type="text" name="login">
    </label>
    <br>
    <label for="">
        Password:
        <input type="password" name="password">
    </label>
    <input type="submit" value="Вход">
</form>
        </div>
</div>
</body>
</html>
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="/template/themes/first/css/verifistyle.css" media="screen" type="text/css" />
    <script src="/template/themes/first/js/prefixfree.min.js"></script>
    <link rel="icon" href="http://vladmaxi.net/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://vladmaxi.net/favicon.ico" type="image/x-icon">
</head>
<body>




<form action="/verification/login" method="post">
    <div class="front-sign-in">
        <input type="text" name="login" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <input class="signin-submit" type="submit" value="ВОЙТИ">
    </div>
    
</form>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>