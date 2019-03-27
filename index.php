<?php

if (isset($_GET['text'])) {
    $text = $_GET['text'];
    $newText = str_replace(' ', '', mb_strtolower($text, 'utf-8'));

    function explodeVars($text)
    {
        $vars = [];
        for ($i = 0; $i < mb_strlen($text) - 2; $i++) {
            for ($j = 1; $j <= mb_strlen($text); $j++) {
                if (!in_array(mb_substr($text, $i, $j), $vars)
                    && mb_strlen(mb_substr($text, $i, $j)) > 2) {
                    $vars[] = mb_substr($text, $i, $j);
                }
            }
        }
        return $vars;
    }

    function reverse($text)
    {
        $arr = [];
        for ($i = mb_strlen($text) - 1; $i >= 0; $i--) {
            $arr[] = mb_substr($text, $i, 1);
        }
        return implode($arr);
    }

    $varsBeforeReverse = explodeVars($newText);
    $varsAfterReverse = explodeVars(reverse($newText));

    $match = [];
    $longestMatch = $match[0];

    foreach ($varsBeforeReverse as $var) {
        if (in_array($var, $varsAfterReverse) &&
            $var == reverse($var)) {
            $match[] = $var;
        }
    }

    foreach ($match as $value) {
        if (mb_strlen($value) > mb_strlen($longestMatch)) {
            $longestMatch = $value;
        }
    }

    if (!$longestMatch) {
        echo 'Палиндромов и подпалиндромов не найдено. Первый символ исходной строки: ' . mb_substr($text, 0, 1);
    } else if ($longestMatch == $newText) {
        echo 'Строка является палиндромом, ура! ' . $text;
    } else {
        echo 'Строка не является палиндромом, но мы нашли самый длинный подпалиндром: ' . $longestMatch;
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="">
    <h2>Палиндром-проверка :)</h2>
    <input type="text" name="text" placeholder="Введите строку" style="width: 500px">
    <input type="submit">
</form>
</body>
</html>
