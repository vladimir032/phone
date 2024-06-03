<?php
// Подключение к базе данных
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

// Получение ID контакта, который нужно удалить
$id = $_GET['id'];

// SQL запрос для удаления контакта
$sql = "DELETE FROM telephone_directory WHERE id=$id";

// Выполнение запроса
if ($conn->query($sql) === TRUE) {
    echo "Contact deleted successfully";
} else {
    echo "Error deleting contact: " . $conn->error;
}

// Закрытие соединения
$conn->close();
?>
