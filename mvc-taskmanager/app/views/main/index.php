<?php
require_once 'app/helpers/sort.php';

if (isset($_SESSION['success'])) { ?>

    <div class="alert alert-success" role="alert">
        <?=$_SESSION['success']?>
    </div>

<? unset($_SESSION['success']); } ?>

    <div class="sort">
        <form action="" method="get">
            <input type="hidden" name="sort" value="email">
            <input type="submit" class="btn btn-light" value="Сортировка по email">
        </form>

        <form action="" method="get">
            <input type="hidden" name="sort" value="username">
            <input type="submit" class="btn btn-light" value="Сортировка по имени">
        </form>

        <form action="" method="get">
            <input type="hidden" name="sort" value="isDone">
            <input type="submit" class="btn btn-light" value="Сортировка по выполнению">
        </form>

        <form action="/" method="get">
            <input type="submit" class="btn btn-light" value="Сбросить сортировку">
        </form>
    </div>

<?
    if (!empty($vars[0])) {

    $i = 1;

    if ($_GET['sort'] == 'email') {
        usort($vars[0], "sortEmail");
    } elseif ($_GET['sort'] == 'username') {
        usort($vars[0], "sortUsername");
    } elseif ($_GET['sort'] == 'isDone') {
        usort($vars[0], "sortIsDone");
    }

    foreach ($vars[0] as $var) { ?>

        <? if ((isset($_GET['page']) && $i>$_GET['page']*3) || (!isset($_GET['page']) && $i>3)) {
            break;
        } ?>

        <? if ((isset($_GET['page']) && $i<($_GET['page']*3-2))) {
            $i++;
            continue;
        } ?>

        <h3 class="task-title"><?=($i). '. ' .$var['task']?></h3>
        <p>Имя: <b><?=$var['username']?></b></p>
        <p>Почта: <b><?=$var['email']?></b></p>

        <? if ($var['isDone']) {
            echo "<p style='color: green'>Выполнено</p>";
        } else {
            echo "<p style='color: red'>Не выполнено</p>";
        }

        if ($_SESSION['auth']=='admin') { ?>

            <div class="admin-buttons">

            <form method='post' action='/admin/view'>
                <input type='hidden' name='id' value=<?=$var['id']?>>
                <input type='hidden' name='countId' value=<?=$i?>>
                <input class='btn btn-primary' type='submit' value='Редактировать задачу'>
            </form>

            <form method='post' action='/admin/delete'>
                <input type='hidden' name='delete' value=<?=$var['id']?>>
                <input class='btn btn-danger' type='submit' value='Удалить задачу'>
            </form>

            </div>
        <? }

        $i++;
        echo "<hr>";
    } } else { ?>

     <h2>Заданий пока нет</h2>
     <hr>

<? }?>



<? if ($vars[1] > 1) {
    for ($i=1; $i<=$vars[1]; $i++) {
?>
    <a class="page <? if ($i == $_GET['page'] || (!isset($_GET['page'])) && $i == 1) { echo 'active';}?>" href="?page=<? echo $_GET['sort'] ? "$i&sort={$_GET['sort']}" : "$i" ?>">
        =<?=$i?>=
    </a>
<? }
    echo "<hr>";
   }
?>

    <h4>Добавьте свою задачку</h4>
    <form method="post" action="/main/create">
        <div class="form-group">
            <label for="username">Ваше имя</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Иван Иванов" required>
        </div>
        <div class="form-group">
            <label for="email">Ваш email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
        </div>
        <div class="form-group">
            <label for="task">Текст задачи</label>
            <textarea name="task" class="form-control" id="task" rows="3" required></textarea>
        </div>
        <input type="submit" class="btn btn-success">
    </form>
    <hr>