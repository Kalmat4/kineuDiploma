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

        $sql = 'SELECT * FROM `materials`';

        $sqlQuery = mysqli_query($link, $sql);
        
        $date; 
        $book__name; 
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
            <label for="id">ID</label>
            <input type="text" name="id" value='<?=$id?>' disabled>
            <label for="date">Дата</label>
            <input type="text" name="date" value="<?=Date("Y-m-d")?>" autocomplete="off">
            <label for="book__name">Название книги</label>
            <input type="text" name="book__name" value=""  autocomplete="off">
            <label for="author">Автор</label>
            <input type="text" name="author" value="" autocomplete="off">
            <label for="co_author">Соавтор</label>
            <input type="text" name="co_author" value="" autocomplete="off">
            <label for="izd">Издательство</label>
            <input type="text" name="izd" value="" autocomplete="off">
            
            <label for="edition">Вид издания</label>
            <select name="edition">
                <option value="">Выберите издание</option>
                    <?php 
                        $editSQL = mysqli_query($link, "SELECT * FROM `edition`");
                        while ($contentEdit = mysqli_fetch_assoc($editSQL)){
                            echo "<option value='{$contentEdit['id']}''>{$contentEdit['title']}</option>";
                        }
                    ?>
            </select>


            <label for="description">Аннотация</label>
            <textarea name="description" class="textarea"><?=strip_tags($contentAdmin['description']);?></textarea>
            <label for="keyWords">Ключевые слова</label>
            <input type="text" name="keyWords" value="" autocomplete="off">
            <label for="format">Формат файла</label>
            <input type="text" name="format" value="" autocomplete="off">
            <label for="size">Размер файла</label>
            <input type="text" name="size" value="" autocomplete="off">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" value="" autocomplete="off">
            <label for="bbk">BBK</label>
            <input type="text" name="bbk" value="" autocomplete="off">
            <label for="udk">UDK</label>
            <input type="text" name="udk" value="" autocomplete="off">
            

            
            <label for="rubric">Предметная рубрика</label>
            <select name="rubric">
                <option value="">Выберите рубрику</option>
                <?php 
                    $rubikSQL = mysqli_query($link, "SELECT * FROM `rubric`");
                    while ($contentRubrik = mysqli_fetch_assoc($rubikSQL)){
                        echo "<option value='{$contentRubrik['id']}'>{$contentRubrik['title']}</option>";
                    }
                ?>
            </select>

            <label for="faculty">Факультет</label>
            <select name="faculty">
                <option value="">Выберите факультет</option>
                        <?php 
                            $facultySQL = mysqli_query($link, "SELECT * FROM `faculty`");
                                
                            while ($contentFac = mysqli_fetch_assoc($facultySQL)){
                                echo "<option value='{$contentFac['id']}'>{$contentFac['title']}</option>";
                            }
                        ?>
            </select>

            <label for="department">Кафедра</label>
            <select name="department">
                <option value="">Выберите кафедру</option>
                        <?php 
                            $departmentSQL = mysqli_query($link, "SELECT * FROM `department`");
                                
                            while ($contentDep = mysqli_fetch_assoc($departmentSQL)){
                                echo "<option value='{$contentDep['id']}'>{$contentDep['title']}</option>";
                            }
                        ?>
            </select>

            <label for="spec">Специальность</label>
            <select name="spec">
                <option value="">Выберите специальность</option>
                    <?php 
                        $specSQL = mysqli_query($link, "SELECT * FROM `spec`");
                        while ($contentSpec = mysqli_fetch_assoc($specSQL)){
                            echo "<option value='{$contentSpec['id']}'>{$contentSpec['title']}</option>";
                        }
                    ?>
            </select>

            
            


            <label for="link">Ссылка на файл</label>
            <input type="text" name="link" value="" autocomplete="off">
            <label for="downloads">Количество скачиваний</label>
            <input type="number" name="downloads" value="" autocomplete="off">

            <input type="submit" value="Подтвердить изменения" class="editConfirmBtn" method="POST" name="confirmEditBtn">
        
    </form>
    <?php
        if (strlen($_POST['date']) > 1){
            $date = "'".$_POST['date']."'";
        }else{
            $date = NULL;
            $date = gettype($date);
        }
        if (strlen($_POST['book__name']) > 1){
            $book__name = "'".$_POST['book__name']."'";
        }else{
            $book__name = NULL;
            $book__name = gettype($book__name);
        }
        if (strlen($_POST['author']) > 1){
            $author = "'".$_POST['author']."'";
        }else{
            $author = NULL;
            $author = gettype($author);
        }
        if (strlen($_POST['co_author']) > 1){
            $co_author = "'".$_POST['co_author']."'";
        }else{
            $co_author = NULL;
            $co_author = gettype($co_author);
        }
        if (strlen($_POST['izd']) > 1){
            $izd = "'".$_POST['izd']."'";
        }else{
            $izd = NULL;
            $izd = gettype($izd);
        }
        if (strlen($_POST['edition']) >= 1){
            $vid_izd = $_POST['edition'];
        }else{
            $vid_izd = NULL;
            $vid_izd = gettype($vid_izd);
        }
        if (strlen($_POST['description']) > 1){
            $description = "'".$_POST['description']."'";
        }else{
            $description = NULL;
            $description = gettype($description);
        }
        if (strlen($_POST['keyWords']) > 1){
            $keyWords = "'".$_POST['keyWords']."'";
        }else{
            $keyWords = NULL;
            $keyWords = gettype($keyWords);
        }
        if (strlen($_POST['format']) >= 1){
            $format = "'".$_POST['format']."'";
        }else{
            $format = NULL;
            $format = gettype($format);
        }
        if (strlen($_POST['size']) >= 1){
            $size = "'".$_POST['size']."'";
        }else{
            $size = NULL;
            $size = gettype($size);
        }
        if (strlen($_POST['isbn']) > 1){
            $isbn = "'".$_POST['isbn']."'";
        }else{
            $isbn = NULL;
            $isbn = gettype($isbn);
        }
        if (strlen($_POST['udk']) > 1){
            $udk = "'".$_POST['udk']."'";
        }else{
            $udk = NULL;
            $udk = gettype($udk);
        }
        if (strlen($_POST['bbk']) > 1){
            $bbk = "'".$_POST['bbk']."'";
        }else{
            $bbk = NULL;
            $bbk = gettype($bbk);
        }
        if (strlen($_POST['rubric']) >= 1){
            $rubric = $_POST['rubric'];
        }else{
            $rubric = NULL;
            $rubric = gettype($rubric);
        }
        if (strlen($_POST['faculty']) >= 1){
            $faculty = $_POST['faculty'];
        }else{
            $faculty = NULL;
            $faculty = gettype($faculty);
        }
        if (strlen($_POST['department']) >= 1){
            $department = $_POST['department'];
        }else{
            $department = NULL;
            $department = gettype($department);
        }
        if (strlen($_POST['spec']) >= 1){
            $spec = $_POST['spec'];
        }else{
            $spec = NULL;
            $spec = gettype($spec);
        }
        if (strlen($_POST['link']) > 1){
            $linkToDownload = "'".$_POST['link']."'";
        }else{
            $linkToDownload = NULL;
            $linkToDownload = gettype($linkToDownload);
        }
        if (strlen($_POST['downloads']) >= 1){
            $downloads = $_POST['downloads'];
        }else{
            $downloads = NULL;
            $downloads = gettype($downloads);
        }

        if (isset($_POST['confirmEditBtn'])){
            $sqlUpdate = "INSERT INTO `materials` (`id`, `date`, 
            `book__name`, `author`, `co_author`, `izd`, 
            `vid_izd_id`, `description`, `keyWords`, 
            `format`, `size`, `isbn`, `bbk`, `udk`, 
            `rubric_id`, `faculty_id`, `department_id`, 
            `spec_id`, `link`, `downloads`) VALUES 
            (NULL, $date, $book__name, $author, $co_author, $izd, 
            $vid_izd, $description, $keyWords, $format, $size, $isbn, $bbk, 
            $udk, $rubric, $faculty, $department, $spec, $linkToDownload,$downloads)";

            mysqli_query($link, $sqlUpdate);
            echo "<script> location.href='adminForm.php?page-0'; </script>";

        }
        
    ?>
   
</div>
<?php

require "footer.php";

?>




