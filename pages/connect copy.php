<?php
$link = mysqli_connect('localhost', 'root', '', 'kineu__test');

if( !$link ){	
    echo 'Ошибка: <br/>';
    echo mysqli_connect_error();
    exit();
}

$_SESSION['db'] = $link;

?>