<?php
    define('DB_HOST', 'localhost'); // Адрес
    define('DB_USER', 'k951483312'); // Имя пользователя
    define('DB_PASSWORD', 'YQYGSQgHGNJXCQ^7'); // Пароль
    define('DB_NAME', 'k951483312'); // Имя БД

    $mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($mysql->connect_error) {
        die('Ошибка подключения к базе данных: ' . $mysql->connect_error);
    }
?>