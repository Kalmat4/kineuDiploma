<?php

session_status();
require "pagesHead.php";

?>

<div class="template">

<?php
require "header.php";

$pathToImg = $_SESSION['pathToImg'];

?>

<div class="content">
    <div class="container">


            
        

        <div class="moreResourcesBlock">
            <span class="title">
                Ресурсы, направленные на расширение сферы применения казахского языка по рекомендации Министерства образования и науки Республики Казахстан
            </span>
            <?php
                        require 'connect.php';
                        error_reporting(0);
                        $link = $_SESSION['db'];
                        $sql = mysqli_query($link, "SELECT * FROM `moreResource`");

                        while($content = mysqli_fetch_assoc($sql)){
                            echo "<div class='card'>";
                            echo "<a href={$content['link']} target='_blank'>";
                            echo "<img src={$pathToImg}{$content['img']} alt=\"IMG\" class=\"header__logo__img\">";
                            echo '</a></div>';
                        }
                        
                ?>
        </div>



    </div>
</div>

<?php

require "footer.php";

?>