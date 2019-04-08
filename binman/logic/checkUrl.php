<?php

/**
 * проверяем, по какой ссылке хочет перейти пользователь
 * если такая короткая ссылка есть в БД, то осуществляем переход на этот сайт
 */

$checkUri = new ShortLink();
$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if ($check = $checkUri->checkLink($link)) {
    header("Location: http://$check");
};