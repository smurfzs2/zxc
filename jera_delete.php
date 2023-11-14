<?php


include '../connection.php';


if(isset($_POST['delete']))

$id = $_POST['id'];

$delete = "DELETE FROM tbl_jeramay WHERE id='$id'";
$delete_run = mysqli_query($db,$delete);  

if($delete_run)
{
    header('Location: jera_quickTable.php');
   
}
else
{
    echo "error";
}



?>