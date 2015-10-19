<?php
/**
 * Created by PhpStorm.
 * User: Atilio
 * Date: 10/19/2015
 * Time: 6:17 AM
 */
    require_once 'header.php';

    if(!$loggedin) die();
?>
<!DOCTYPE html>
<?php
session_start();
//echo "Session ID: ".session_id()."<br>";
$session = session_id();
$room = $_SESSION["room"];
//echo "Room: ".$room."<br>";
$cleandate = $_SESSION["cleandate"];
//echo "Cleaned: ".$cleandate."<br>";

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

for($i=51; $i<=51; $i++){
    //echo "$i ".$i." points off: ".$points."<br>";
    //$points[$i] = $_POST["$i"];
    //echo "Item ".$i." points off: ".$_POST[$i]."<br>";
    $query = "INSERT INTO inspection (session, room_number, clean_date, item_id, points_off) VALUES ('$session', '$room', '$cleandate', '$i', $_POST[$i])";


    $result = $conn->query($query);
    if(!$result) die($conn->error);
}

?>
<html>
<head>
    <meta name="viewport" content="initial-scale=1">
    <meta charset="UTF-8">
    <title>Villas Computerized Inspection System</title>
    <style type="text/css">
        body.back {background: lightblue}
        h1 {text-align: center}
        h2 {text-align: center}
        h3.ital {font-style: italic}
        p {text-align: center}
        .center {
            text-align: center;
        }
        .left {
            text-align: left;
        }
        .right {
            text-align: right;
        }
        table {
            width: auto;
            margin: auto;
        }
        th {
            text-align: center;
            border-bottom: 1px solid black;
        }
        td {
            text-align: center;
        }
        caption {
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body class="back">
<?php
?>
<h1>Computerized Inspection System</h1>
<h2>Villa Inspection Report</h2>
<?php
session_start();
//        $session = session_id();
//echo "<p><strong>Session:</strong> ".session_id()."</p>";

echo "<table>";

$query = "SELECT id
            FROM inspections
            WHERE session = '$session'
            AND room_number = $_SESSION[room]
            AND clean_date = '$_SESSION[cleandate]' ";

//echo "$sql<br><br>";

$result = $conn->query($query);
if(!$result) die($conn->error);

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td align=center><b>Inspection No.: ".$row[0]."</b></td>";
    echo "</tr>";
}
echo "</table>";

//$inspid = $row[0];
//echo $inspid;

//echo "<p>Inspection No.: ".$row[0]."</p>";
echo "<p><strong>Villa number:</strong>: ".$_SESSION["room"]."</p>";
echo "<p><strong>Date cleaned</strong>: ".$_SESSION["cleandate"]."</p>";
echo "<p><strong>Cleaned by:</strong> ".$_SESSION["gra"]."</p>";

$query = "SELECT * FROM inspection WHERE room_number = $_SESSION[room] AND clean_date = '$_SESSION[cleandate]' AND points_off < 0 ORDER BY session, room_number, clean_date, item_id";

$result = $conn->query($query);
if(!$result) die($conn->error);

$query =
    "UPDATE inspection
SET descrip =
	(SELECT description
	FROM inspitems
	WHERE id = item_id)
WHERE room_number = $_SESSION[room] AND clean_date = '$_SESSION[cleandate]'";

$result = $conn->query($query);
if(!$result) die($conn->error);

echo "<table>
    <caption>Points taken off</caption>
<tr>
<th>ID</th>
<th>Description</th>
<th>Points off</th>
</tr>";

//        $sql = "SELECT inspection.item_id, inspitems.description, inspection.points_off FROM inspitems, inspection WHERE inspitems.id = inspection.item_id AND room_number = $_SESSION[room] AND clean_date = '$_SESSION[cleandate]' AND points_off < 0 ORDER BY item_id";
$query = "SELECT item_id, descrip, inspection.points_off FROM inspection WHERE room_number = $_SESSION[room] AND clean_date = '$_SESSION[cleandate]' AND points_off < 0 ORDER BY item_id";

$result = $conn->query($query);
if(!$result) die($conn->error);
//	echo "The records were obtained.";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$row['item_id']."</td>";
    echo "<td class='left'>".$row['descrip']."</td>";
    echo "<td class='center'>".$row['points_off']."</td>";
    echo "</tr>";
}
echo "</table><br><br>";


echo "<table>
<tr>
<th class='center'>Overall Score</th>
</tr>";
$query = "SELECT SUM(points_off)+100
            FROM inspection
            WHERE session = '$session'
            AND room_number = $_SESSION[room]
            AND clean_date = '$_SESSION[cleandate]' ";

//echo "$sql<br><br>";

$result = $conn->query($query);
if(!$result) die($conn->error);
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td><b>".$row[0]."</b></td>";
    echo "</tr>";
}
echo "</table>";




$query  = "UPDATE inspections
SET score =
    (SELECT SUM(points_off)+100
            FROM inspection
            WHERE session = '$session'
            AND room_number = $_SESSION[room]
            AND clean_date = '$_SESSION[cleandate]')
        WHERE session = '$session'
        AND room_number = $_SESSION[room]
        AND clean_date = '$_SESSION[cleandate]'";


//echo "$sql<br><br>";

$result = $conn->query($query);
if(!$result) die($conn->error);


echo "<p><strong>Date inspected</strong>: ".$_SESSION["inspdate"]."</p>";
echo "<p><strong>Inspected by:</strong> ".$_SESSION["supervisor"]."</p>";



//$result->close();
$conn->close();
?>


<form action="/secinspections/index.php" method="POST">

    <p><input type="submit" value="New Inspection" /></p>
</form>
<h3 class="ital" align="center">&copy; 2015 Isabel Molines</h3>
</body>
</html>