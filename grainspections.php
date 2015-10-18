<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            body.back {background: lightblue}
            h1 {text-align: center}
            h2 {text-align: center}
            h3.ital {font-style: italic}
            p {text-align: center}
            td {text-align: center}
        </style>
    </head>
    <body class="back">
        <h2>Computerized Inspection System</h2>
        <h3 class="ital" align="center">by Isabel Molines</h3>
        <?php

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$gra= $_GET['gra'];
//echo "gra = ".$gra;
echo "        <h1>Inspections by<br>" .$gra . "</h1>";

$query = "SELECT * FROM inspections WHERE gra = '$gra' ORDER BY insp_date, room_number";
//$sql = "SELECT * FROM inspections";

$result = $conn->query($query);
if(!$result) die($conn->error);

echo "<div align='center'>
    <table>
        <tr>
        <th>id</th>
        <th>Inspected</th>
        <th>Room</th>
        <th>Status</th>
        <th>Score</th>
        </tr>";

while($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
	echo "<tr>";
	echo "<td><a href='gradetails.php?id=$id'>" . $id . "</a></td>";
//	echo "<td>" . $row['id'] . "</td>";
	echo "<td>" . $row['insp_date'] . "</td>";
	echo "<td>" . $row['room_number'] . "</td>";
	echo "<td>" . $row['room_status'] . "</td>";
	//echo "<td>" . $row['clean_date'] . "</td>";
	echo "<td>" . $row['score'] . "</td>";
	echo "</tr>";
}

$result->close();
$conn->close();

echo "</table></div>";
        ?>
    </body>
</html>
