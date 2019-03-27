<?php

//проверяем, есть ли в гет-запросе ключ text
if (isset($_GET['text'])) {
    //записываем строку, введенную пользователем, в переменную, затем избавляем ее от пробелов и заглавные буквы превращаем в строчные
    $text = $_GET['text'];
    $newText = str_replace(' ', '', mb_strtolower($text, 'utf-8'));

    //функция, которая зеркально переворачивает наш текст
    function reverse($text)
    {
        $arr = [];
        for ($i = mb_strlen($text) - 1; $i >= 0; $i--) {
            $arr[] = mb_substr($text, $i, 1);
        }
        return implode($arr);
    }

    //если исходная строка и ее зеркальное отображение совпадают, то выводим ее на экран
    if ($newText == reverse($newText)) {
        echo 'Строка является палиндромом, ура! ' . $text;
    } else {
        //если нет, то создаем функцию, которая перебирает нашу строку и записывает в массив все комбинации букв, идущих подряд. Минимальная длина такой комбинации - три символа
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

        //получаем все комбинации изначального и зеркального вариантов
        $varsBeforeReverse = explodeVars($newText);
        $varsAfterReverse = explodeVars(reverse($newText));

        //перебираем массивы, ищем совпадения, записываем совпадения в массив. Предварительно проверяем, является ли совпадение палиндромом с помощью функции reverse
        $match = [];
        foreach ($varsBeforeReverse as $var) {
            if (in_array($var, $varsAfterReverse) &&
                $var == reverse($var)) {
                $match[] = $var;
            }
        }

        //ищем самое длинное совпадение, т.е. самый длинный подпалиндром
        $longestMatch = $match[0];
        foreach ($match as $value) {
            if (mb_strlen($value) > mb_strlen($longestMatch)) {
                $longestMatch = $value;
            }
        }

        //если подпалиндромов не найдено, то выводим первый символ, если найдены - выводим самый длинный из них
        if (!$longestMatch) {
            echo 'Палиндромов и подпалиндромов не найдено. Первый символ исходной строки: ' . mb_substr($text, 0, 1);
        } else {
            echo 'Строка не является палиндромом, но мы нашли самый длинный подпалиндром: ' . $longestMatch;
        }
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
<style>
    body {
        font-size: 25px;
        font-family: Arial;
    }
    input {
        padding: 10px;
    }
</style>
<form action="index.php">
    <h2>Палиндром-проверка :)</h2>
    <input type="text" name="text" placeholder="Введите строку" style="width: 500px">
    <input type="submit">
</form>
</body>
</html>
