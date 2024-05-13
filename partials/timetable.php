<?php
require_once "../handlers/isAdmin.php";

require '../database/db.php';
if (session_id() == '')
    session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
    <!-- <link rel="stylesheet" href="../css/admin-panel.css"> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/ru.js"></script>

    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/sign-in-up.css">
    <link rel="stylesheet" href="../css/header-white-admin-master.css">
    <link rel="stylesheet" href="../css/timetable.css">

</head>

<body>
<div class="preloader">
        <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
        </div>
    </div>
    <?php
    require 'header-white-admin-master.php';
    ?>

    <main class="page">
        <section class="page__specialists">
            <div class="timetable__bodt _container">

                <p class="sub-header">Назначить расписание специалистам: </p>
                <div class="container">
                    <div id="calendar"></div>
                </div>

                <!-- Start Event Modal -->
                <div id="leaveModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="leave_title" class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">Закрыть</span></button>
                            </div>
                            <div class="modal-body">
                                <form>

                                    <div class="form-group">
                                        <label for="master_select" class="col-form-label">Мастер: </label>
                                        <select class="form-control" id="master_select">
                                        </select>
                                    </div>
                                    <input type="hidden" id="eventIdInput">

                                    <div class="form-group">
                                        <label for="start" class="col-form-label">Начало времени работы: </label>
                                        <input type="text" class="form-control" id="leave_start">
                                    </div>

                                    <div class="form-group">
                                        <label for="start" class="col-form-label">Конец времени работы: </label>
                                        <input type="text" class="form-control" id="leave_end">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" id="leaveAddBtn">Добавить</button>
                                <!-- <button type="button" class="btn btn-warning" data-dismiss="modal" id="leaveUpdateBtn">Update</button> -->
                                <button type="button" class="btn btn-danger" data-dismiss="modal" id="leaveDeleteBtn">Удалить</button>
                                <button type="button" class="btn btn-info" data-dismiss="modal">Отмена</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Event Modal -->

                <!-- Start Success Message Modal -->
                <div id="msgSuccessModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Успешно!</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">Закрыть</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Расписание было успешно добавлено!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Success Message Modal -->

                <!-- Start Updated Message Modal -->
                <div id="msgUpdatedModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Расписание обновлено!</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Расписание было успешно обновлено!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Updated Message Modal -->

                <!-- Start Deleted Message Modal -->
                <div id="msgDeletedModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Расписание удалено!</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">Закрыть</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Расписание было успешно удалено!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End Deleted Message Modal -->
    <script src="../js/admin-panel-ajax/timetable.js"></script>
    <script src="../js/signInUp.js"></script>
    <script src="../js/preloader.js"></script>
</body>

</html>