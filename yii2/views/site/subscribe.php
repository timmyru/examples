<? if (isset($subscribe->email)) { ?>
    <h2>Мы отправили вам письмо на <?=$subscribe->email?>. Подтвердите свою почту :)</h2>
    <button class="close">Закрыть окно</button>
<? } else { ?>
    <h2>Вы уже подписаны на нашу рассылку :)</h2>
    <button class="close">Закрыть окно</button>

<? }