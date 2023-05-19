<?php

require "pagesHead.php";

?>

<div class="template">

<?php
require "header.php";

$pathOutside = "../";
        
?>

<div class="content">
    <div class="container">
        <span class="title">
            Рекомендуем к прочтению
        </span>
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
    </div>
</div>





<?php

require "footer.php";

?>