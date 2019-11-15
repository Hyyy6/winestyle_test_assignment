<?php
include("dbOpenConnection.php");


$query = "SELECT name FROM professions";

//подготовленный запрос не нужен, так как из HTTP запроса никакие параметры не передаются. Как следствие, в данном случае SQL-инъекция не осуществима
$result = $conn->query($query);

while($row = $result->fetch_assoc()) {
    echo "<option>" . $row['name'] . "</option>";
}

include("dbCloseConnection.php");