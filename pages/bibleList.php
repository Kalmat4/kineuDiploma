<?php

require "pagesHead.php";

?>

<div class="template">

<?php
require "header.php";

?>

<div class="content">
    <div class="container">

        
        <span class="title">
            Список выписываемых периодических изданий на 2023
        </span>
        <div class="table-wrap">
            <table>
                <tr>
                    <th class="th">№ п/п</th>
                    <th class="th">Индекс издания</th>
                    <th class="th">Наименование издания</th>
                    <th class="th">На ск-ко месяцев</th>
                    <th class="th">К-во комплектов</th>
                </tr>
                <?php
                            require 'connect.php';
                            error_reporting(0);
                            $link = $_SESSION['db'];
                            $sql = mysqli_query($link, "SELECT * FROM `pubList`");
                            $counter = 1;
                            while($content = mysqli_fetch_assoc($sql)){
                                echo "<tr> <td class='td'>{$counter}</td>   <td class='td'>{$content['pubIndex']}</td>   <td class='td'>{$content['pubName']}</td>   <td class='td'>{$content['months']}</td>   <td class='td'>{$content['sets']}</td>       </tr>";
                                $counter++;
                            }
                            
                    ?>
            </table>
        </div>
    </div>
</div>


<?php

require "footer.php";

?>