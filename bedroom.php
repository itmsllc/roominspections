<?php
/**
 * Created by PhpStorm.
 * User: Atilio
 * Date: 10/19/2015
 * Time: 5:59 AM
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


for($i=16; $i<=23; $i++){
    //echo "$i ".$i." points off: ".$points."<br>";
    //$points[$i] = $_POST["$i"];
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
    <title>Bedroom</title>
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
<h2>Bedroom Inspection (12 points)</h2>
<form action="bathrooms.php" method="POST">
    <p><strong>Carpet vacuumed/clean. drapes and curtains clean: </strong><br>
        <input type="radio" name="24" value="0" checked="checked" />  0
        <input type="radio" name="24" value="-3" /> -3</p>
    <p><strong>Bed Linen/Duvet, skirt clean, free of stains and hair: </strong><br>
        <input type="radio" name="25" value="0" checked="checked" />  0
        <input type="radio" name="25" value="-2" /> -2</p>
    <p><strong>All furniture, radio, phone free of dust and stains: </strong><br>
        <input type="radio" name="26" value="0" checked="checked" />  0
        <input type="radio" name="26" value="-2" /> -2</p>
    <p><strong>Closet: 6 skirt and 6 coat hangers, laundry bag, laundry slip, pillow, blanket, luggage rack, bath robe with card and pressing card: </strong><br>
        <input type="radio" name="27" value="0" checked="checked" />  0
        <input type="radio" name="27" value="-2" /> -2</p>
    <p><strong>Breakfast menu clean and neat, linen card present: </strong><br>
        <input type="radio" name="28" value="0" checked="checked" />  0
        <input type="radio" name="28" value="-1" /> -1</p>
    <p><strong>Ceiling fan/Vents free of dust: </strong><br>
        <input type="radio" name="29" value="0" checked="checked" />  0
        <input type="radio" name="29" value="-2" /> -2</p>
    <p><input type="submit" value="Proceed to Bathrooms" /></p>
</form>
<h3 class="ital" align="center">&copy; 2015 Isabel Molines</h3>
</body>
</html>