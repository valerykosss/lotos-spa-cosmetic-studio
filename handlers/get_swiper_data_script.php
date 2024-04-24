<?php
    require_once "../database/db.php";

    $first_swiper=mysqli_query($link, "SELECT * FROM `service_type`");
    $first_swiper=mysqli_fetch_all($first_swiper);

    $all_masters=mysqli_query($link, "SELECT * FROM `master`");
    $all_masters=mysqli_fetch_all($all_masters);
//check type of service
    $all_masters_cosmetic=mysqli_query($link, "SELECT distinct `master`.`id_master`, `master`.`master_name`, `master`.`master_surname`, `master`.`master_photo`, `master`.`position` FROM `master_service`
                                                inner join `service` on `master_service`.`id_service`=`service`.`id_service`
                                                inner join `service_type` on `service`.`id_service_type`=`service_type`.`id_service_type`
                                                inner join `master` on `master_service`.`id_master`=`master`.`id_master`
                                                WHERE `service_type`.`id_service_type`=1");
    $all_masters_cosmetic=mysqli_fetch_all($all_masters_cosmetic);

    $all_masters_spa=mysqli_query($link, "SELECT distinct `master`.`id_master`, `master`.`master_name`, `master`.`master_surname`, `master`.`master_photo`, `master`.`position` FROM `master_service`
    inner join `service` on `master_service`.`id_service`=`service`.`id_service`
    inner join `service_type` on `service`.`id_service_type`=`service_type`.`id_service_type`
    inner join `master` on `master_service`.`id_master`=`master`.`id_master`
    WHERE `service_type`.`id_service_type`=2");
    $all_masters_spa=mysqli_fetch_all($all_masters_spa);

    $all_masters_massage=mysqli_query($link, "SELECT distinct `master`.`id_master`, `master`.`master_name`, `master`.`master_surname`, `master`.`master_photo`, `master`.`position` FROM `master_service`
    inner join `service` on `master_service`.`id_service`=`service`.`id_service`
    inner join `service_type` on `service`.`id_service_type`=`service_type`.`id_service_type`
    inner join `master` on `master_service`.`id_master`=`master`.`id_master`
    WHERE `service_type`.`id_service_type`=4 or `service_type`.`id_service_type`=5");
    $all_masters_massage=mysqli_fetch_all($all_masters_massage);
?>
