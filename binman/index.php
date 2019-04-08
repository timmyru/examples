<?php

//подключаем класс ShortLink и логику проверки введенных пользователем ссылок checkUrl
require_once 'classes/ShortLink.php';
require_once 'logic/checkUrl.php';

?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Артем Прыгин | Сервис коротких ссылок</title>
    <link rel="shortcut icon" href="assets/img/link.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <!-- Форма отправляется асинхронно, используется файл logic/ajax/ajax.js -->
        <form class="col-6 link-form" method="post">
            <h2>Создай короткую ссылку!</h2>
            <div class="form-block">
                <input class="form-control" type="text" name="link" required placeholder="Напишите, какую ссылку нужно сократить">
            </div>
            <input type="submit" class="btn btn-primary" value="Получите короткую ссылку">
        </form>
        <h3 class="short-link"></h3>
    </div>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="logic/ajax/ajax.js"></script>
</body>
</html>
