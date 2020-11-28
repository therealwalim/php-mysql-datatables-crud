<?php
// Tes informations db
$connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST["name"], $_POST["openradio"], $_POST["commentaire"], $_POST["projet"], $_POST["designation"], $_POST["valide"], $_POST["categorie"], $_POST["numero"], $_POST["date"]))
{
 $name = mysqli_real_escape_string($connect, $_POST["name"]);
 $openradio = mysqli_real_escape_string($connect, $_POST["openradio"]);
 $commentaire = mysqli_real_escape_string($connect, $_POST["commentaire"]);
 $projet = mysqli_real_escape_string($connect, $_POST["projet"]);
 $designation = mysqli_real_escape_string($connect, $_POST["designation"]);
 $valide = mysqli_real_escape_string($connect, $_POST["valide"]);
 $categorie = mysqli_real_escape_string($connect, $_POST["categorie"]);
 $numero = mysqli_real_escape_string($connect, $_POST["numero"]);
 $date = mysqli_real_escape_string($connect, $_POST["date"]);
 $query = "INSERT INTO user(name, openradio, commentaire, projet, designation, valide, categorie, numero, date) VALUES('$name', '$openradio', '$commentaire', '$projet', '$designation', '$valide', '$categorie', '$numero', '$date')";
 if(mysqli_query($connect, $query))
 {
  echo 'Donnée créée';
 }
}
?>