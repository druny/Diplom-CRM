<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Список всех заданий пользователя</title>
    <script src="/template/themes/first/js/modernizr.custom.js"></script>
    <script type="text/javascript" src="/template/modules/ckeditor/ckeditor.js"></script>
    <link type="text/css" rel="stylesheet" href="/template/themes/first/css/style.css" />
</head>
<body>

    <div class="navcont">
        <div class="nav">
            <ul>
                <li><a href="/task/all">Мои задания</a></li>

                <li class="drop">
                    <a href="#">Отделы</a>

                    <div class="dropdownContain">
                        <div class="dropOut">

                            <ul>
                                <li><a href="/department/all">Все отделы</a></li>
                                <li><a href="/department/money">Бюджет</a></li>
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
                                <!--<li><a href="/task/checks">Проверка</a></li>-->
                            </ul>
                        </div>
                    </div>
                <li class="drop">
                    <a href="#">Пользователи</a>
                    <div class="dropdownContain">
                        <div class="dropOut">

                            <ul>
                                <li><a href="/user/all">Все</a></li>
                                <li><a href="/user/result">Рейтинг</a></li>
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