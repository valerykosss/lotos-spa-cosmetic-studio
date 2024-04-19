<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    require '../database/db.php';

    $query1='';
    $query2='';
    $query3='';
    $query4='';
    $query='';

    if (isset($_POST['sort1'])) {
        $sort1 = $_POST['sort1'];
    
        if ($sort1 === 'popularity') {
            // $masters_sorted = "SELECT m.id_master, m.master_name, m.master_surname, m.position
            // FROM master_service ms
            // JOIN (
            //     SELECT id_master, COUNT(*) as count_services
            //     FROM master_service
            //     GROUP BY id_master
            // ) sub ON ms.id_master = sub.id_master
            // JOIN master m ON ms.id_master = m.id_master
            // ORDER BY sub.count_services DESC, ms.id_master";

            $query1 = 'SELECT m.id_master, m.master_name, m.master_surname, m.master_photo, m.position
            FROM (
                SELECT ms.id_master, m.master_name, m.master_surname, m.position,
                       MIN(ms.id_master_service) as min_id_master_service
                FROM master_service ms
                JOIN master m ON ms.id_master = m.id_master ';

             $query3 = ' GROUP BY ms.id_master, m.master_name, m.master_surname, m.position
             ) as RankedMasterService
             JOIN master_service ms ON RankedMasterService.min_id_master_service = ms.id_master_service
             JOIN master m ON RankedMasterService.id_master = m.id_master
             ORDER BY RankedMasterService.id_master;';

        } else if ($sort1 === 'rating') {
            // $masters_sorted = mysqli_query($link, "SELECT mr.id_master, m.master_name, m.master_surname, m.position, AVG(mr.master_rating) as avg_rating
            // FROM master_rating mr
            // JOIN master m ON mr.id_master = m.id_master
            // GROUP BY mr.id_master, m.master_name, m.master_surname, m.position
            // ORDER BY avg_rating DESC");

            $query1 = 'SELECT mr.id_master, m.master_name, m.master_surname, m.master_photo, m.position, AVG(mr.master_rating) as avg_rating
            FROM master_rating mr
            JOIN master m ON mr.id_master = m.id_master ';

            $query3 = ' GROUP BY mr.id_master, m.master_name, m.master_surname, m.position
            ORDER BY avg_rating DESC;';
            
        }
        else if ($sort1 === 'work_experience') {
            // $masters_sorted = mysqli_query($link, "SELECT id_master, master_name, master_surname, position, work_experience
            // FROM master
            // ORDER BY work_experience DESC");

            $query1 = 'SELECT m.id_master, m.master_name, m.master_surname, m.master_photo, m.position, m.work_experience
            FROM master m ';

            $query3 = ' ORDER BY m.work_experience DESC;';

        }
    } 


    if (isset($_POST['search'])) {

        $word = mysqli_real_escape_string($link, $_POST['search']);

        $query2 = " where (m.master_name  LIKE '" . $word . "%' or m.master_surname LIKE '" . $word . "%')";
    } else {
        $query2 = "";
    }

    if (isset($_POST['sort2'])) {
        $sort2 = $_POST['sort2'];
    
        if ($sort2 === 'all') {

            $query4 = '';

        } else if ($sort2 === 'massagist') {

            $query4 = ' and (LOWER(m.position) LIKE LOWER("%массажист%"))  ';
        }
        else if ($sort2 === 'cosmetologist') {
            $query4 = ' and (LOWER(m.position) LIKE LOWER("%косметолог%")) ';
        }
        else{
            $query4 = '';
        }
    } 

    $query  = $query1.$query2.$query4.$query3;


    require '../partials/specialistCards.php';
?>