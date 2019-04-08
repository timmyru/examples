/**
 * после отправки формы обращаемся к logic/makeLink.php, где прописана логика взаимодействия с классом ShortLink по созданию короткой ссылки и вывода ее на экран
 * передаем в logic/makeLink.php данные, введенные пользователем через форму
 */

$('.link-form').on('submit', function () {
    event.preventDefault();
    $.ajax({
        type: 'post',
        url: 'logic/makeLink.php',
        data: $(this).serialize(),
        success: function (res) {
           $('.short-link').html('Короткая ссылка: ' + res);
        },
        error: function () {
           alert('Произошла ошибка');
        }
    });
});