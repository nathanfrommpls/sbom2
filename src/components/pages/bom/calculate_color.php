<?php 
require_once('../../../db/connect.php');
/*To clear colors in database:
UPDATE `sbom` SET `color`= ''
*/

//seaches array for a match, returns true if match is found
function exist($key, $array){
	foreach ($array as $element) {
		if ($key == $element[1]) {
			return true;
		}
	}
	return false;
}

//compares two sql fields and returns list of node colors
function color($sql1, $sql2){
	$colors = array();
	for ($i=0; $i < count($sql1); $i++) { 
		$app = exist($sql1[$i][1], $sql2);
		$cmp = exist($sql2[$i][1], $sql1);
		$colors[$i] = colorize($app, $cmp);
	}
	return $colors;
}

//determines colors of the node
function colorize($app, $cmp){
	if (!$app && $cmp){
		return 'red';
	} else {
		return 'yellow';
	}

	// if ($app && !$cmp){
	// 	return 'yellow';
	// } else {
	// 	return 'green';
	// }
}

//converts sql statement to array
function rowArray($sql){
	$rows = array();
	while($row = mysqli_fetch_array($sql)){
		array_push($rows, $row);
	}
	return $rows;
}

//create color array
$sql1 = "SELECT row_id, app_id from sbom;";
$sql2 = "SELECT row_id, cmp_id from sbom;";
$result1 = $db->query($sql1);
$result2 = $db->query($sql2);
$resultCompare1 = rowArray($result1);
$resultCompare2 = rowArray($result2);

$color = color($resultCompare1, $resultCompare2);

// //create output table
// echo '<table align="left"
// cellspacing="5" cellpadding="8">

// <tr><td align="left"><b>App Id</b></td>
// <td align="left"><b>Cmp Id</b></td>
// <td align="left"><b>Color</b></td>';

// //create arrays to populate output
// $sql1 = "SELECT row_id, app_id from sbom;";
// $sql2 = "SELECT row_id, cmp_id from sbom;";
// $result1 = $db->query($sql1);
// $result2 = $db->query($sql2);
// $index = 0;

// //populate output table
// while($row1 = mysqli_fetch_array($result1)){ 
// 	$row2 = mysqli_fetch_array($result2);
// 	$appId = $row1['app_id'];
// 	$cmpId = $row2['cmp_id'];
	
// 	echo '<tr><td align="left">' . 
// 	$row1['app_id'] . '</td><td align="left">' .
// 	$row2['cmp_id'] . '</td><td align="left">' .
// 	"$color[$index]" . 
// 	'<td></td></tr>';
// 	$index++;
// }
// echo '</table>';

//create list of database row Id to insert colors correctly
$sql1 = "SELECT row_id from sbom;";
$result1 = $db->query($sql1);
$rowId = array();
while($row = mysqli_fetch_array($result1)){
	array_push($rowId, $row['row_id']);
}

//update color fields in database
$index = 0;
foreach ($color as $c) {
	$row = $rowId[$index];
	$sql = "UPDATE sbom SET color = '$c' where row_id = '$row'";
	mysqli_query($db, $sql);
	$index++;
}

?>