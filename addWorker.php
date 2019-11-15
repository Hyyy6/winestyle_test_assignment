<?php

include("dbOpenConnection.php");

$query = "INSERT INTO workers (first_name, last_name, profession_id, wage) VALUES (?, ?, (SELECT id FROM professions WHERE name = ?), ?)";


$stmt = $conn->stmt_init();
if(!$stmt->prepare($query))
{
    print "Failed to prepare statement\n";
}
else
{
    $stmt->bind_param("sssi", $_POST['add_first_name'], $_POST['add_last_name'], $_POST['add_position'], $_POST['add_wage']);
    $stmt->execute();
}

$stmt->close();
include("dbCloseConnection.php");