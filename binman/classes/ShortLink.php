<?php

/**
 * Class ShortLink
 * В классе прописана логика подключения к БД, записи в таблицу с ссылками и проверки введенной пользователем ссылке в адресную строку
 */

class ShortLink
{
    /**
     * свойства: регулярное выражение для проверки ссылки от пользователя
     * и данные хоста для подключение к БД
    */

    private static $regexp = '/[a-zA-Z](.*?)\./';
    private $host = 'localhost';
    private $dbname = 'binman';
    private $charset = 'utf-8';
    private $user = 'root';
    private $password = '';
    private $connect;

    /**
     * Конструктор -
     * подключаемся к БД
     * если таблицы с ссылками в БД нет, то создаем ее
     */

    public function __construct()
    {
        $this->connect = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset:$this->charset", "$this->user", "$this->password");
        $this->connect->query("
            CREATE TABLE IF NOT EXISTS 
            `links` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `link` VARCHAR(255) NOT NULL,
                `short_link` VARCHAR(50) NOT NULL UNIQUE,
                 PRIMARY KEY(`id`)
            )
        ");
    }

    /**
     * приватная функция для создания короткой ссылки (по умолчанию длина 6 символов)
     * @param int $length
     * @return string
     */
    private function random($length=6)
    {
        $vars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $vars[rand(0, strlen($vars) - 1)];
        }
        return $randomString;
    }

    /**
     * принимаем ссылку, введенную пользователем на соответствие регулярному выражению
     * если всё ок, то подготовливаем запрос в БД, генерируем рэндомную короткую ссылку и записываем данные в таблицу
     * выводим результат через echo
     * если ссылка не соответствует регулярному выражению, то выводим предупреждение на этот счет
     * @param $link
     */
    public function makeLink($link)
    {
        if (preg_match(self::$regexp, $link)) {
            $query = $this->connect->prepare("INSERT INTO links SET link=:link, short_link=:short_link");
            $link = str_replace('https://', '', $link);
            $link = str_replace('http://', '', $link);
            $shortLink = $_SERVER['HTTP_HOST'] . '/' . $this->random();
            $findMatches = $this->connect->query("SELECT * FROM links WHERE short_link='$shortLink'")
            ->fetch(PDO::FETCH_ASSOC);
            while ($findMatches) {
                $shortLink = $_SERVER['HTTP_HOST'] . '/' . $this->random();
            }
            $arr = ['link'=>$link, 'short_link'=>$shortLink];
            $query->execute($arr);
            echo $shortLink;
        } else {
            echo 'С вашей ссылкой что-то не так :(';
        }
    }

    /**
     * если пользователь хочет перейти по какой-то ссылке с использованием нашего хоста (домена), то проверяем есть ли такая ссылка в числе коротких в таблице links
     * если есть, то редирект на этот сайт (прописано в checkUrl.php)
     * если нет, то редирект на главную (прописано в htaccess)
     * @param $link
     * @return bool
     */
    public function checkLink($link)
    {
        $query = $this->connect->query("SELECT link FROM links WHERE short_link='$link'")
                ->fetch(PDO::FETCH_ASSOC);
        if ($query) {
            return $query['link'];
        } else {
            return false;
        }
    }
}