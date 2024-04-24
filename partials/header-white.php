<?php
    if (session_id() == ''){
        session_start();
    }
    require_once "../handlers/get_header_info_script.php";
?>
<header class="header-white">
        <div class="header__body _container">
            <div class="header__burger">
                <span></span>
            </div>
            <nav class="header__menu">
                <ul class="header__list-white">
                    <li>
                        <a href="#" class="header__link-white">Услуги<i class="fa fa-angle-down"></i></a>
                        <ul class="header__menu__sub-list-white">
                            <?php
                                foreach($service_types as $service_type){
                                    echo("
                                    <li>
                                        <a href='cosmetic-procedures.php?stype_id=".$service_type[0]."' class='header__menu__sub-link-white'>".$service_type[1]."</a>
                                    </li>
                                    ");
                                }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <a href="specialists.php" class="header__link-white">Специалисты</a>
                    </li>
                    <?php
                        if(isset($_SESSION['UserID'])){
                        echo "<li>
                            <a href='account.php' class='header__link-white'>Профиль</a>
                        </li>";
                    } ?>

                    <li class="li-header-logo">
                        <a href="index.php" class="header__logo">
                            <img src="../images/logo-lotus-footer-green.svg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="about-us.php" class="header__link-white">О нас</a>
                    </li>
                    <li>
                        <a href="contact-page.php" class="header__link-white">Контакты</a>
                    </li>
                    <li>
                        <?php
                        if (empty($_SESSION['UserID'])) {
                            echo "<a class=\"header__link-white\" id=\"open__log-in__button\">
                            <img src=\"../images/icons/profile-icon-white.svg\" alt=\"\"> ВОЙТИ
                            </a>";
                        } else {
                            echo "<a class=\"header__link-white\" id=\"logout__button\" href=\"../handlers/logout.php\">
                            <img src=\"../images/icons/profile-icon-white.svg\" alt=\"\">".$_SESSION["Name"]."
                            </a>";
                        }

                        // require_once '../handlers/isAdmin.php';
                    ?>

                    </li>
                </ul>
            </nav>
        </div>
    </header>

<?php require 'sign-in.php' ?>
<?php require 'sign-up.php' ?>