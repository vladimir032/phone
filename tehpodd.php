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
        .support-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: 50px 50px 50px 750px; /* Добавлено для отступа от шапки */
        }
        .support-form input[type="text"],
        .support-form input[type="email"],
        .support-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .support-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .support-form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .success-message {
            display: none;
            color: #4CAF50;
            margin-top: 10px;
        }
    </style>
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

<div class="support-form">
    <h2>Свяжитесь с нами</h2>
    <form id="supportForm" action="send_message.php" method="POST">
        <input type="text" id="message" name="message" placeholder="Введите ваше сообщение" required><br>
        <input type="email" id="email" name="email" placeholder="Введите вашу электронную почту" required><br>
        <input type="submit" value="Отправить">
    </form>
    <p class="success-message" id="successMessage">Сообщение успешно отправлено!</p>
</div>

<script>
    document.getElementById('supportForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var message = document.getElementById('message').value;
        var email = document.getElementById('email').value;
        var emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|mail\.ru|grsu\.by)$/;
        if (emailPattern.test(email)) {
            document.getElementById('successMessage').style.display = 'block';
            document.getElementById('message').value = '';
            document.getElementById('email').value = '';
            setTimeout(function() {
                document.getElementById('successMessage').style.display = 'none';
            }, 3000);
        } else {
            alert('Пожалуйста, введите корректный адрес электронной почты (gmail.com, mail.ru или grsu.by)');
        }
    });
</script>


</body>
</html>
