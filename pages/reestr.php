<?php

require "pagesHead.php";

?>

<div class="template">

<?php
require "header.php";

$pathSomewhere = "../";


?>

<div class="content">
    <div class="container">
        <div class="title">
            Реестр новых поступлений
        </div>

        <div class="main__part">
            <div class="books">
                <?php
                    require 'connect.php';
                    $link = $_SESSION['db'];   
                    error_reporting(0);
                        if(strlen($_SESSION['sql']) > 1){
                            if ($_SERVER['REQUEST_URI'] == '/pages/reestr.php?clear'){
                                $request = "SELECT * FROM `books`";
                            }else{
                                $request = $_SESSION['sql'];   
                            }
                        } else { 
                            $request = "SELECT * FROM `books`";
                        }      
                        $isInputFilled = false;

                        $fieldArray = [
                            'book__name',
                            'author',
                            'keyWords',
                            'rubric',
                            'faculty',
                            'spec',
                            'edition'
                        ];

                        $firstFieldInput = "";
                        $secondFieldInput = "";

                        $firstFieldName = "";
                        $secondFieldName = "";

                        $oneField;
                        $twoField;


                        
                        for ($i=0;$i<count($fieldArray);$i++){


                            $fieldContent = $_POST[$fieldArray[$i]];

                            if (strlen($_POST[$fieldArray[$i]]) >= 1){
                                if (strlen($firstFieldInput) >= 1){
                                    $secondFieldInput = $fieldContent;
                                    $secondFieldName = $fieldArray[$i];
                                    $twoField = $fieldArray[$i];
                                    if ($fieldArray[$i] == 'edition'){
                                        $secondFieldName = 'vid_izd_id';
                                    }
                                    if ($i >= 3 && $i <= 5){
                                        $secondFieldName .= "_id";
                                    }
                                    
                                }else{
                                    $firstFieldName = $fieldArray[$i];
                                    $firstFieldInput = $fieldContent;
                                    $oneField = $fieldArray[$i];
                                    if ($fieldArray[$i] == 'edition'){
                                        $firstFieldName = 'vid_izd_id';
                                    }
                                    if ($i >= 3 && $i <= 5){
                                        $firstFieldName .= "_id";
                                    }
                                }


                            }
                        }

                        function getClearName($param){
                            switch($param){
                                case 'book__name':
                                    $name = 'Название';
                                    break;
                                case 'author':
                                    $name = 'Автор';
                                    break;
                                case 'keyWords':
                                    $name = 'Ключевые слова';
                                    break;
                                case 'rubric_id':
                                    $name = 'Предметная рубрика';
                                    break;
                                case 'faculty_id':
                                    $name = 'Факультет';
                                    break;
                                case 'spec_id':
                                    $name = 'Специальность';
                                    break;
                                case 'vid_izd_id':
                                    $name = 'Вид издания';
                                    break;
                            }
                            return $name;
                            
                        }
                        function getListItemName($id, $name){
                            $link = $_SESSION['db'];
                            $listRequest = "SELECT * FROM `" . $name . "` WHERE `id` = " . $id;

                            $sqlList = mysqli_query($link, $listRequest);
                            $contentListValue = mysqli_fetch_assoc($sqlList);
                            return $contentListValue['title'];
                        }
                        $sortText = 'Сортировка по полю <b>«';
                        if (strlen($secondFieldInput) >= 1 && strlen($firstFieldInput) >= 1){
                            $request = "SELECT * FROM `books` WHERE `" . $firstFieldName . "` LIKE '%" . $firstFieldInput . "%' AND `" . $secondFieldName . "` LIKE '%" . $secondFieldInput . "%'";
                            $isInputFilled = true;


                            $clearName = getClearName($firstFieldName);
                            $firstClearName = $clearName;
                            $clearName = getClearName($secondFieldName);
                            $secondClearName = $clearName;
                            
                            $ifFirstIntValue = (int)$firstFieldInput;
                            $ifSecondIntValue = (int)$secondFieldInput;

                            if ($ifFirstIntValue != 0){
                                $firstFieldInput = getListItemName($ifFirstIntValue, $oneField);   
                            }
                            if ($ifSecondIntValue != 0){
                                $secondFieldInput = getListItemName($ifSecondIntValue, $twoField); 
                            }
                            $sortText .= $firstClearName . "»</b> равное значению <b>«" . $firstFieldInput . "»</b> и по полю <b>«" . $secondClearName . "»</b> равное значению <b>«" . $secondFieldInput . "»</b>";
                        }else if (strlen($firstFieldInput) >= 1){
                            $request = "SELECT * FROM `books` WHERE `" . $firstFieldName . "` LIKE '%" . $firstFieldInput . "%'";
                            $isInputFilled = true;
                            $clearName = getClearName($firstFieldName);

                            $ifFirstIntValue = (int)$firstFieldInput;

                            if ($ifFirstIntValue != 0){
                                $firstFieldInput = getListItemName($ifFirstIntValue, $oneField);  
                            }
                            $sortText .= $clearName . "»</b> равное значению <b>«" . $firstFieldInput . "»</b>";
                        }


                        if ($isInputFilled){
                            $sql = mysqli_query($link, $request);
                            $_SESSION['sql'] = $request;
                            echo "<br/>" . $sortText . "<br/>";
                        }else{
                            $sql = mysqli_query($link, "SELECT * FROM `books`");
                        }


                        $numberOfResults = mysqli_num_rows($sql);
                        $str;
                        switch ($numberOfResults % 10){
                            case 1:
                                $str = " ответ</b>";
                                break;
                            case 2:
                            case 3:
                            case 4:
                                $str = " ответа</b>";
                                break;
                            case 0:
                            case 5:   
                            case 6:
                            case 7:
                            case 8:
                            case 9:
                                $str = " ответов</b>";
                                break;
                        }
                        ?>
                        
                        <div class="text">
                            <?php
                                $count = mysqli_num_rows($sql);
                                if ($count < 1){
                                    $count = 0;
                                }
                                echo "<br>Найдено: <b>" . $count . $str;
                            ?>
                        </div>
                        

                        <?php
                        $pagesPerTime = 5;
                        $page = ""; 
                        $queryStr = $_SERVER["QUERY_STRING"];
                                    
                        $page = str_replace("page-", "", $queryStr);
    
                        $products = mysqli_num_rows($sql);
                                    
                        $page__count = floor($products / $pagesPerTime); 
                        
                        function getInfo($sqlText){ 
                            $pagesPerTime = 5;
                            $page = ""; 
                            $queryStr = $_SERVER["QUERY_STRING"];
                                        
                            $page = str_replace("page-", "", $queryStr);
        
                            $products = mysqli_num_rows($sqlText);
                                        
                            $page__count = floor($products / $pagesPerTime); 
        
                                        
                            $page__counter = 1;
                                $i=0;
                                while ($content = mysqli_fetch_assoc($sqlText)){
                                        if($i >= (int)$page*$pagesPerTime && $i <= ((int)$page+1)*$pagesPerTime):?>
                                        <div class="book__item">


                                            <?php if (strlen(strip_tags($content['book__name'])) > 5):?>
                                                <div class="field book__title"><span><?=strip_tags($content['book__name'])?></div> <!--Заголовок-->
                                            <?php endif;?>

                                            
                                            <?php if (strlen(strip_tags($content['vid_izd_id'])) > 5):?>
                                                <div class="field edition__type">Вид издания: <span class="value"><?=strip_tags($content['vid_izd'])?></span></div> <!--Вид издания-->
                                            <?php endif;?>
                                            
                                            <?php if (strlen(strip_tags($content['izd'])) > 5):?>
                                                <div class="field edition">Издательство: <span class="value"><?=strip_tags($content['izd'])?></span></div> <!--Издательство-->
                                            <?php endif;?>
                                            
                                            <?php if (strlen(strip_tags($content['author'])) > 5):?>
                                                <div class="field author">Автор: <span class="value"><?=strip_tags($content['author'])?></span></div> <!--Автор-->
                                            <?php endif;?>
                                            <?php if (strlen(strip_tags($content['co_author'])) > 5):?>
                                                <div class="field co-author">Со автор: <span class="value"><?=strip_tags($content['co_author'])?></span></div> <!--Со автор-->
                                            <?php endif;?>
                                            
                                            <?php if (strlen(strip_tags($content['description'])) > 5):?>
                                                <div class="field annotation">Аннотация: <span class="value" ><?=strip_tags($content['description'])?></span></div> <!--Аннотация-->
                                            <?php endif;?>    
                                            
                                            <?php if (strlen(strip_tags($content['keyWords'])) > 5):?>
                                                <div class="field keyWords">Ключевые слова: <span class="value"><?=strip_tags($content['keyWords'])?></span></div> <!--Ключевые слова-->
                                            <?php endif;?>        
                                            
                                            <?php if (strlen(strip_tags($content['isbn'])) > 2):?>
                                                <div class="field ISBN">ISBN: </span><span class="value"><?=strip_tags($content['isbn'])?></span></div> <!--ISBN-->
                                            <?php endif;?>
                                            
                                            <?php if (strlen(strip_tags($content['bbk'])) > 2):?>
                                                <div class="field BBK">ББК: </span><span class="value"><?=strip_tags($content['bbk'])?></span></div> <!--ББК-->
                                            <?php endif;?>

                                            <?php if (strlen(strip_tags($content['udk'])) > 2):?>
                                                <div class="field UDK">УДК: </span><span class="value"><?=strip_tags($content['udk'])?></span></div> <!--УДК-->
                                            <?php endif;?>   
                                            
                                            <?php if (strlen(strip_tags($content['faculty_id'])) > 5):?>
                                                <div class="field faculty">Факультет: <span class="value"><?=strip_tags($content['faculty'])?></span></div> <!--Факультет-->
                                            <?php endif;?>


                                            <?php if (strlen(strip_tags($content['department_id'])) > 5):?>
                                                <div class="field department">Кафедра: <span class="value"><?=strip_tags($content['department'])?></span></div> <!--Кафедра-->
                                            <?php endif;?>


                                            <?php if (strlen(strip_tags($content['spec_id'])) > 5):?>
                                                <div class="field speciality">Специальность: <span class="value"><?=strip_tags($content['speciality'])?></span></div> <!--Специальность-->
                                            <?php endif;?>

                                            <?php if (strlen(strip_tags($content['size'])) > 1 && strlen(strip_tags($content['format'])) > 1):?>
                                                    <div class="field format">Данные о файле: <span class="value"><?=strip_tags($content['size']) . " ." . strip_tags($content['format'])?></div> <!--Тип и размер файла-->
                                            <?php endif;?>


                                            <?php if (strlen(strip_tags($content['link'])) > 5){
                                                
                                                if(file_exists(strip_tags($content['link']))){?>
                                                    <a href="<?=$content['link']?>">
                                                        <button class="moreInfoBtn">
                                                            Скачать
                                                        </button>
                                                    </a>
                                                <?php }else{ ?>
                                                    <button class="disabledBtn">
                                                        Скачать
                                                    </button>
                                                    <span>Файл недоступен</span>
                                                <?php } ?>
                                                
                                                
                                                 <!--Кнопка скачать-->
                                            <?php } ?>


                                            <?php if (strlen(strip_tags($content['downloads'])) > 0):?>
                                                <div class="downloads">Количество скачиваний: <span class="value"><?=strip_tags($content['downloads'])?></span></div> <!--Количество скачиваний-->
                                            <?php endif;?>


                                        </div>

                                        <?php endif;

                                    $i++;
                                    $page__counter++;
                                }
                        
                        } 
                        
                        getInfo($sql);

                        
                ?>
            </div>
            <div class="sort">
                
                <div class="tip" >
                    <p>Для выбора сортировки данных, вы можете выбрать не более двух полей! По необходимости, можно сбросить сортировку</p>
                </div>
                <form action="" method="POST" class="formSort" >
                <span>Поиск
                    <span class="information" onmouseover="showTip()" onmouseout="closeTip()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                
                            </svg>
                    </span>
                </span>
                    <label for="book__name">Название</label>
                    <input type="text" class="fieldEnter" name="book__name" oninput="changedInput = 'book__name'; " autocomplete="off" value='<?php if(isset($_POST["book__name"])) echo $_POST["book__name"]; ?>'>

                    <label for="author">Автор</label>
                    <input type="text" class="fieldEnter"  name="author" oninput="changedInput = 'author'; " autocomplete="off" value='<?php if(isset($_POST["author"])) echo $_POST["author"]; ?>'>

                    <label for="keyWords">Ключевые слова</label>
                    <input type="text" class="fieldEnter"  name="keyWords" oninput="changedInput = 'keyWords'; " autocomplete="off" value='<?php if(isset($_POST["keyWords"])) echo $_POST["keyWords"]; ?>'>

                    <label for="rubric">Предметная рубрика</label>
                    <select name="rubric" class="fieldEnter"  id="rubric__id" oninput="changedInput = 'rubric';">
                        <option value="">Выберите рубрику</option>
                        <?php 
                            $rubikSQL = mysqli_query($link, "SELECT * FROM `rubric`");
                            while ($contentRubrik = mysqli_fetch_assoc($rubikSQL)){
                                echo "<option value='{$contentRubrik['id']}'>{$contentRubrik['title']}</option>";
                            }
                        ?>
                    </select>

                    <label for="faculty">Факультет</label>
                    <select name="faculty" class="fieldEnter"  id="faculty__id" oninput="changedInput = 'faculty';">
                        <option value="">Выберите факультет</option>
                        <?php 
                            $facultySQL = mysqli_query($link, "SELECT * FROM `faculty`");
                            
                            while ($contentFac = mysqli_fetch_assoc($facultySQL)){
                                echo "<option value='{$contentFac['id']}'>{$contentFac['title']}</option>";
                            }
                        ?>
                    </select>

                    <label for="spec">Специальность</label>
                    <select name="spec" class="fieldEnter"  id="spec__id" oninput="changedInput = 'spec';">
                        <option value="">Выберите специальность</option>
                        <?php 
                            $specSQL = mysqli_query($link, "SELECT * FROM `spec`");
                            while ($contentSpec = mysqli_fetch_assoc($specSQL)){
                                echo "<option value='{$contentSpec['id']}'>{$contentSpec['title']}</option>";
                            }
                        ?>
                    </select>

                    <label for="edition">Вид издания</label>
                    <select name="edition" class="fieldEnter"  id="edition__id" oninput="changedInput = 'edition';">
                        <option value="">Выберите издание</option>
                        <?php 
                            $editSQL = mysqli_query($link, "SELECT * FROM `edition`");
                            while ($contentEdit = mysqli_fetch_assoc($editSQL)){
                                echo "<option value='{$contentEdit['id']}''>{$contentEdit['title']}</option>";
                            }
                        ?>
                    </select>

                    <button class="moreInfoBtn" name="findButton">Поиск</button>
                    <button class="moreInfoBtn" name="clear" method="GET">
                        <a href="?clear" onclick="clearSession()">
                            Сбросить
                        </a>
                    </button>
                </form>
                <?php
                    if (isset($_GET['clear'])){
                        $_SESSION['sql'] = "SELECT * FROM `books`";
                    }
                
                ?>
                
            </div>       
        </div>
        <div class="navigation__menu">
                

                <?php 
                    $addClassPrev = "";
                    $pagesVarPrev = "page-" . (string)((int)$page - 1);
                    $addClassNext = "";
                    $pagesVarNext = "page-" . (string)((int)$page + 1);
                    if ((string)((int)$page - 1) < 0){
                        $addClassPrev = "disable";
                    }
                    if ((string)((int)$page + 1) >= $page__count){
                        $addClassNext = "disable";
                    }
                    
                    echo "<style>";
                    echo "." . $queryStr . "{";
                        echo "background-color: var(--backgroundColor);color:#fff;}";
                    echo "</style>";
                    
                    if (!($addClassNext == "disable" && $addClassPrev == "disable")):
                ?>
                <a href="?<?=$pagesVarPrev?>" class=" <?=$addClassPrev ?>">
                    <button class="nav__btn__arrows <?=$pagesVarPrev ?>" method="GET" name="page" >
                        <img src="../images/arrow.png" alt="" class="pagination__arrow__img pagination__prev__arrow">
                    </button>
                </a>
                <?php
                for ($p = (int)$page-1;$p < (int)$page+2; $p++ ):
                        if ($p == -1){
                            $p += 1;
                        }
                            $pagesVar = "page-" . $p;
                            if ($p != $page__count):?>
                        
                                <a href="?page-<?php echo $p;?>"  >
                                    <button class="nav__btn <?=$pagesVar ?>" method="GET" name="page">
                                        <?php echo $p + 1?>
                                    </button>
                                </a>
                            <?php else:?>
                                <a href="?page-0" >
                                    <button class="nav__btn page-0" method="GET" name="page">
                                        1
                                    </button>
                                </a>
                            <?php endif;?>
                        

                <?php endfor;?>

                
                <a href="" class="disable">
                    <button class="nav__btn">
                        ...
                    </button>
                </a>  


                <a href="<?="?page-" . ($page__count - 1)?>">
                    <button class="nav__btn <?="page-" . ($page__count - 1) ?>" method="GET" name="page" >
                        <?=$page__count?>
                    </button>
                </a>   


                
                <a href="?<?=$pagesVarNext?>"  class=" <?=$addClassNext ?>">
                    <button class="nav__btn__arrows <?=$pagesVarNext ?>" method="GET" name="page" >
                        <img src="../images/arrow.png" alt="" class="pagination__arrow__img pagination__next__arrow">
                    </button>
                </a>
                <?php endif;?>
        </div>
    </div>
</div>


<?php

require "footer.php";

?>
