<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
$hostname = "newhotelpms.db.8536431.hostedresource.com";
$username = "newhotelpms";
$dbname = "newhotelpms";
$password = "K@lahari1";
$usertable = "roomTypes";

$mysqli = mysqli_connect($hostname, $username, $password, $dbname) OR DIE ("Unable to
connect to database! Please try again later.");


//$sql = "SELECT * FROM inspections WHERE gra LIKE 'Y%' ORDER BY gra";
//$sql = "SELECT * FROM inspections WHERE insp_date > '2015-07-31' ORDER BY id";
$sql = "SELECT * FROM inspections ORDER BY id";

$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
if ($res === FALSE) {
	echo "The records were not obtained.";
}
if ($res === TRUE) {
	echo "The records were obtained.";
}

echo "<table>
<tr>
<th>id</th>
<th>Inspected</th>
<th>Room</th>
<th>Status</th>
<th>Cleaned</th>
<th>Manager</th>
<th>Supervisor</th>
<th>GRA</th>
<th>Session</th>
<th>Score</th>
</tr>";

while($row = mysqli_fetch_array($res)) {
	echo "<tr>";
	echo "<td>" . $row['id'] . "</td>";
	echo "<td>" . $row['insp_date'] . "</td>";
	echo "<td style='text-align:right'>" . $row[room_number] . "</td>";
	echo "<td>" . $row['room_status'] . "</td>";
	echo "<td>" . $row['clean_date'] . "</td>";
	echo "<td>" . $row['manager'] . "</td>";
	echo "<td>" . $row['supervisor'] . "</td>";
	echo "<td>" . $row['gra'] . "</td>";
	echo "<td>" . $row['session'] . "</td>";
	echo "<td style='text-align:right'>" . $row[score] . "</td>";
	echo "</tr>";
}

mysqli_close($mysqli);
echo "</table>";
        ?>
    </body>
</html>

