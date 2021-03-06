<?php

/**
 * подключаем класс ShortLink и создаем объект этого класса
 * используем ссылку, введенную пользователем в форму
 * с помощью метода makeLink создаем и записываем в БД короткую ссылку. Данная короткая ссылка выведется на экран с помощью того же метода (если исходная ссылка не удовлетворит регулярному выражению, то выведется предупреждение)
 */

require_once '../classes/ShortLink.php';
$link = new ShortLink();
$link->makeLink(htmlspecialchars($_POST['link']));