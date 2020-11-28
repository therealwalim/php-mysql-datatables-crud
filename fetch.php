<?php
//fetch.php
// Tes informations db
$connect = mysqli_connect("localhost", "root", "", "testing");
$columns = array('name', 'openradio', 'commentaire', 'projet', 'designation', 'valide', 'categorie', 'numero', 'date');

$query = "SELECT * FROM developer ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE name LIKE "%'.$_POST["search"]["value"].'%" 
 OR openradio LIKE "%'.$_POST["search"]["value"].'%"
 OR commentaire LIKE "%'.$_POST["search"]["value"].'%" 
 OR projet LIKE "%'.$_POST["search"]["value"].'%"
 OR designation LIKE "%'.$_POST["search"]["value"].'%"
 OR valide LIKE "%'.$_POST["search"]["value"].'%"
 OR categorie LIKE "%'.$_POST["search"]["value"].'%"
 OR numero LIKE "%'.$_POST["search"]["value"].'%"
 OR date LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="name">' . $row["name"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="openradio">' . $row["openradio"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="commentaire">' . $row["commentaire"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="projet">' . $row["projet"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="designation">' . $row["designation"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="valide">' . $row["valide"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="categorie">' . $row["categorie"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="numero">' . $row["numero"] . '</div>';
 $sub_array[] = '<div disabled="true" class="update" data-id="'.$row["id"].'" data-column="date">' . $row["date"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM developer";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>