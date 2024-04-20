<header class="header-white">
        <div class="header__body _container">
            <div class="header__burger">
                <span></span>
            </div>
            <nav class="header__menu">
                <ul class="header__list-white__admin-master">
                    <li>
                        <?php
                        if (empty($_SESSION['Name'])) {
                            echo "<a class=\"header__link-white\" id='open__log-in__button'>
                            <img src=\"../images/icons/profile-icon-white.svg\" alt=\"\"> ВОЙТИ
                            </a>";
                        } else {
                            echo "<a class=\"header__link-white\" id=\"logout__button\" href=\"../handlers/logout.php\">
                            <img src=\"../images/icons/profile-icon-white.svg\" alt=\"\"> ВЫЙТИ
                            </a>";
                        }
                    ?>

                    </li>
                </ul>
            </nav>
        </div>
    </header>

<?php require 'sign-in.php' ?>
<?php require 'sign-up.php' ?>