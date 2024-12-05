<?php
// Параметры для подключения к базе данных
$servername = "localhost"; // Имя сервера
$username = "root"; // Имя пользователя MySQL (обычно root)
$password = ""; // Пароль MySQL (обычно пустой)
$dbname = "sdu_project"; // Имя базы данных

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обработка данных после отправки формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Подготавливаем SQL-запрос для поиска пользователя
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Проверяем результат запроса
    if ($result->num_rows > 0) {
        $message = "Login successful!";
    } else {
        $message = "Invalid email or password!";
    }

    // Закрываем запрос
    $stmt->close();
}

// Закрываем соединение
$conn->close();
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
            <!-- Форма логина -->
            <form method="POST" action="">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>

                <div class="forget-password">
                    <a href="forgot.php">Forget password?</a>
                </div>
            </form>

            <!-- Сообщение после отправки формы -->
            <?php if (!empty($message)): ?>
                <p style="color: red; margin-top: 15px;"><?php echo $message; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
