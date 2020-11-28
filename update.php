<?php
// Tes informations db
$connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE user SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Donnée modifiée';
 }
}
?>