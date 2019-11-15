<?php

include("dbOpenConnection.php");

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'photos/'; // upload directory
if(!empty($_POST['workerId']) || $_FILES['image'])
{
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
// get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
    $final_image = $_POST['workerId'].$img;
// check's valid format
    if(in_array($ext, $valid_extensions))
    {
        $path = $path.strtolower($final_image);
        if(move_uploaded_file($tmp,$path))
        {
            echo "<img src='$path' width='256'/>";

            //update photo url data in the database
            $update = $conn->query("UPDATE workers SET photo_url =\"".$path."\"WHERE id =".$_POST['workerId']);
            //echo $update?'ok':'err';
        }
    }
    else
    {
        echo 'invalid';
    }
}
include("dbCloseConnection.php");
?>