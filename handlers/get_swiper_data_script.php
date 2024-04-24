<?php
    require_once "../database/db.php";

    $first_swiper=mysqli_query($link, "SELECT * FROM `service_type`");
    $first_swiper=mysqli_fetch_all($first_swiper);
?>