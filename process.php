<?php
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

// Получение данных из формы
$phone = $_POST["phone"];
$pass = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
$adress = $_POST["address"];

// Проверка соответствия пароля и его подтверждения
if ($pass != $confirm_password) {
    echo "Пароль и подтверждение пароля не совпадают";
} else {
    // Хеширование пароля
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (phone, pass, adress) VALUES ('$phone', '$hashed_password', '$adress')";

    if (mysqli_query($conn, $sql)) {
        header("Location: minzdrav.php");
    } else {
        echo "Ошибка при регистрации пользователя: " . mysqli_error($conn);
    }
}

// Закрытие соединения с базой данных
mysqli_close($conn);
?>
