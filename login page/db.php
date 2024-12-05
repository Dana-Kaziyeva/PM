<?php
$host = 'localhost';  // Адрес вашего сервера
$dbname = 'sdu_project';  // Имя базы данных
$username = 'root';  // Имя пользователя (по умолчанию root для локальных серверов)
$password = '';  // Пароль (по умолчанию пусто на локальных серверах)

try {
    // Подключение к базе данных с использованием PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Устанавливаем атрибуты для обработки ошибок
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Если подключение не удалось
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
