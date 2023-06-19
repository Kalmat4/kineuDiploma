<?php

require "pagesHead.php";

?>

<div class="template">

<?php
session_start();
require 'connect.php';
$link = $_SESSION['db'];

$sqlAuth = mysqli_query($link,'SELECT * FROM `admin`');

while ($check = mysqli_fetch_assoc($sqlAuth)){
    if ($_SESSION['login'] == $check['login'] && $_SESSION['password'] == $check['password']){
        
        require "header.php";
        ?>

        <div class="content">

            <span class="title">
                Панель администратора
            </span>
            <p class="simpleText">
                Это панель администратора библиотеки Костанайского Инженерно-Экономического Университета им. М.Дулатова. Здесь вы можете редактировать данные в базе данных книг бибилиотеки.
            </p>
            <div class="redirectBtn">
                <a href="stats.php">Статистика размещения</a>
            </div>
            <form class="searchBox" method="POST">
                <input type="text" name="search" class="searchInput" autocomplete='off' placeholder="Введите название книги">
                <input type="submit" name="searchBtn" value="Поиск" class="searchInputBtn" method="POST">
                <input type="submit" name="clearBtn" value="Очистить" class="clearInputBtn" method="POST">
            </form>
            <div class="differentTable-wrap">
                <div class="msgdialog hiddendialog">
                    <h1>Вы уверены что хотите удалить одну запись?</h1>
                    <div class="msgbtns">
                        <a href="?confirmBookDelete=0" class="msgbtn cancelBtn">Отмена</a>
                        <a href="?confirmBookDelete=1" class="msgbtn yesBtn">Да</a>
                    </div>
                </div>
                    <table>
                        <tr>
                            <?php
                                require 'connect.php';
                                error_reporting(0);
                                $link = $_SESSION['db'];
                                if (!(isset($_POST['clearBtn']))){
                                    $search = $_POST['search'];
                                    if (strlen($_POST['search']) > 0){
                                        $_SESSION['search'] = $_POST['search'];
                                    }
                                    $onTime = $_SESSION['search'];
                                    if (strlen($_SESSION['search']) > 0){
                                        $request = "SELECT * FROM `materials` WHERE `book__name` LIKE '%$onTime%' ORDER BY `materials`.`id` DESC";
                                    }else{
                                        $request = "SELECT * FROM `materials` ORDER BY `id` DESC";
                                    }
                                    $sql = mysqli_query($link, $request);

                                    if (strlen($onTime) > 0){
                                        echo "<p align='center'><b>Результаты поиска: По запросу <<$onTime>> найдено: " . mysqli_num_rows($sql) . " - результатов</b></p>";
                                    }
                                }else{
                                    $_SESSION['search'] = '';
                                    $search = '';
                                    $request = "SELECT * FROM `materials` ORDER BY `id` DESC";
                                    $sql = mysqli_query($link, $request);
                                }   


                                echo "<th class='th'>ID</th>";
                                echo "<th class='th'>Дата</th>";   
                                echo "<th class='th'>Название книги</th>";   
                                echo "<th class='th'></th>";  

                                if (strlen($_GET['bookId']) > 0){
                                    $_SESSION['bookId'] = $_GET['bookId'];
                                }

                                if ($_GET['confirmBookDelete'] == 1){
                                    $delSql = 'DELETE FROM `materials` WHERE `id` = ' . $_SESSION['bookId'];
                                    mysqli_query($link, $delSql);
                                }else{
                                    header('Location: adminForm.php');
                                }   
                                
                            ?>
                        </tr>
                        <?php
                                $pagesPerTime = 20;
                                $page = ""; 
                                $queryStr = $_SERVER["QUERY_STRING"];
                                            
                                $page = str_replace("page-", "", $queryStr);

                                $products = mysqli_num_rows($sql);
                                            
                                $page__count = floor($products / $pagesPerTime)+1; 
                                
                                function getInfo($sqlText){ 
                                    $pagesPerTime = 20;
                                    $page = ""; 
                                    $queryStr = $_SERVER["QUERY_STRING"];
                                                
                                    $page = str_replace("page-", "", $queryStr);
                
                                    $products = mysqli_num_rows($sqlText);
                                                
                                    $page__count = floor($products / $pagesPerTime); 
                
                                                
                                    $page__counter = 1;

                                    $i = 1;
                                    while($content = mysqli_fetch_assoc($sqlText)){
                                        
                                        if($i >= (int)$page*$pagesPerTime && $i <= ((int)$page+1)*$pagesPerTime){
                                            
                                            echo "<tr>";
                                            echo "<td class='td'>{$i}</td>";
                                            if (strlen($content['date']) > 1){
                                                echo "<td class='td'>{$content['date']}</td>";   
                                            }
                                            if (strlen($content['book__name']) > 1){
                                                echo "<td class='td'>{$content['book__name']}</td>";   
                                            }
                                            echo "<td class='tdUnActive'><a href='adminEdit.php?bookId={$content['id']}' class='btn editBtn'><img src='../images/edit.png' alt='Редактировать'></a><a href='?bookId={$content['id']}' class='btn delBtn'><img src='../images/del.png' alt='Удалить'></a></td>";
                                            echo "</tr>";  
                                            
                                        }
                                        $i++;
                                        $j++;
                                        $page__counter++;
                                        
                                    }
                                }
                                getInfo($sql);
                                    
                            ?>
                    </table>
                <div class="addBook">
                    <?php $count = mysqli_num_rows($sql) + 1 ?>
                    <a href="adminAdd.php?bookId=<?=$count?>" >Добавить книгу</a>
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
        <?php

        require "footer.php";



    }else{
        echo "Вы ввели неправильный логин или пароль";
    }
}
?>