<?php
require_once "handlers/mail/mail_client_connect.php";

var_dump(send_mail($settings['mail_settings'], ["basalay.oleg@yandex.by"], 'Тест!', "Текст сообщения"));

?>