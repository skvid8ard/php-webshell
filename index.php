<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Загрузка файлов</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        button { margin: 10px; padding: 10px; font-size: 16px; }
    </style>
</head>
<body>
    <a href="index.html"><button>Вернуться на главную</button></a>
    <a href="uploads.php"><button>Просмотр загруженных файлов</button></a>
    <h1>Загрузка файлов</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" accept=".mp3,.mp4" required />
        <input type="submit" value="Загрузить файл" />
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $uploadedFile = $_FILES['file'];
        $uploadDir = 'uploads/';
        $allowedExtensions = ['mp3', 'mp4'];
        
        if ($uploadedFile['error'] !== UPLOAD_ERR_OK) {
            echo "<p>Ошибка загрузки: " . $uploadedFile['error'] . "</p>";
            exit;
        }
        
        $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            echo "<p>Ошибка: Разрешены только файлы MP3 и MP4.</p>";
        } else {
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            if (move_uploaded_file($uploadedFile['tmp_name'], $uploadDir . $uploadedFile['name'])) {
                echo "<p>Файл успешно загружен: " . htmlspecialchars($uploadedFile['name']) . "</p>";
            } else {
                echo "<p>Ошибка загрузки файла.</p>";
            }
        }
    }
    ?>
</body>
</html>
