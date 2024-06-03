<?php
require_once "../handlers/isAdmin.php";

require '../database/db.php';
if (session_id() == '')
    session_start();

    function russianMonth($monthNumber)
    {
        $months = array(
            'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря'
        );
        return $months[$monthNumber - 1];
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель мастера</title>
    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/popupSignInUp.css">
    <link rel="stylesheet" href="../css/header-white-admin-master.css">
    <link rel="stylesheet" href="../css/admin-panel.css">
</head>

<body>
<div class="preloader">
        <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
        </div>
    </div>
    <?php
    require 'header-master.php';
    ?>
    <main class="page">
        <section class="page__specialists">
            <div class="specialists__body _container">
                <div class="admin-panel-title ">Панель Мастера</div>
                <div class="tab-admin-panel">


                    <div class="tab-content-admin-panel" style="display:block !important">

                        <p class="sub-header">Все записи: </p>
                        <table class="table__to-update-delete">
                            <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Услуга</th>
                                    <th>Дата записи</th>
                                    <th>Время записи</th>
                                    <th>Стоимость</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>
                            <?php
                            $query = 'SELECT procedure_record.id_record, user.name, service.service_name, procedure_record.record_date, procedure_record.record_time, service.price, procedure_record_status.record_status_name FROM procedure_record inner join master_service on procedure_record.id_master_service=master_service.id_master_service inner join service on master_service.id_service=service.id_service inner join procedure_record_status on procedure_record.id_record_status=procedure_record_status.id_record_status inner join user on procedure_record.id_user=user.id_user';

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);

                                    $date = strtotime($row[3]); // Преобразование строки в дату
                                    $day = date('j', $date);
                                    $month = date('n', $date);
                                    $year = date('Y', $date);
                                    $date = $day . ' ' . russianMonth($month) . ' '. $year;


                                    $trBlock .= "
                                                <tr id='$row[0]'>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[1] . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[2] . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $date . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[4] . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[5] . "</textarea></td>
                                                    <td>
                                                        <select class='status-select' data-record-id='" . $row[0] . "'>
                                            
                                                            <option value='1' ";
                                                            if ($row[6] == "Ожидается") {
                                                                $trBlock .= "selected";
                                                            }
                                                            $trBlock .= ">Ожидается</option>
                                                            <option value='2' ";
                                                            if ($row[6] == "Проведена") {
                                                                $trBlock .= "selected";
                                                            }
                                                            $trBlock .= ">
                                                                Проведена</option>

                                                        </select>
                                                    </td>
                                                </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>

                        </table>

                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="../libraries/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="../js/admin-panel-ajax/change-master-data.js"></script>


<script src="../js/openPopupSignInUp.js"></script>
<script src="../js/preloader.js"></script>

</html>