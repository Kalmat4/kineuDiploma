
<?php
$stringPages;
if (strpos($_SERVER['REQUEST_URI'], 'pages')){
    $stringPages = 'authAdmin.php';
}else{
    $stringPages = 'pages/authAdmin.php';
}

?>


<div class="footer">
    <?=date('Y')?> © Костанайский инженерно-экономический университет
    <a href="<?=$stringPages?>" class="admin">Панель администратора</a>
    

</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script type="text/javascript" src="<?=$pathToScript . "script.js"?>"> </script>

</div>
</body>
</html>