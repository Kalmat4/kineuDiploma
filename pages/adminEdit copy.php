<?php

require "pagesHead.php";

?>

<div class="template">

<?php
require "header.php";

?>

<div class="content">
    <span class="title">
        Редактирование книги
    </span>
    <p class="simpleText">
        Это панель администратора библиотеки Костанайского Инженерно-Экономического Университета им. М.Дулатова. Здесь вы можете редактировать данные в базе данных книг бибилиотеки.
    </p>
    <a href="adminForm.php" class="backBtn">Вернуться</a>
    <?php
    
        require 'connect.php';
        $link = $_SESSION['db'];
        $id = $_GET['bookId'];

        $sql = 'SELECT * FROM `materials` WHERE `id` = ' . $id;

        $sqlQuery = mysqli_query($link, $sql);
        
        $date; 
        $book__name; 
        $pub_year; 
        $pages_count; 
        $author; 
        $co_author; 
        $izd;
        $vid_izd; 
        $description; 
        $keyWords; 
        $format; 
        $size; 
        $isbn;
        $udk; 
        $bbk; 
        $rubric; 
        $faculty; 
        $department; 
        $spec;
        $link; 
        $downloads;
    ?>
    <form class="inputs" method="POST">
        <?php while($contentAdmin = mysqli_fetch_assoc($sqlQuery)):?>
            <label for="id">ID</label>
            <input type="text" name="id" value='<?=$id?>' disabled>
            <label for="date">Дата</label>
            <input type="text" name="date" value="<?=$contentAdmin['date'];?>" autocomplete="off" disabled>
            <label for="book__name">Название книги</label>
            <textarea name="book__name" class="textarea"><?=$contentAdmin['book__name'];?></textarea>
            <label for="pub_year">Год публикации</label>
            <input type="text" name="pub_year" value='<?=$contentAdmin['pub_year']?>'>
            <label for="pages_count">Количество страниц</label>
            <input type="text" name="pages_count" value='<?=$contentAdmin['pages_count']?>'>
            <label for="author">Автор</label>
            <input type="text" name="author" value="<?=$contentAdmin['author'];?>" autocomplete="off">
            <label for="co_author">Соавтор</label>
            <input type="text" name="co_author" value="<?=$contentAdmin['co_author'];?>" autocomplete="off">
            <label for="izd">Издательство</label>
            <input type="text" name="izd" value="<?=$contentAdmin['izd'];?>" autocomplete="off">
            
            <label for="edition">Вид издания</label>
            <select name="edition">
                <option value="">Выберите издание</option>
                    <?php 
                        $editSQL = mysqli_query($link, "SELECT * FROM `edition`");
                        while ($contentIzd = mysqli_fetch_assoc($editSQL)){ ?>
                            <option value='<?=$contentIzd['id']?>' <?php if ($contentAdmin['vid_izd_id'] == $contentIzd['id']) :?> selected="selected"  <?php endif; ?>> <?=$contentIzd['title']?></option>
                        <?php } ?>
                    ?>
            </select>


            <label for="description">Аннотация</label>
            <textarea name="description" class="textarea"><?=strip_tags($contentAdmin['description']);?></textarea>
            <label for="keyWords">Ключевые слова</label>
            <input type="text" name="keyWords" value="<?=$contentAdmin['keyWords'];?>" autocomplete="off">
            <label for="format">Формат файла</label>
            <input type="text" name="format" value="<?=$contentAdmin['format'];?>" autocomplete="off">
            <label for="size">Размер файла</label>
            <input type="text" name="size" value="<?=$contentAdmin['size'];?>" autocomplete="off">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" value="<?=$contentAdmin['isbn'];?>" autocomplete="off">
            <label for="bbk">BBK</label>
            <input type="text" name="bbk" value="<?=$contentAdmin['bbk'];?>" autocomplete="off">
            <label for="udk">UDK</label>
            <input type="text" name="udk" value="<?=$contentAdmin['udk'];?>" autocomplete="off">
            

            
            <label for="rubric">Предметная рубрика</label>
            <select name="rubric">
                <option value="">Выберите рубрику: </option>
                        <?php 
                            $rubSQL = mysqli_query($link, "SELECT * FROM `rubric`");
                                
                            while ($contentRub = mysqli_fetch_assoc($rubSQL)){ ?>
                                <option value='<?=$contentRub['id']?>' <?php if ($contentAdmin['rubric_id'] == $contentRub['id']) :?> selected="selected"  <?php endif; ?>> <?=$contentRub['title']?></option>
                            <?php } ?>
                        
            </select>

            <label for="faculty">Факультет</label>
            <select name="faculty">
                <option value="">Выберите факультет</option>
                        <?php 
                            $facultySQL = mysqli_query($link, "SELECT * FROM `faculty`");
                                
                            while ($contentFac = mysqli_fetch_assoc($facultySQL)){ ?>
                                <option value='<?=$contentFac['id']?>' <?php if ($contentAdmin['faculty_id'] == $contentFac['id']) :?> selected="selected"  <?php endif; ?>> <?=$contentFac['title']?></option>
                            <?php } ?>
                        
            </select>

            <label for="department">Кафедра</label>
            <select name="department">
                <option value="">Выберите кафедру</option>
                        <?php 
                            $departmentSQL = mysqli_query($link, "SELECT * FROM `department`");
                                
                            while ($contentDep = mysqli_fetch_assoc($departmentSQL)){ ?>
                                <option value='<?=$contentDep['id']?>' <?php if ($contentAdmin['department_id'] == $contentDep['id']) :?> selected="selected"  <?php endif; ?>> <?=$contentDep['title']?></option>
                            <?php } ?>
                        
            </select>

            <label for="spec">Специальность</label>
            <select name="spec">
                <option value="">Выберите специальность</option>
                    <?php 
                        $specSQL = mysqli_query($link, "SELECT * FROM `spec`");

                        while ($contentSpec = mysqli_fetch_assoc($specSQL)){ ?>
                            <option value='<?=$contentSpec['id']?>' <?php if ($contentAdmin['spec_id'] == $contentSpec['id']) :?> selected="selected"  <?php endif; ?>> <?=$contentSpec['title']?></option>
                        <?php } ?>
            </select>

            
            


            <label for="link">Ссылка на файл</label>
            <input type="text" name="link" value="<?=$contentAdmin['link'];?>" autocomplete="off" >
            <label for="downloads">Количество скачиваний</label>
            <input type="text" name="downloads" value="<?=$contentAdmin['downloads'];?>" autocomplete="off">

            <input type="submit" value="Подтвердить изменения" class="editConfirmBtn" method="POST" name="confirmEditBtn">
        <?php endwhile; ?>
    </form>
    <?php
        if (strlen($_POST['book__name']) > 1){
            $book__name = "`book__name` = '" . $_POST['book__name'] . "', ";
        }
        if (strlen($_POST['pub_year']) > 1){
            $pub_year = "`pub_year` = '" . $_POST['pub_year'] . "', ";
        }
        if (strlen($_POST['pages_count']) > 1){
            $pages_count = "`pages_count` = '" . $_POST['pages_count'] . "', ";
        }
        if (strlen($_POST['author']) > 1){
            $author = "`author` = '" . $_POST['author'] . "', ";
        }
        if (strlen($_POST['co_author']) > 1){
            $co_author = "`co_author` = '" . $_POST['co_author'] . "', ";
        }
        if (strlen($_POST['izd']) > 1){
            $izd = "`izd` = '" . $_POST['izd'] . "', ";
        }
        if (strlen($_POST['edition']) >= 1){
            $vid_izd = "`vid_izd_id` = '" . $_POST['edition'] . "', ";
        }
        if (strlen($_POST['description']) > 1){
            $description = "`description` = '" . $_POST['description'] . "', ";
        }
        if (strlen($_POST['keyWords']) > 1){
            $keyWords = "`keyWords` = '" . $_POST['keyWords'] . "', ";
        }
        if (strlen($_POST['format']) >= 1){
            $format = "`format` = '" . $_POST['format'] . "', ";
        }
        if (strlen($_POST['size']) >= 1){
            $size = "`size` = '" . $_POST['size'] . "', ";
        }
        if (strlen($_POST['isbn']) > 1){
            $isbn = "`isbn` = '" . $_POST['isbn'] . "', ";
        }
        if (strlen($_POST['udk']) > 1){
            $udk = "`udk` = '" . $_POST['udk'] . "', ";
        }
        if (strlen($_POST['bbk']) > 1){
            $bbk = "`bbk` = '" . $_POST['bbk'] . "', ";
        }
        if (strlen($_POST['rubric']) >= 1){
            $rubric = "`rubric_id` = '" . $_POST['rubric'] . "', ";
        }
        if (strlen($_POST['faculty']) >= 1){
            $faculty = "`faculty_id` = '" . $_POST['faculty'] . "', ";
        }
        if (strlen($_POST['department']) >= 1){
            $department = "`department_id` = '" . $_POST['department'] . "', ";
        }
        if (strlen($_POST['spec']) >= 1){
            $spec = "`spec_id` = '" . $_POST['spec'] . "', ";
        }
        if (strlen($_POST['link']) > 1){
            $linkToDownload = "`link` = '" . $_POST['link'] . "', ";
        }
        if (strlen($_POST['downloads']) >= 1){
            $downloads = "`downloads` = '" . $_POST['downloads'] . "', ";
        }



        if (isset($_POST['confirmEditBtn'])){
            $sqlUpdate = "UPDATE `materials` SET " . $book__name . $pub_year . $pages_count . $author . $co_author . $izd . $vid_izd . $description . $keyWords . $format . $size . $isbn . $bbk . $udk . $rubric . $faculty . $department . $spec . $linkToDownload . $downloads . " WHERE `materials`.`id` = " . $id;
            $dotPoint = strpos($sqlUpdate,'WHERE');
            $sqlUpdate[$dotPoint-3] = " ";
            
            mysqli_query($link, $sqlUpdate);
            if (mysqli_query($link, $sqlUpdate) == false){
                echo $sqlUpdate . "<br>";
                echo '<p class="centerStatusText">При обработке запроса произошла ошибка: ';
                echo mysqli_error($link);
                echo '</p>';
            }else{
                echo '<p class="centerStatusText">Успешно</p>';
            }

            echo "<script> location.href='adminForm.php?page-0'; </script>";

        }
        
    ?>
   
</div>
<?php

require "footer.php";

?>




