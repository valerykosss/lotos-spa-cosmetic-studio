<?php
if (session_id() == '') {
    session_start();
}
require_once "../handlers/get_header_info_script.php";
?>
<header class="header-white">
    <div class="header__body _container">
        <div class="burger-logo-profile__body">
            <ul class="header__list-mobile">
                <div class="header__burger">
                    <span></span>
                </div>
                <li class="li-header-logo">
                    <a href="index.php" class="header__logo">
                        <img src="../images/new-black-logo.png" alt="">
                    </a>
                </li>
                <li>
                    <a href="#" class="header__link-white">
                        <img src="../images/icons/profile-icon-smaller-for-white.svg" alt="">
                        <?php
                        if (!empty($_SESSION['UserID'])) {
                            echo $_SESSION["Name"];
                        }
                        echo "</a>";
                        echo "<ul class='header__menu__sub-list-white'>";
                        // if(isset($_SESSION['UserID'])){
                        if (empty($_SESSION['UserID'])) {
                            echo "<a class='header__menu__sub-link-white' id='sign-in__link'><li>ВОЙТИ</li></a>";
                        } else {
                            echo "<a class=\"header__menu__sub-link-white\" href='account.php'><li>Мой профиль</li></a>";

                            echo "<a class=\"header__menu__sub-link-white\" id=\"logout__button\" href=\"../handlers/logout.php\"><li>ВЫЙТИ</li></a>";
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>
        <nav class="header__menu">
            <ul class="header__list-white">
                <li>
                    <a href="#" class="header__link-white">Услуги<i class="fa fa-angle-down"></i></a>
                    <ul class="header__menu__sub-list-white">
                        <?php
                        foreach ($service_types as $service_type) {
                            echo ("
                                    <li>
                                        <a href='service-type-page.php?stype_id=" . $service_type[0] . "' class='header__menu__sub-link-white'>" . $service_type[1] . "</a>
                                    </li>
                                    ");
                        }
                        ?>
                    </ul>
                </li>
                <li>
                    <a href="specialists.php" class="header__link-white">Специалисты</a>
                </li>
                <li>
                    <a href="test.php" class="header__link-white">Подобрать услугу</a>
                </li>

                <li class="li-header-logo">
                    <a href="index.php" class="header__logo">
                        <img src="../images/new-black-logo.png" alt="">
                    </a>
                </li>
                <li>
                    <a href="price-list.php" class="header__link-white">Прайс</a>
                </li>
                <li>
                    <a href="about-us.php" class="header__link-white">О нас</a>
                </li>
                <li>
                    <a href="contact-page.php" class="header__link-white">Контакты</a>
                </li>
                <li>
                    <a href="#" class="header__link-white">
                        <img src="../images/icons/profile-icon-smaller-for-white.svg" alt="">
                        <?php
                        if (!empty($_SESSION['UserID'])) {
                            echo $_SESSION["Name"];
                        }
                        echo "</a>";
                        echo "<ul class='header__menu__sub-list-white'>";
                        // if(isset($_SESSION['UserID'])){
                        if (empty($_SESSION['UserID'])) {
                            echo "<a class='header__menu__sub-link-white' id='sign-in__link'><li>ВОЙТИ</li></a>";
                        } else {
                            echo "<a class=\"header__menu__sub-link-white\" href='account.php'><li>Мой профиль</li></a>";

                            echo "<a class=\"header__menu__sub-link-white\" id=\"logout__button\" href=\"../handlers/adminLogout.php\"><li>ВЫЙТИ</li></a>";
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>

<?php require 'sign-in-new.php' ?>
<?php require 'sign-up-new.php' ?>