<?php

// // Подключение к базе данных
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "kineu__test";

// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Ошибка подключения к базе данных: " . $conn->connect_error);
// }

// // Выборка всех записей из таблицы materials
// $sql = "SELECT * FROM `materials`";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $link = $row['link'];
//         $size = $row['size'];
        
//         // Получение расширения файла
//         if ($size == '0 Мб'){
//             $filesize = round(round(filesize($link)/1024)/1024, 2) . " Мб";
//             $updateSql = "UPDATE `materials` SET `size` = '$filesize' WHERE id = " . $row['id'];
//             if ($conn->query($updateSql) !== TRUE) {
//                 echo "Ошибка при обновлении записи: " . $conn->error;
//             }
//             echo $updateSql . '<br>';
//         }
        
//     }
// } else {
//     echo "В таблице 'materials' нет данных.";
// }

// $conn->close();


?>
