<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Current Month's Inspections</title>
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
        <h3 class="ital" align="center">&copy; Isabel Molines</h3>
        <h1>Current Month's Inspections</h1>
        <?php

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$startdate = '2015-10-01';

$query = "SELECT insp_date, COUNT(insp_date) FROM inspections 
            WHERE insp_date >= '$startdate' GROUP BY insp_date ORDER BY insp_date";

$result = $conn->query($query);
if(!$result) die($conn->error);

echo "
<div align='center'><table>
<tr>
<th>Date</th>
<th>Inspections</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td>" . $row['insp_date'] . "</td>";
	echo "<td font-color='red'>" . $row['COUNT(insp_date)'] . "</td>";
	echo "</tr>";
}

echo "</table></div><br><br>";

$query = "SELECT COUNT(insp_date) FROM inspections WHERE insp_date >= '$startdate'";

$result = $conn->query($query);
if(!$result) die($conn->error);

echo "
<div align='center'><table>
<tr>
<th>Total</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td>" . $row['COUNT(insp_date)'] . "</td>";
	echo "</tr>";
}
$result->close();
$conn->close();

echo "</table></div>";
$today = date(d);
echo "<p>Today is day number  ".$today." of this month</p>";
$num_days = date(t); 
echo "<p>Total days in this month: ".$num_days."</p>";
$due = round($today/$num_days * 110);
$due2 = round($today/$num_days * 150);
echo "<p>By the end of this day you should have completed ".$due. "/" . $due2 . " inspections</p>";

        ?>
<table align='center' width=50%>
	<tr>
		<td width=50%>
			<img src='october.png' width="794" height="561">
		</td>
	</tr>
</table>
    </body>
</html>
