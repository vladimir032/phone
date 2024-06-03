<?php
session_start(); // Начинаем сеанс

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registerUser";

// Создание подключения
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Проверка соединения
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST["login_phone"];
    $pass = $_POST["login_password"];

    // Получение данных пользователя по номеру телефона
    $sql = "SELECT * FROM users WHERE phone = '$phone'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Пользователь найден, проверяем пароль
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['pass'])) {
            // Пароль верный, устанавливаем данные о входе в сеанс
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['logged_in'] = true;
            header("Location: minzdrav.php"); // Перенаправляем пользователя на главную страницу
            exit();
        } else {
            $login_error = "Неверный номер телефона или пароль";
        }
    } else {
        $login_error = "Неверный номер телефона или пароль";
    }
}

// Закрытие соединения с базой данных
mysqli_close($conn);
?>
