<?php
    if (session_id() == ''){
        session_start();
    }
    require_once "../handlers/get_header_info_script.php";
?>
<footer class="footer-green">
        <div class="footer__body _container">
            <nav class="footer__menu">
                <ul class="footer__list-green">
                    <li>
                        <a href="#" class="footer__link-green">Услуги<i class="fa fa-angle-down"></i></a>
                        <ul class="footer__menu__sub-list-green">
                            <!-- <li>
                                <a href="cosmetic-procedures.php" class="footer__menu__sub-link-green">Косметические услуги</a>
                            </li> -->
                            <?php
                                foreach($service_types as $service_type){
                                    echo("
                                    <li>
                                        <a href='service-type-page.php?stype_id=".$service_type[0]."' class='footer__menu__sub-link-green'>".$service_type[1]."</a>
                                    </li>
                                    ");
                                }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <a href="specialists.php" class="footer__link-green">Специалисты</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link-green">Подобрать услугу</a>
                    </li>
                    <li>
                        <a href="price-list.php" class="footer__link-green">Прайс</a>
                    </li>
                    <li>
                        <a href="about-us.php" class="footer__link-green">О нас</a>
                    </li>
                    <li>
                        <a href="contact-page.php" class="footer__link-green">Контакты</a>
                    </li>
                    <li class="li-footer-logo">
                        <a href="index.php" class="footer__logo">
                            <img src="../images/logo-lotus-header-white.svg" alt="">
                        </a>
                        <ul class="footer__contacts__sub-list-green">
                             <li>
                                <p class="footer__contacts__sub-link-green">
                                    ПН-ВС: с 10:00 до 20:00
                                </p>
                            </li>
                            <li>
                                <a href="tel:" class="footer__contacts__sub-link-green">+375 (29) 777-73-30</a>
                            </li>
                            <li>
                                <a href="contact-page.php" class="footer__contacts__sub-link-green">Карла Маркса, 33</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </footer>