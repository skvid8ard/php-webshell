<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Файловая загрузка</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="file"], input[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Загрузка файлов</h1>
    <p>Вы можете загрузить любой файл.</p>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" accept="*/*" required />
        <input type="submit" value="Загрузить файл" />
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $uploadedFile = $_FILES['file'];
        $uploadDir = 'uploads/';

        // Создаем директорию, если она не существует
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir);
        }

        // Перемещаем загруженный файл в директорию
        if (move_uploaded_file($uploadedFile['tmp_name'], $uploadDir . $uploadedFile['name'])) {
            echo "<p>Файл успешно загружен: " . htmlspecialchars($uploadedFile['name']) . "</p>";
        } else {
            echo "<p>Ошибка загрузки файла.</p>";
        }
    }
    ?>
</body>
</html>

