<?php
// Включение отображения ошибок для диагностики
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение к базе данных
require 'db.php';

// Начало сессии
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        // Проверяем пользователя в базе данных
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            // Успешный вход — создаём сессию и перенаправляем на dashboard
            $_SESSION['user_id'] = $user['id'];  // Сохранение данных пользователя в сессии
            $_SESSION['user_email'] = $user['email'];

            // Перенаправление на страницу dashboard
            header("Location: dashboard.php");
            exit();  // Важно! Прекращаем выполнение скрипта после редиректа
        } else {
            $message = "Invalid email or password!";
        }
    } catch (PDOException $e) {
        $message = "Database error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDU University Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="login-container">
    <div class="left-section">
        <img src="sdu.logo.jpg" alt="SDU Logo" class="logo">
    </div>
    <div class="right-section">
        <div class="login-form">
            <h2>Sign-in</h2>
            <form method="POST" action="login.php">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>

                <div class="forget-password">
                    <a href="forgot.php">Forget password?</a>
                </div>
            </form>
            <?php if (!empty($message)): ?>
                <p style="color: red; margin-top: 15px;"><?php echo $message; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
