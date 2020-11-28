<?php
// Tes informations db
$connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM developer WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Donnée supprimée';
 }
}
?>

