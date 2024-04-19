<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

        $master_name = $_POST['master_name'];
        $master_surname = $_POST['master_surname'];
        $master_photo = $_POST['master_photo'];
        $education = $_POST['education'];
        $work_experience = $_POST['work_experience'];
        $position = $_POST['position'];

    
        // SQL-запрос для добавления данных в таблицу master
        $queryToInsert = "INSERT INTO master (master_name, master_surname, master_photo, education, work_experience, position) 
                  VALUES ('$master_name', '$master_surname', '$master_photo', '$education', '$work_experience', '$position')";

        echo $queryToInsert;
   
    require '../../partials/table-master-admin-panel.php';
    
?>