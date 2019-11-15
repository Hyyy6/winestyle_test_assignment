<?php

include("dbOpenConnection.php");

$query = "update payment inner join workers on workers.id = payment.worker_id inner join professions on workers.profession_id = professions.id
set salary = salary + ? where payment.date = ? and professions.name = ?";


$stmt = $conn->stmt_init();
if(!$stmt->prepare($query))
{
    print "Failed to prepare statement\n";
}
else
{
    $monthYearVal = $_POST['monthYearVal'].'-00';
    $stmt->bind_param("iss", $_POST['bonus'], $monthYearVal, $_POST['position']);
    $success = $stmt->execute();
    echo $success . ' ' .  $monthYearVal;
}

$stmt->close();
include("dbCloseConnection.php");