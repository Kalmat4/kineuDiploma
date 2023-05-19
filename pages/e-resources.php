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
        <div class="innerResources" id="inner">
            <span class="title">
            Внутренние информационные ресурсы
            </span>
            <div class="card">
                Реестр новых поступлений – учебная, научная и художественная литература литература поступившая в библиотеку университета за определённый период
                <a href="/pages/reestr.php?page-0"><img src="<?=$pathToImg . "reestr.png"?>" alt="" class="header__logo__img"></a>
            </div>
        </div>

        <div class="outerResources" id="outer">
            <span class="title">
                Внешние информационные ресурсы
            </span>
            <div class="outer__inner__block">
                
                <?php
                        require 'connect.php';
                        error_reporting(0);
                        $link = $_SESSION['db'];
                        $sql = mysqli_query($link, "SELECT * FROM `resources`");

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
</div>


<?php

require "footer.php";

?>