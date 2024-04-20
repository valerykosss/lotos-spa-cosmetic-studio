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
                            <li>
                                <a href="cosmetic-procedures.php" class="header__menu__sub-link-white">Косметические услуги</a>
                            </li>
                            <li>
                                <a href="#" class="header__menu__sub-link-white">Спа-программы</a>
                            </li>
                            <li>
                                <a href="#" class="header__menu__sub-link-white">Спа-программы <br> для двоих</a>
                            </li>
                            <li>
                                <a href="#" class="header__menu__sub-link-white">Массаж лица</a>
                            </li>
                            <li>
                                <a href="#" class="header__menu__sub-link-white">Массаж тела</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="specialists.php" class="header__link-white">Специалисты</a>
                    </li>
                    <li class="li-header-logo">
                        <a href="index.php" class="header__logo">
                            <img src="../images/logo-lotus-footer-green.svg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="about-us.php" class="header__link-white">О нас</a>
                    </li>
                    <li>
                        <a href="#" class="header__link-white">Контакты</a>
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