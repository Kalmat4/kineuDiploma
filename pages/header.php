<?php
session_status();
session_start();
    if ($_SERVER['SCRIPT_NAME'] == "/index.php"){

        $pathToImg = "images/";
        $_SESSION['pathToImg'] = $pathToImg;
        $pathToScript = "js/";

    }else{

        $pathToImg = "../images/";
        $_SESSION['pathToImg'] = $pathToImg;
        $pathToScript = "../js/";
        

    }

    $pathToHome = "http://" . $_SERVER['HTTP_HOST'] . "/index.php";

    $arrowIcon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-down-right-circle\" viewBox=\"0 0 16 16\"><path fill-rule=\"evenodd\" d=\"M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.854 5.146a.5.5 0 1 0-.708.708L9.243 9.95H6.475a.5.5 0 1 0 0 1h3.975a.5.5 0 0 0 .5-.5V6.475a.5.5 0 1 0-1 0v2.768L5.854 5.146z\"/></svg>";

    $pathToPages = "http://" . $_SERVER['HTTP_HOST'] . "/pages";

    $pathOutside = "../";
    

?>

<div class="remData">dddd</div>
<div class="header">
    <div class="wrapper">
        <div class="language">
            <div class="dropdown_lang" onclick="showLangMenu()">
                <span> Выберите язык </span> 
                <img src="../images/dropdown.png" alt="dropdownImg" class="dropDownImg">
            </div>
            <div class="language__toggle">
                <img src="<?=$pathToImg?>lang/lang__ru.png" alt="ru" data-google-lang="ru" class="language__img">
                <img src="<?=$pathToImg?>lang/lang__en.png" alt="en" data-google-lang="en" class="language__img">
                <img src="<?=$pathToImg?>lang/lang__kz.png" alt="kk" data-google-lang="kk" class="language__img">
            </div> 
        </div> 
        <div class="header__logo">
            <a href="<?=$pathToHome?>">
                <img src="<?=$pathToImg . "logo.png"?>" alt="Logo" class="header__logo__img">
            </a>
        </div>
        <span class="header__title">
            <a href="<?=$pathToHome?>">БИБЛИОТЕКА КОСТАНАЙСКОГО ИНЖЕНЕРНО-ЭКОНОМИЧЕСКОГО УНИВЕРСИТЕТА ИМ. М. ДУЛАТОВА</a> 
        </span>
        <div class="social">
            <a href="https://t.me/library_kineu">
                <img src="../images/tgLogo.png" alt="tg" class="tg logo">
            </a>
            <a href="https://www.instagram.com/library.kineu/">
                <img src="../images/instLogo.png" alt="inst" class="inst logo">
            </a>
            <a href="https://www.facebook.com/biblioteka.kineu/">
                <img src="../images/fcLogo.png" alt="fc" class="fc logo">
            </a>
        </div>  
          

    </div>

    <div class="navigation">
        <div class="nav__button" onclick="showMenu()">
            <div class="nav__button__divider"></div>
            <div class="nav__button__divider"></div>
            <div class="nav__button__divider"></div>
        </div>
        <ul class="nav__bar">
            <div class="nav__item__wrap">
                <li class="nav__item nav__item__0" >
                    <a href="../index.php">Главная</a> 
                </li>
            </div>
            <div class="nav__item__wrap">
                <li class="nav__item nav__item__1" >
                    O Библиотеке
                </li>
                <div id="dropdown__item__1" class="dropdown-menu">
                    <ul class="dropdown__list">
                        <li class="dropdown__item">
                            <a href="<?php echo $pathToPages . "/mission.php"?>">Миссия. Задачи. Приоритетные направления</a>
                        </li>
                        <li class="dropdown__item">
                            <a href="<?php echo $pathToPages . "/contacts.php"?>">Контакты. Режим работы</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="nav__item__wrap">
                <li class="nav__item nav__item__2">
                    Пользователю 
                </li> 
                    <div id="dropdown__item__2" class="dropdown-menu">
                        <ul class="dropdown__list">
                            <li class="dropdown__item">
                                <a href="<?php echo $pathToPages . "/useRules.php"?>">Правило пользования Библиотеки КИнЭУ</a>
                            </li>
                            <!--<li class="dropdown__item">
                                <a href="#">Услуги Библиотеки КИнЭУ </a>
                            </li>-->
                            <li class="dropdown__item">
                                <a href="<?php echo $pathToPages . "/moreRules.php"?>">Правило составления библиографических списков</a>
                            </li>
                        </ul>
                    </div> 
                
            </div>   

            <div class="nav__item__wrap">
                <li class="nav__item nav__item__3">
                    Электронные ресурсы
                </li>
                    <div id="dropdown__item__3" class="dropdown-menu">
                        <ul class="dropdown__list">
                            <li class="dropdown__item">
                                <a href="<?php echo $pathToPages . "/e-resources.php"?>">Информационные ресурсы</a>
                            </li>
                            <li class="dropdown__item">
                                <a href="<?php echo $pathToPages . "/reestr.php?page-0"?>">Реестр новых поступлений</a>
                            </li>
                            <li class="dropdown__item">
                                <a href="<?php echo $pathToPages . "/moreResources.php"?>">Ресурсы, направленные на расширение сферы применения казахского языка по рекомендации Министерства образования и науки Республики Казахстан</a>
                            </li>
                        </ul>
                    </div>
                
            </div>
            
            <div class="nav__item__wrap">
                <li class="nav__item nav__item__4">
                    Фонды библиотеки 
                </li>
                    <div id="dropdown__item__4" class="dropdown-menu">
                        <ul class="dropdown__list">
                            <li class="dropdown__item">
                                <a href="<?php echo $pathToPages . "/bibleList.php"?>">Список выписываемых периодических изданий </a>
                            </li>
                            <li class="dropdown__item">
                                <a href="<?php echo $pathToPages . "/newPost.php"?>">Бюллетень новых поступлений 2022-2023</a>
                            </li>
                            <!-- <li class="dropdown__item">
                                <a href="<?php //echo $pathToPages . "/biblePointer.php"?>">Информационно-библиографические указатели </a>
                            </li> -->
                            <li class="dropdown__item">
                                <a href="<?php echo $pathToPages . "/booksExhibition.php"?>">Книжные тематические выставки</a>
                            </li>
                            <li class="dropdown__item">
                                <a href="<?php echo $pathToPages . "/recomends.php"?>">Рекомендуем к прочтению</a>
                            </li>
                        </ul>
                    </div>
            </div>
            
        </ul>
    </div>

                
</div>