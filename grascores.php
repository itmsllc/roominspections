<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GRAs Scoring Averages</title>
        <style type="text/css">
            body.back {background: lightblue}
            h1 {text-align: center}
            h2 {text-align: center}
            h3.ital {font-style: italic}
            p {text-align: center}

        </style>
    </head>
    <body class="back">
        <h2>Computerized Inspection System</h2>
        <h3 class="ital" align="center">&copy; Isabel Molines</h3>
        <h1>GRAs Average Scores</h1>
        <?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);


$query = "SELECT gra, COUNT(gra), AVG(score) FROM inspections GROUP BY gra ORDER BY gra";

$result = $conn->query($query);
if(!$result) die($conn->error);

echo "
<div align='center'>
<table>
<tr>
<th>GRA</th>
<th>Count</th>
<th>Score</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
        $gra = $row['gra'];
	echo "<tr>";
	echo "<td><a href='grainspections.php?gra=$gra'>" . $gra . "</a></td>";
	//echo "<td>" . $row['gra'] . "</td>";
	echo "<td style='text-align:center'>" . $row['COUNT(gra)'] . "</td>";
	echo "<td>" . $row['AVG(score)'] . "</td>";
	echo "</tr>";
}

$result->close();
$conn->close();

echo "</table></div>";
        ?>
    </body>
</html>
