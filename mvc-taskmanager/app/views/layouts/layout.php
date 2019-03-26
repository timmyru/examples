<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?></title>
    <link rel="icon" href="/public/image/favicon.png">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>

    <div class="container">
        <nav class="nav">
            <a href="/">Главная</a>
            <? if ($_SESSION['auth']=='admin') {?>
                <a href="/admin/logout">Выход из админки</a>
            <? } else { ?>
                <a href="/admin/login">Вход в админку</a>
            <? } ?>
        </nav>
        <hr>

        <?=$content?>

        <footer>
            <h6>Тестовое задание Артема Прыгина</h6>
            <a href="mailto:aprygin@mail.ru">aprygin@mail.ru</a> |
            <a href="https://wa.me/79213082809" target="_blank">WhatsApp +79213082809</a>
        </footer>
    </div>

</body>
</html>