<?php
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
        
    for($i=36; $i<=48; $i++){
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
        <title>Computerized Inspection System</title>
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
                padding: 0 5em 0 0.5em;
                background-color: aquamarine;
                border-top: 1px solid #FB7A31;
                border-bottom: 1px solid #FB7A31;                
            }
            td {
                text-align: center;
                border-bottom: solid 1px #CCC;
                padding: 0 5em 0 0.5em;
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
        <h3 class="ital" align="center">&copy; Isabel Molines</h3>
        <h2>Room Inspection Report</h2>
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
        echo "<p><strong>Room number:</strong>: ".$_SESSION["room"]."</p>";
        echo "<p><strong>Date cleaned</strong>: ".$_SESSION["cleandate"]."</p>";
        echo "<p><strong>Cleaned by:</strong> ".$_SESSION["gra"]."</p>";

$query = "SELECT * FROM inspection WHERE room_number = $_SESSION[room] AND clean_date = '$_SESSION[cleandate]' AND points_off < 0 ORDER BY session, room_number, clean_date, item_id";

$result = $conn->query($query);
if(!$result) die($conn->error);

$query = 
"UPDATE inspection 
SET descrip =
	(SELECT description
	FROM roomitems
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

$result = $conn->query($query);
if(!$result) die($conn->error);

while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td style='text-align:center'><b>".$row[0]."</b></td>";
	echo "</tr>";
}
echo "</table>";





$query = "UPDATE inspections 
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


        <form action="mb.php" method="POST">

            <p><input type="submit" value="New Inspection" /></p>
        </form>
    </body>
</html>
