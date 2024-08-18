<?php
    require_once "../database/db.php";
    require_once "mail/mail_client_connect.php";

    $get_records=mysqli_query($link, "SELECT `service`.`service_name`, `master`.`master_name`, `user`.`name`, `user`.`email`, `procedure_record`.`record_date`, `procedure_record`.`record_time`
    FROM `procedure_record`
    INNER JOIN `user` ON `procedure_record`.`id_user`=`user`.`id_user`
    INNER JOIN `master_service` ON `procedure_record`.`id_master_service`=`master_service`.`id_master_service`
    INNER JOIN `master` ON `master_service`.`id_master`=`master`.`id_master`
    INNER JOIN `service` ON `master_service`.`id_service`=`service`.`id_service`
    ");
    $records=mysqli_fetch_all($get_records);

    $today=date("Y-m-d");
    $delayDate=date("Y-m-d", strtotime("+ 2 days"));

    foreach($records as $record){
        //если запись уже прошла пропускаем ее
        if(strtotime($record[4])<=strtotime($today)){
            continue;
        }
        //если запись завтра
        if($record[4]==$delayDate){
            //если есть почта
            if($record[3]!=NULL){
                //убираем секунды
                $formatted_time=substr($record[5], 0, -3);
                $body="
                    <p>Здравствуйте, ".$record[2]."!</p>
                    <p>Напоминаем, что у Вас завтра, в ".$formatted_time.", запись на процедуру \"".$record[0]."\" к мастеру ".$record[1].".</p>
                    <p>Будем Вас ждать!</p>
                    <p>Ваш центр гармонии души и тела Lotos!</p>
                ";

                send_mail($settings['mail_settings'], [$record[3]], 'Вы записаны на процедуру!', $body);
            }
        }
    }

?>