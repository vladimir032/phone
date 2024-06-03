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

// Запрос данных о текущем пользователе
$sql = "SELECT phone, adress FROM users ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Получаем данные пользователя
    $row = mysqli_fetch_assoc($result);
    $phone = $row["phone"];
    $address = $row["adress"];
} else {
    echo "Пользователь не найден";
}

// Закрытие соединения с базой данных
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Мой профиль</title>
    <style>

        h1 {
            margin-left: 750px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 300px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .container h2 {
            text-align: center;
        }
        .profile-info label {
            display: block;
            margin-bottom: 5px;
        }
        .profile-info input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .profile-info input[type="text"]:read-only {
            background-color: #f9f9f9;
        }
        #editProfileForm {
            display: none;
        }
        #editProfileButton {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        #editProfileButton:hover {
            background-color: #45a049;
        }
    </style>
    <div class="header">
        <h1>Телефонный справочник</h1>
        <div class="header-buttons">
            <button class="header-button"><a href="tehpodd.php" style="text-decoration: none; color: inherit;">Техподдержка</a></button>
            <button class="header-button"><a href="minzdrav.php" style="text-decoration: none; color: inherit;">Главная</a></button>
            <button class="header-button"><a href="profile.php" style="text-decoration: none; color: inherit;">Мой профиль</a></button>
        </div>
    </div>
</head>
<body>

<div class="container">
    <h2>Мой профиль</h2>
    <div class="profile-info" id="profileInfo">
        <label for="name">Имя и Фамилия:</label>
        <input type="text" id="name" name="name" value="<?php echo "ФИО"; ?>" readonly>
        <label for="phone">Номер телефона:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" readonly>
        <label for="address">Адрес:</label>
        <input type="text" id="address" name="address" value="<?php echo $address; ?>" readonly>
    </div>
    <button id="editProfileButton" onclick="toggleEdit()">Редактировать профиль</button>
    <form id="editProfileForm" onsubmit="saveChanges(); return false;">
        <label for="newName">Имя и Фамилия:</label>
        <input type="text" id="newName" name="newName" required>
        <label for="newPhone">Новый номер телефона:</label>
        <input type="text" id="newPhone" name="newPhone" required>
        <label for="newAddress">Новый адрес:</label>
        <input type="text" id="newAddress" name="newAddress" required>
        <input type="submit" value="Сохранить изменения">
    </form>
</div>

<script>
    function toggleEdit() {
        var profileInfo = document.getElementById('profileInfo');
        var editProfileForm = document.getElementById('editProfileForm');
        var editProfileButton = document.getElementById('editProfileButton');

        profileInfo.style.display = 'none';
        editProfileForm.style.display = 'block';
        editProfileButton.style.display = 'none';

        // Заполним поля новой информацией из профиля, чтобы пользователь мог их изменить
        document.getElementById('newName').value = document.getElementById('name').value;
        document.getElementById('newPhone').value = document.getElementById('phone').value;
        document.getElementById('newAddress').value = document.getElementById('address').value;
    }

    function saveChanges() {
        var newName = document.getElementById('newName').value;
        var newPhone = document.getElementById('newPhone').value;
        var newAddress = document.getElementById('newAddress').value;

        // Сохранение измененных данных в профиле
        document.getElementById('name').value = newName;
        document.getElementById('phone').value = newPhone;
        document.getElementById('address').value = newAddress;

        // Скрытие формы редактирования и отображение основной информации о профиле
        document.getElementById('profileInfo').style.display = 'block';
        document.getElementById('editProfileForm').style.display = 'none';
        document.getElementById('editProfileButton').style.display = 'block';
    }
</script>

</body>
</html>