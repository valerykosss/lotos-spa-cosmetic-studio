<?php

if (session_id() == '') {
    session_start();
}

$connect = new PDO('mysql:host=localhost;dbname=lotos', 'root', 'root');

$data = array();

$masterId = $_SESSION['UserID'];

$query = "
    SELECT 
        mt.id, 
        mt.id_master, 
        mt.start, 
        mt.end 
    FROM 
        master_timetable mt
    JOIN 
        master m 
    ON 
        mt.id_master = m.id_master
    WHERE 
        m.id_user = :masterId
";

$statement = $connect->prepare($query);

// Привязка параметра :masterId
$statement->bindParam(':masterId', $masterId, PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    $data[] = array(
        'id' => $row['id'],
        'id_master' => $row['id_master'],
        'start' => $row['start'],
        'end' => $row['end']
    );
}

echo json_encode($data);
?>
