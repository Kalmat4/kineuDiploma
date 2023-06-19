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
    <form class="inputs" method="POST" enctype="multipart/form-data">
            <label for="id">ID</label>
            <input type="text" name="id" value='<?=$id?>' disabled>
            <label for="date">Дата</label>
            <input type="text" name="date" value="<?=Date("Y-m-d")?>" autocomplete="off">
            <label for="book__name">Название книги</label>
            <input type="text" name="book__name" value=""  autocomplete="off">
            <label for="pub_year">Год публикации</label>
            <input type="text" name="pub_year" value=''  autocomplete="off">
            <label for="pages_count">Количество страниц</label>
            <input type="text" name="pages_count" value=''  autocomplete="off">
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
            <input type="text" name="link" value="files/uploads/" autocomplete="off">
            <label for="upload">Загрузить файл</label>
            <input type="file" name="upload" class="upload" onchange='getLinkString()' accept=".pdf,.docx,.rar,.zip,.7z,.doc,.xlsx,.xls,.txt">
            
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
        if (strlen($_POST['pub_year']) > 1){
            $pub_year = "'".$_POST['pub_year']."'";
        }else{
            $pub_year = NULL;
            $pub_year = gettype($pub_year);
        }
        if (strlen($_POST['pages_count']) > 1){
            $pages_count = "'".$_POST['pages_count']."'";
        }else{
            $pages_count = NULL;
            $pages_count = gettype($pages_count);
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
            `book__name`, `pub_year`, `pages_count`, `author`, `co_author`, `izd`, 
            `vid_izd_id`, `description`, `keyWords`, 
            `format`, `size`, `isbn`, `bbk`, `udk`, 
            `rubric_id`, `faculty_id`, `department_id`, 
            `spec_id`, `link`, `downloads`) VALUES 
            (NULL, $date, $book__name, $pub_year, $pages_count, $author, $co_author, $izd, 
            $vid_izd, $description, $keyWords, $format, $size, $isbn, $bbk, 
            $udk, $rubric, $faculty, $department, $spec, $linkToDownload,$downloads)";

            mysqli_query($link, $sqlUpdate);
            echo "<script> location.href='adminForm.php?page-0'; </script>";

        }





        // Название <input type="file">
    $input_name = 'upload';
    
    // Разрешенные расширения файлов.
    $allow = array();
    
    // Запрещенные расширения файлов.
    $deny = array(
        'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
        'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
        'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi'
    );
    
    // Директория куда будут загружаться файлы.
    $path = __DIR__ . '\\files\\uploads\\';
    
    if (isset($_FILES[$input_name])) {
        // Проверим директорию для загрузки.
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    
        // Преобразуем массив $_FILES в удобный вид для перебора в foreach.
        $files = array();
        $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
        if ($diff == 0) {
            $files = array($_FILES[$input_name]);
        } else {
            foreach($_FILES[$input_name] as $k => $l) {
                foreach($l as $i => $v) {
                    $files[$i][$k] = $v;
                }
            }		
        }	
        
        foreach ($files as $file) {
            $error = $success = '';
    
            // Проверим на ошибки загрузки.
            if (!empty($file['error']) || empty($file['tmp_name'])) {
                switch (@$file['error']) {
                    case 1:
                    case 2: $error = 'Превышен размер загружаемого файла.'; break;
                    case 3: $error = 'Файл был получен только частично.'; break;
                    case 4: $error = 'Файл не был загружен.'; break;
                    case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
                    case 7: $error = 'Не удалось записать файл на диск.'; break;
                    case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
                    case 9: $error = 'Файл не был загружен - директория не существует.'; break;
                    case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
                    case 11: $error = 'Данный тип файла запрещен.'; break;
                    case 12: $error = 'Ошибка при копировании файла.'; break;
                    default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
                }
            } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
                $error = 'Не удалось загрузить файл.';
            } else {
                // Оставляем в имени файла только буквы, цифры и некоторые символы.
                $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                $name = mb_eregi_replace($pattern, '-', $file['name']);
                $name = mb_ereg_replace('[-]+', '-', $name);
                
                // Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
                // Сделаем их транслит:
                $converter = array(
                    'а' => 'a',   'б' => 'b',   'в' => 'v',    'г' => 'g',   'д' => 'd',   'е' => 'e',
                    'ё' => 'e',   'ж' => 'zh',  'з' => 'z',    'и' => 'i',   'й' => 'y',   'к' => 'k',
                    'л' => 'l',   'м' => 'm',   'н' => 'n',    'о' => 'o',   'п' => 'p',   'р' => 'r',
                    'с' => 's',   'т' => 't',   'у' => 'u',    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
                    'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  'ь' => '',    'ы' => 'y',   'ъ' => '',
                    'э' => 'e',   'ю' => 'yu',  'я' => 'ya', 
                
                    'А' => 'A',   'Б' => 'B',   'В' => 'V',    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
                    'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
                    'Л' => 'L',   'М' => 'M',   'Н' => 'N',    'О' => 'O',   'П' => 'P',   'Р' => 'R',
                    'С' => 'S',   'Т' => 'T',   'У' => 'U',    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
                    'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
                    'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
                );
    
                $name = strtr($name, $converter);
                $parts = pathinfo($name);
    
                if (empty($name) || empty($parts['extension'])) {
                    $error = 'Недопустимое тип файла';
                } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                    $error = 'Недопустимый тип файла';
                } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                    $error = 'Недопустимый тип файла';
                } else {
                    // Чтобы не затереть файл с таким же названием, добавим префикс.
                    $i = 0;
                    $prefix = '';
                    while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
                        $prefix = '(' . ++$i . ')';
                    }
                    $name = $parts['filename'] . $prefix . '.' . $parts['extension'];
    
                    // Перемещаем файл в директорию.
                    if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                        // Далее можно сохранить название файла в БД и т.п.
                        $success = 'Файл «' . $name . '» успешно загружен.';
                    } else {
                        $error = 'Не удалось загрузить файл.';
                    }
                }
            }
            
            // Выводим сообщение о результате загрузки.
            if (!empty($success)) {
                echo '<p class="centerStatusText">' . $success . '</p>';		
            } else {
                echo '<p class="centerStatusText">' . $error . '</p>';
            }
        }
    }
        









    ?>
   
</div>
<?php

require "footer.php";

?>




