<?php
require_once "../handlers/isAdmin.php";

require '../database/db.php';
require_once "../handlers/isAdmin.php";



if (session_id() == '')
    session_start();
if ($isAdmin==true || $isMaster==true || !isset($_SESSION['UserID'])){
        header("Location: index.php");
    }
$user_id = $_SESSION['UserID'];

$user_discount = mysqli_query($link, "SELECT wheel_discount.discount_name FROM `user`
                            inner join wheel_discount on user.id_wheel_discount=wheel_discount.id_wheel_discount
                            WHERE `id_user`=$user_id");
$user_discount = mysqli_fetch_assoc($user_discount);

$user_phone = mysqli_query($link, "SELECT telephone, name FROM user WHERE id_user=$user_id");
$user_phone = mysqli_fetch_assoc($user_phone);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аккаунт пользователя</title>
    <link rel="stylesheet" href="../css/generalStyles.css">
    <!-- <link rel="stylesheet" href="../css/specialists.css"> -->
    <link rel="stylesheet" href="../css/sign-in-up.css">
    <link rel="stylesheet" href="../css/admin-panel.css">
    <link rel="stylesheet" href="../css/header-white.css">
    <link rel="stylesheet" href="../css/footer-white.css">

</head>
<style>
    input[type="text"],
    input[type="email"] {
        border: 1px solid black;
        width: 200px;
        height: 40px
    }

    textarea {
        border: 1px solid black;
    }
</style>

<body>
<div class="preloader">
        <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
        </div>
    </div>
    <?php
    require 'header-white.php';
    ?>
    <main class="page">
        <section class="page__specialists">
            <div class="specialists__body _container">
                <div class="admin-panel-title ">Аккаунт пользователя</div>
                <div class="tab-admin-panel">


                    <div class="tab-content-admin-panel" style="display:block !important">
                        <?php
                        if ($user_discount != NULL) {

                        ?>
                            <p class="sub-header">Скидка колеса фортуны: <?php echo ($user_discount['discount_name']) ?></p>
                        <?php } ?>
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
                            $query = 'SELECT procedure_record.id_record, user.name, service.service_name, procedure_record.record_date, procedure_record.record_time, service.price, procedure_record_status.record_status_name FROM procedure_record inner join master_service on procedure_record.id_master_service=master_service.id_master_service inner join service on master_service.id_service=service.id_service inner join procedure_record_status on procedure_record.id_record_status=procedure_record_status.id_record_status inner join user on procedure_record.id_user=user.id_user WHERE user.id_user=' . $user_id;

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);

                                    $trBlock .= "
                                                <tr id='$row[0]'>
                                                <td>" . $row[1] . "</td>
                                                <td>" . $row[2] . "</td>
                                                <td>" . $row[3] . "</td>
                                                <td>" . $row[4] . "</td>
                                                <td>" . $row[5] . "</td>
                                                <td>" . $row[6] . "</td>
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
        <section class="callback _container">
            <form id="contactForm">
                <div>
                    <label>
                        <input type="radio" name="contactMethod" value="email" checked>
                        Почта
                    </label>
                </div>
                <div>
                    <label>
                        <input type="radio" name="contactMethod" value="phone">
                        Телефон
                    </label>
                </div>
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" value="<?php echo ($user_phone['name']); ?>">
                <div id="emailField">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>

                <div id="phoneField" style="display: none;">
                    <input type="hidden" value="<?php echo ($user_phone['telephone']); ?>" name="phone">
                </div>
                <textarea name="message" id="message" cols="30" rows="10"></textarea>
                <div>
                    <button type="submit">Отправить</button>
                </div>
            </form>
        </section>
    </main>
    <?php require_once 'footer-white.php' ?>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="../libraries/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="../js/admin-panel-ajax/change-master-data.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log($('input[name="name"]').val());
        const form = document.getElementById('contactForm');
        const emailField = document.getElementById('emailField');
        const phoneField = document.getElementById('phoneField');


        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const method = document.querySelector('input[name="contactMethod"]:checked').value;
            const contactValue = method === 'email' ? document.getElementById('email').value : document.getElementById('phone').value;

            console.log(`Выбранный метод связи: ${method}, значение: ${contactValue}`);
        });

        form.addEventListener('change', function(event) {
            if (event.target && event.target.name === 'contactMethod') {
                if (event.target.value === 'email') {
                    emailField.style.display = 'block';
                    phoneField.style.display = 'none';
                } else if (event.target.value === 'phone') {
                    phoneField.style.display = 'block';
                    emailField.style.display = 'none';
                }
            }
        });

        $('#contactForm').on('submit', function(e) {
            e.preventDefault();

            var name = $('input[name="name"]').val();
            consile.log(name);
            var email = $('input[name="email"]').val();
            var phone = $('input[name="phone"]').val();
            var message = $('textarea[name="message"]').val();

            $.ajax({
                type: 'POST',
                url: '../handlers/callback_script.php',
                data: {
                    name: name,
                    email: email,
                    phone: phone,
                    message: message
                },
                success: function(response) {
                    console.log('Письмо отправлено!');
                    // Очищаем поля ввода после успешной отправки
                    $('input[name="name"]').val('');
                    $('input[name="email"]').val('');
                    $('textarea[name="message"]').val('');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

<script src="../js/signInUp.js"></script>
<script src="../js/preloader.js"></script>

</html>