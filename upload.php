<?php
// Подключение к базе данных MySQL
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "virtua_walk_ver2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверка, был ли отправлен файл
if(isset($_FILES["fileToUpload"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Проверка, является ли файл изображением
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            //echo "Файл является изображением - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Файл не является изображением.";
            $uploadOk = 0;
        }
    }

    // Проверка, существует ли уже файл с таким именем
    if (file_exists($target_file)) {
        echo "same name";
        $uploadOk = 0;
    }

    // Проверка размера файла (не более 5 МБ)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Файл слишком большой.";
        $uploadOk = 0;
    }

    // Проверка допустимых форматов файлов (только jpg, jpeg, png)
    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "Допускаются только файлы JPG, JPEG и PNG.";
        $uploadOk = 0;
    }

    // Проверка, была ли установлена ошибка
    if ($uploadOk == 0) {
        echo "file not saved ";
    } else {
        // Загрузка файла на сервер
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "Файл ". basename( $_FILES["fileToUpload"]["name"]). " был успешно загружен.";

            // Сохранение пути файла в базу данных
            $photoName = $_FILES["fileToUpload"]["name"];
            $photoPath = $target_file;

            $sql = "INSERT INTO images (name, path) VALUES ('$photoName', '$photoPath')";
            if ($conn->query($sql) === TRUE) {
                echo "File saved";
            } else {
                echo "Ошибка при сохранении пути к фотографии в базе данных: " . $conn->error;
            }
        } else {
            echo "Произошла ошибка при загрузке файла.";
        }
    }
}

// Закрытие соединения с базой данных
$conn->close();
?>
