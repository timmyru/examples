<?php
    if (isset($_SESSION['success'])) { ?>

    <div class="alert alert-success" role="alert">
        <?=$_SESSION['success']?>
    </div>

<? unset($_SESSION['success']); } ?>

<form action="/admin/update" method="post">
    <h2 class="task-title">Редактирование задачи №<?=$vars['countId']?></h2>

    <div class="form-group">
        <input type="hidden" name="id" value="<?=$vars[0]['id']?>">
        <input class="form-control" type="text" name="username" value="<?=$vars[0]['username']?>" placeholder="Имя" required>
    </div>

    <div class="form-group">
        <input class="form-control" type="email" name="email" value="<?=$vars[0]['email']?>" placeholder="Email" required>
    </div>

    <div class="form-group">
        <textarea class="form-control" type="text" name="task" rows="3" placeholder="Текст задачи" required><?=$vars[0]['task']?></textarea>
    </div>

    <div class="form-group">
        <select class="form-control" name="isDone">
            <option value="1">Выполнено</option>
            <option <? if(!$vars[0]['isDone']) { echo 'selected';}?> value="0">Не выполнено</option>
        </select>
    </div>

    <div class="form-group">
        <a href="/" class="btn btn-warning">На главную</a>
        <input type="submit" class="btn btn-primary" value="Обновить задачу">
    </div>

</form>

<hr>