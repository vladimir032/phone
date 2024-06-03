<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow" />
    <title>Справочник абонентов</title>
    <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css"/>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="minzdrav.css">
    <style>
        .action-button {
            padding: 8px 16px;
            margin-right: 8px;
            border: none;
            border-radius: 4px;
            background-color: red;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        .edit-form {
            display: none;
        }
    </style>
    <script src="bdscript.js"></script>
</head>
<body>

<div class="header">
    <h1>Телефонный справочник</h1>
    <div class="header-buttons">
        <button class="header-button"><a href="tehpodd.php" style="text-decoration: none; color: inherit;">Техподдержка</a></button>
        <button class="header-button"><a href="minzdrav.php" style="text-decoration: none; color: inherit;">Главная</a></button>
        <button class="header-button"><a href="profile.php" style="text-decoration: none; color: inherit;">Мой профиль</a></button>
    </div>
</div>
<div id="abonents">
    <div class="title"></div>
    <table class="filter">
        <tr>
            <td>
                <input type="text" id="qsearch" value="" placeholder="Поиск..."/>
            </td>
        </tr>
    </table>
    <table id="personal" class="table table-bordered table-striped" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Инициалы</th>
            <th>Адрес</th>
            <th>Мобильный телефон</th>
            <th>Должность</th>
            <th>Описание</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
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

        // Получение данных из базы данных
        $sql = "SELECT id, name, address, phone_number, position, person_info FROM telephone_directory";
        $result = $conn->query($sql);

        // Вывод данных в виде HTML-таблицы
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["phone_number"] . "</td>";
                echo "<td>" . $row["position"] . "</td>";
                echo "<td>" . $row["person_info"] . "</td>";
                echo "<td>";
                echo "<button class='action-button' onclick='deleteContact(" . $row["id"] . ")'>Удалить</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }

        // Закрытие соединения с базой данных
        $conn->close();
        ?>
        </tbody>
    </table>
</div>

<div id="editForm" class="edit-form">
        <h2>Редактировать контакт</h2>
        <form id="editContactForm" onsubmit="saveChanges(); return false;">
            <input type="hidden" id="editId" name="id">
            <label for="editName">Имя:</label><br>
            <input type="text" id="editName" name="name"><br>
            <label for="editAddress">Адрес:</label><br>
            <input type="text" id="editAddress" name="address"><br>
            <label for="editPhoneNumber">Мобильный телефон:</label><br>
            <input type="text" id="editPhoneNumber" name="phone_number"><br>
            <label for="editPosition">Должность:</label><br>
            <input type="text" id="editPosition" name="position"><br>
            <label for="editPersonInfo">Описание:</label><br>
            <textarea id="editPersonInfo" name="person_info"></textarea><br>
            <button type="submit">Сохранить</button>
        </form>
</div>

<script>
    function deleteContact(id) {
        if (confirm("Вы уверены, что хотите удалить этот контакт?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // Перезагрузить страницу после успешного удаления
                    location.reload();
                }
            };
            xhttp.open("GET", "delete_contact.php?id=" + id, true);
            xhttp.send();
        }
    }

</script>

</body>
</html>
