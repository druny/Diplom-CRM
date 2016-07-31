<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="/template/themes/first/css/style.css" />
    <link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    <script src="/template/themes/first/js/modernizr.custom.js"></script>
    <script type="text/javascript" src="/template/modules/ckeditor/ckeditor.js"></script>
</head>
<body>
<script src="http://code.jquery.com/jquery-latest.js"></script>



    <div class="navcont">
        <div class="nav">
            <ul>
                <li><a href="/task/all">Мои задания</a></li>
                <li class="drop">
                    <a href="#">Отделы</a>

                    <div class="dropdownContain">
                        <div class="dropOut">

                            <ul>
                               <!-- <li><a href="/department/all">Все отделы</a></li>-->
                                <li><a href="/department/add">Добавить</a></li>
                                <!--<li><a href="/department/money">Деньги</a></li>-->
                            </ul>
                        </div>
                    </div>

                </li>
                <li class="drop">
                    <a href="#">Задания</a>

                    <div class="dropdownContain">
                        <div class="dropOut">

                            <ul>
                                <li><a href="/task/everything">Все</a></li>
                                <li><a href="/task/arhive">Архивные</a></li>
                                <li><a href="/task/add">Добавить</a></li>
                                <li><a href="/task/checks">Проверка</a></li>
                                <li><a href="/task/confirmation">Подтверждение</a></li>
                            </ul>
                        </div>
                    </div>
                <li class="drop">
                    <a href="#">Пользователи</a>
                    <div class="dropdownContain">
                        <div class="dropOut">

                            <ul>
                                <li><a href="/user/all">Все</a></li>
                                <!--<li><a href="/user/result">Рейтинг</a></li>-->
                                <li><a href="/user/add">Добавить</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <nav class="navigation-menu">
        <ul class="menu">
            <li><a href="">Привет, <?= $_SESSION['login'] ?></a></li>
            <li><button><a href="/user/profile">Мой профиль</a></button></li>
            <li><button><a href="/verification/exit">Выйти</a></button></li>
        </ul>
    </nav>
<div id="wrapper">