<?php
/**
 * Created by PhpStorm.
 * User: Atilio
 * Date: 10/19/2015
 * Time: 6:07 AM
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

for($i=41; $i<=43; $i++){
    //echo "Item ".$i." points off: ".$_POST[$i]."<br>";
    $query = "INSERT INTO inspection (session, room_number, clean_date, item_id, points_off) VALUES ('$session', '$room', '$cleandate', '$i', $_POST[$i])";


    $result = $conn->query($query);
    if(!$result) die($conn->error);
}
//$result->close();
$conn->close();

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
    </style>
</head>
<body class="back">
<h1>Villas Computerized Inspection System</h1>
<h2>Den Inspection (4 points)</h2>
<form action="terrace.php" method="POST">
    <p><strong>1 blanket, 1 pillow in the closet: </strong><br>
        <input type="radio" name="44" value="0" checked="checked" />  0
        <input type="radio" name="44" value="-1" /> -1</p>
    <p><strong>Sofa bed clean and without linen: </strong><br>
        <input type="radio" name="45" value="0" checked="checked" />  0
        <input type="radio" name="45" value="-1" /> -1</p>
    <p><strong>Furniture clean and polished: </strong><br>
        <input type="radio" name="46" value="0" checked="checked" />  0
        <input type="radio" name="46" value="-2" /> -2</p>
    <p><input type="submit" value="Proceed to Terrace" /></p>
</form>
<h3 class="ital" align="center">&copy; 2015 Isabel Molines</h3>
</body>
</html>