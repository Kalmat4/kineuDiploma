<?php

require "pagesHead.php";

?>

<div class="template">

<?php
require "header.php";

?>

<div class="content">


<a href="stats.php" class="backBtn">Вернуться</a>

<h1 align="center">Статистика размещения материала библиотеки</h1>
<div class="simpleText">Выберите вариант сортировки, посмотрите на результат и скачайте в формате .xlsx (Excel документ)</div>


<?php
$postArray = [
    'pub_year',
    'date',
    'author',
    'faculty_id',
    'spec_id',
    'vid_izd_id',
    'department_id'
];

$selectedPost = '';

for ($i=0;$i<=count($postArray);$i++){
    if (strlen($_POST[$postArray[$i]]) > 0){
        $selectedPost = $postArray[$i];
        $request = 'SELECT `' . $selectedPost . '` FROM `materials`'; 
        echo '<h1 class="statsTitle">' .  $_POST[$selectedPost] . '</h1>';
        
        $postName = $postArray[$i];
        $postValue = $_POST[$postArray[$i]];

        require 'connect.php';
        $link = $_SESSION['db'];

        if ($i < 3){
            $sql = "SELECT " . $postName . ", COUNT(*) as count 
            FROM materials GROUP BY " . $postName . " 
            ORDER BY `count` DESC";
        }else{
            $dataTableName;
            if ($postName != 'vid_izd_id'){
                $dataTableName = str_replace('_id', '', $postName);
            }else{
                $dataTableName = 'edition';
            }
            $sql = "SELECT d.title, COUNT(*) as count 
            FROM materials m
            INNER JOIN " . $dataTableName . " d ON m." . $postName . " = d.id
            GROUP BY m." . $postName . " ORDER BY `count` DESC";
            $postName = 'title';
        }

        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {?>
            <table class="statsTable">
                <tr>
                    <th><?=$_POST[$selectedPost]?></th>
                    <th>Количество книг</th>
                </tr>
            <?php
            // Вывод результатов
            while ($row = $result->fetch_assoc()) {
                if (strlen($row[$postName]) > 0){?>
                    <tr>
                        <td>
                            <?=$row[$postName]?>
                        </td>
                        <td>
                            <?=$row['count']?>
                        </td>
                    </tr>
                <?php }
            }
            echo '</table>';
        } else {
            echo "Нет данных о годах выпуска книг.";
        }


        ?>

        
    <?php }else if ($i == count($postArray) && strlen($selectedPost) == 0){?>
        <form class="stats" method="POST">
            <input class="select pub_year" type="submit" method="POST" name="pub_year" value="Год публикации"/>
            <input class="select date" type="submit" method="POST" name="date" value="Дата загрузки"/>
            <input class="select author" type="submit" method="POST" name="author" value="Автор"/>
            <input class="select faculty" type="submit" method="POST" name="faculty_id" value="Факультет"/>
            <input class="select spec" type="submit" method="POST" name="spec_id" value="Образовательная программа"/>
            <input class="select edition" type="submit" method="POST" name="vid_izd_id" value="Вид издания"/>
            <input class="select department" type="submit" method="POST" name="department_id" value="Кафедра"/>
        </form>
    <?php    
    }
}
?>
</div>
<?php

require "footer.php";

?>



