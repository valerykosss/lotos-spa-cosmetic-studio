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
                            <li>
                                <a href="cosmetic-procedures.php" class="header__menu__sub-link">Косметические услуги</a>
                            </li>
                            <li>
                                <a href="#" class="header__menu__sub-link">Спа-программы</a>
                            </li>
                            <li>
                                <a href="#" class="header__menu__sub-link">Спа-программы <br> для двоих</a>
                            </li>
                            <li>
                                <a href="#" class="header__menu__sub-link">Массаж лица</a>
                            </li>
                            <li>
                                <a href="#" class="header__menu__sub-link">Массаж тела</a>
                            </li>
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
                        if (empty($_SESSION['Name'])) {
                            echo "<a class=\"header__link\" id=\"open__log-in__button\">
                            <img src=\"../images/icons/profile-icon.svg\" alt=\"\"> ВОЙТИ
                            </a>";
                        } else {
                            echo "<a class=\"header__link\" id=\"logout__button\" href=\"../handlers/logout.php\">
                            <img src=\"../images/icons/profile-icon.svg\" alt=\"\"> ВЫЙТИ
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