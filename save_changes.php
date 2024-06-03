<?php
// Подключение к базе данных (замените данными вашего сервера)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "telephone_directory";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из POST запроса
    $id = $_POST["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    $position = $_POST["position"];
    $person_info = $_POST["person_info"];

    // Подготовка SQL запроса для обновления данных контакта
    $sql = "UPDATE telephone_directory SET name='$name', address='$address', phone_number='$phone_number', position='$position', person_info='$person_info' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Закрытие соединения с базой данных
$conn->close();
?>
