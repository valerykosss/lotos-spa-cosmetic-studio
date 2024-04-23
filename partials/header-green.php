<?php
    if (session_id() == ''){
        session_start();
    }
    require_once "../handlers/get_header_info_script.php";
?>
<header class="header">
        <div class="header__body _container">
            <div class="header__burger">
                <span></span>
            </div>
            <nav class="header__menu">
                <ul class="header__list">
                    <li>
                        <a href="#" class="header__link">Услуги<i class="fa fa-angle-down"></i></a>
                        <ul class="header__menu__sub-list">
                            <?php
                                foreach($service_types as $service_type){
                                    echo("
                                    <li>
                                        <a href='cosmetic-procedures.php?stype_id=".$service_type[0]."' class='header__menu__sub-link'>".$service_type[1]."</a>
                                    </li>
                                    ");
                                }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <a href="specialists.php" class="header__link">Специалисты</a>
                    </li>
                    <li class="li-header-logo">
                        <a href="index.php" class="header__logo">
                            <img src="../images/logo-lotus-header-white.svg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="about-us.php" class="header__link">О нас</a>
                    </li>
                    <li>
                        <a href="#" class="header__link">Контакты</a>
                    </li>
                    <li>
                        <?php
                        if (empty($_SESSION['UserID'])) {
                            echo "<a class=\"header__link\" id=\"open__log-in__button\">
                            <img src=\"../images/icons/profile-icon.svg\" alt=\"\"> ВОЙТИ
                            </a>";
                        } else {
                            echo "<a class=\"header__link\" id=\"logout__button\" href=\"../handlers/logout.php\">
                            <img src=\"../images/icons/profile-icon.svg\" alt=\"\"> ".$_SESSION["Name"]."
                            </a>";
                        }

                    ?>
                        <!-- <a href="#" class="header__link">
                            <img src="../images/icons/profile-icon.svg" alt="">
                        </a> -->
                    </li>
                </ul>
            </nav>
        </div>
    </header>

<?php require 'sign-in.php' ?>
<?php require 'sign-up.php' ?>