<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Просмотр файлов</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        audio, video { display: block; margin-top: 10px; }
        button { margin: 10px; padding: 10px; font-size: 16px; }
    </style>
</head>
<body>
    <a href="index.html"><button>Вернуться на главную</button></a>
    <a href="index.php"><button>Загрузить новый файл</button></a>
    <h1>Просмотр загруженных файлов</h1>
<?php
$uploadDir = 'uploads/';
$files = array_diff(scandir($uploadDir), ['.', '..']);

if (empty($files)) {
    echo "<p>Нет загруженных файлов.</p>";
} else {
    foreach ($files as $file) {
        $filePath = $uploadDir . $file;
        $fullUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $filePath; // Полный URL
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        echo "<p>$file</p>";
        if ($ext === 'mp3') {
            echo "<audio controls><source src='$fullUrl' type='audio/mpeg'>Ваш браузер не поддерживает аудио.</audio>";
        } elseif ($ext === 'mp4') {
            echo "<video controls width='320'><source src='$fullUrl' type='video/mp4'>Ваш браузер не поддерживает видео.</video>";
        }
    }
}
?>
</body>
</html>
