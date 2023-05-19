<?php


require "pagesHead.php";

$pathOutside = "../";
$pathToImg = "images/";
        
?>

<div class="content">
    
    <div class="container">
        <span class="title">
        Добро пожаловать
        </span>
        <p class="simpleText">
        Электронная библиотека ориентирована на обеспечение информационных потребностей пользователей в процессе обучения и научной деятельности. В ней содержатся учебная и учебно-методическая литература, научные статьи из периодических изданий, документы по истории университета и другие материалы. Многие из них опубликованы в КИнЭУ или созданы авторами-преподавателями.
        </p>
        <div class="sliderBlock">
            <div class="title2">
                Внешние электронные ресурсы
            </div>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php
                        require 'connect.php';
                        error_reporting(0);
                        $link = $_SESSION['db'];
                        $sql = mysqli_query($link, "SELECT * FROM `resources`");

                        while($content = mysqli_fetch_assoc($sql)){
                            echo "<div class='swiper-slide'>";
                            echo "<a href={$content['link']} target='_blank'>";
                            echo "<img src={$pathToImg}{$content['img']} alt=\"IMG\">";
                            echo '</a></div>';
                        }
                            
                    ?>  
                 
                </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
            </div>
                 
                            
        </div>
        <div class="redirect">
            <div class="title">
                Реестр новых поступлений
            </div>

            <form action="pages/reestr.php?page-0">
                <button type="submit" class="btnSend">Перейти</button>
            </form>
        </div>
    </div>

</div>

