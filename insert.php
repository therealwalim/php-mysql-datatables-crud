<?php
// Tes informations db
$connect = mysqli_connect("localhost", "root", "", "testing");
 $name = mysqli_real_escape_string($connect, $_POST["name"]);
 $openradio = mysqli_real_escape_string($connect, $_POST["openradio"]);
 $commentaire = mysqli_real_escape_string($connect, $_POST["commentaire"]);
 $projet = mysqli_real_escape_string($connect, $_POST["projet"]);
 $designation = mysqli_real_escape_string($connect, $_POST["designation"]);
 $valide = mysqli_real_escape_string($connect, $_POST["valide"]);
 $categorie = mysqli_real_escape_string($connect, $_POST["categorie"]);
 $numero = mysqli_real_escape_string($connect, $_POST["numero"]);
 $date = date("Y-m-d");
 $query = "INSERT INTO developer(name, openradio, commentaire, projet, designation, valide, categorie, numero, date) VALUES('$name', '$openradio', '$commentaire', '$projet', '$designation', '$valide', '$categorie', '$numero', '$date')";
 if(mysqli_query($connect, $query))
 {
  echo 'Donnée créée';
 }
?>