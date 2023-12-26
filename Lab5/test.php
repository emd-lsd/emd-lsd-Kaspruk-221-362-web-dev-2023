<?php
    define('DB_HOST', 'localhost'); // Адрес
    define('DB_USER', 'username'); // Имя пользователя
    define('DB_PASSWORD', 'password'); // Пароль
    define('DB_NAME', 'database'); // Имя БД

    // Создаем подключение
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Проверяем подключение
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    // Закрываем подключение
    $conn->close();
?>
