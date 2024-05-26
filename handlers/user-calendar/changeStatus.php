<?php
session_start();
$id_user = $_SESSION['UserID'];

if(isset($_POST["id"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=lotos', 'root', 'root');

 $query = "UPDATE procedure_record
 SET id_record_status = 3
 WHERE id_record=:id";

 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>