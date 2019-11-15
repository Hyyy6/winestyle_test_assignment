<?php
include ("dbOpenConnection.php");

$query = "select workers.id, photo_url, first_name, last_name,
 professions.name, workers.wage, payment.salary
 FROM 
	workers INNER JOIN professions ON workers.profession_id = professions.id
    LEFT JOIN payment ON workers.id = payment.worker_id
    AND payment.date = ?
ORDER BY workers.id";


$stmt = $conn->stmt_init();
if(!$stmt->prepare($query))
{
    print "Failed to prepare statement\n";
}
else
{
    $monthYearVal = $_POST['monthYearVal'].'-00';
    $stmt->bind_param("s", $monthYearVal);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $photo_url, $first_name, $last_name, $profession_name, $wage, $salary);

    if ($stmt->num_rows > 0) {
        echo "<div class='divTable'>";
        echo "<div class='divTableBody'>";

        // output data of each row
        while($stmt->fetch()) {
            echo "<div class='divTableRow' id=".$id.">";

            echo "<div class='divTableCell' name='id'>" . $id . "</div>";

            echo "<div class='divTableCell'>";
            if ($photo_url == null)
                echo "<a href='#ex2'rel='modal:open'>No photo</a></div>";
            else
                echo "<a href='#ex1'rel='modal:open'><img src=" . $photo_url . " height='42' class = 'photo_url'></a></div>";

            echo "<div class='divTableCell' name='first_name'>" . $first_name . "</div>";
            echo "<div class='divTableCell' name='last_name'>" . $last_name . "</div>";
            echo "<div class='divTableCell' name='profession_name'>" . $profession_name . "</div>";
            echo "<div class='divTableCell' name='wage'>" . $wage . "</div>";


            echo "<div class='divTableCell' name='salary'>";
            if ($salary == null)
                echo "No data" . "</div>";
            else
                echo $salary . "</div>";

            echo "</div>";
            }


        echo "</div>\n</div>";
    } else {
        echo "0 results";
    }
}
$stmt->close();
include("dbCloseConnection.php");
