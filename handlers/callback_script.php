<?php
if(session_id()==""){
    session_start();
}

    require_once "../database/db.php";
    require_once "mail/mail_client_connect.php";

    $isLoggedIn=false;
    if(isset($_SESSION['UserID'])){
        $id_user=$_SESSION['UserID'];
        $isLoggedIn=true;

    }
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $comment=$_POST['comment'];
    $status="получено";

    if($isLoggedIn==true){
        $insert_callback=mysqli_query($link, "INSERT INTO requested_feedback VALUES (NULL, $id_user, '$name', '$phone', '$comment', '$status')");
    }else{
        $insert_callback=mysqli_query($link, "INSERT INTO requested_feedback VALUES (NULL, NULL, '$name', '$phone', '$comment', '$status')");
    }

?>