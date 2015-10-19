<?php
/**
 * Created by PhpStorm.
 * User: Atilio
 * Date: 10/19/2015
 * Time: 5:57 AM
 */
    require_once 'header.php';

    if(!$loggedin) die();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Living</title>
</head>
<body>
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


for($i=4; $i<=15; $i++){
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
    <title>Living</title>
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
<h2>Living Area Inspection (18 points)</h2>
<form action="bedroom.php" method="POST">
    <p><strong>Carpet vacuumed/clean: </strong><br>
        <input type="radio" name="16" value="0" checked="checked" />  0
        <input type="radio" name="16" value="-4" /> -4</p>
    <p><strong>Dinning table, chairs, clean top, bottom and around clean: </strong><br>
        <input type="radio" name="17" value="0" checked="checked" />  0
        <input type="radio" name="17" value="-3" /> -3</p>
    <p><strong>Picture frames, mirrors, phone clean. Note pad & pen: </strong><br>
        <input type="radio" name="18" value="0" checked="checked" />  0
        <input type="radio" name="18" value="-2" /> -2</p>
    <p><strong>A/C set to 75 degrees/Vents free of dust: </strong><br>
        <input type="radio" name="19" value="0" checked="checked" />  0
        <input type="radio" name="19" value="-2" /> -2</p>
    <p><strong>Ceiling fan free of dust & light fixtures clean and working: </strong><br>
        <input type="radio" name="20" value="0" checked="checked" />  0
        <input type="radio" name="20" value="-2" /> -2</p>
    <p><strong>TV armoire & drawers clean and remote present: </strong><br>
        <input type="radio" name="21" value="0" checked="checked" />  0
        <input type="radio" name="21" value="-2" /> -2</p>
    <p><strong>Sofa top, bottom & behind clean free of trash & stains: </strong><br>
        <input type="radio" name="22" value="0" checked="checked" />  0
        <input type="radio" name="22" value="-2" /> -2</p>
    <p><strong>Curtain, sheers, rod good condition, free from dust: </strong><br>
        <input type="radio" name="23" value="0" checked="checked" />  0
        <input type="radio" name="23" value="-1" /> -1</p>
    <p><input type="submit" value="Proceed to Bedroom" /></p>
</form>
<h3 class="ital" align="center">&copy; 2015 Isabel Molines</h3>
</body>
</html>