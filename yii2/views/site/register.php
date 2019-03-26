<div class="container">

    <?php if( Yii::$app->session->hasFlash('register') ): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <?php echo Yii::$app->session->getFlash('register'); ?>
        </div>
    <?php endif;?>

    <?php if( Yii::$app->session->hasFlash('passwordRegister') ): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <?php echo Yii::$app->session->getFlash('passwordRegister'); ?>
        </div>
    <?php endif;?>

    <?php if( Yii::$app->session->hasFlash('loginRegister') ): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <?php echo Yii::$app->session->getFlash('loginRegister'); ?>
        </div>
    <?php endif;?>

    <form class="register" style="display: flex; flex-direction: column; justify-content: center; align-items: flex-start" action="/site/register" method="post">
        <input class="input" type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <label for="login">Ваш логин</label>
        <input type="text" required name="login">
        <label for="username">Ваше имя</label>
        <input type="text" required name="username">
        <label for="email">Ваша почта</label>
        <input type="email" required name="email">
        <label for="phone">Ваш телефон</label>
        <input type="text" required name="phone">
        <label for="address">Ваш адрес</label>
        <input type="text" name="address">
        <label for="password">Придумайте пароль</label>
        <input type="password" required name="password">
        <label for="confirmPassword">Повторите пароль</label>
        <input type="password" required name="confirmPassword">
        <button style="margin-top: 15px; margin-bottom: 15px; font-size: 20px">Отправить</button>


    </form>

</div>

<?
use app\models\User;
$subs = new User();
$subs = $subs->findAuth($_GET['register']);
if ($subs) {
    $subs->isValidated = true;
    $subs->save();
    ?>
    <div class="modal-subscribe" style="display: block">
        Вы успешно зарегистрировались на сайте
        <button class="close">Закрыть окно</button>
    </div>
    <?
} ?>