<!DOCTYPE html>
<html>
<head>
    <title>Vrtua walk ver 2</title>
    <link rel="stylesheet" href="pannellum/pannellum.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <!-- <h2>Загрузка фотографий</h2> -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload" name="submit">
    </form>

    <!-- <h2>Выбор фотографии</h2> -->
    <select id="photoSelector">
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

        // Выполнение запроса к базе данных для получения списка фотографий
        $sql = "SELECT * FROM images";
        $result = $conn->query($sql);

        // Вывод списка фотографий в селекторе
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["path"] . '">' . $row["name"] . '</option>';
            }
        }

        // Закрытие соединения с базой данных
        $conn->close();
        ?>
    </select>

    <button onclick="showPanorama(getSelectedPhoto())">Load image</button>

    <button onclick="deletePanorama()">Delete Panorama</button>

    <div id="panorama"></div>

    <script src="pannellum/pannellum.js"></script>
    <script src="script.js"></script>

</body>
</html>
