<?php
// Tes informations db
$connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST["name"], $_POST["openradio"], $_POST["commentaire"], $_POST["projet"], $_POST["designation"], $_POST["valide"], $_POST["categorie"], $_POST["numero"], $_POST["date"]))
{
 $first_name = mysqli_real_escape_string($connect, $_POST["first_name"]);
 $last_name = mysqli_real_escape_string($connect, $_POST["last_name"]);
 $query = "INSERT INTO user(name, openradio, commentaire, projet, designation, valide, categorie, numero, date) VALUES('$name', '$openradio', '$commentaire', '$projet', '$designation', '$valide', '$categorie', '$numero', '$date')";
 if(mysqli_query($connect, $query))
 {
  echo 'Donnée créée';
 }
}
?>