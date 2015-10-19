<?php
/**
 * Created by PhpStorm.
 * User: Atilio
 * Date: 10/19/2015
 * Time: 6:05 AM
 */
    require_once 'header.php';

    if(!$loggedin) die();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
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


for($i=30; $i<=40; $i++){
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
<h2>Laundry Inspection Checklist (3 points)</h2>
<form action="den.php" method="POST">
    <p><strong>Ironing board, iron clean. Holder in working order: </strong><br>
        <input type="radio" name="41" value="0" checked="checked" />  0
        <input type="radio" name="41" value="-1" /> -1</p>
    <p><strong>Washer and Dryer clean. Lint compartment empty: </strong><br>
        <input type="radio" name="42" value="0" checked="checked" />  0
        <input type="radio" name="42" value="-1" /> -1</p>
    <p><strong>1 Tide 1 Snuggle: </strong><br>
        <input type="radio" name="43" value="0" checked="checked" />  0
        <input type="radio" name="43" value="-1" /> -1</p>
    <p><input type="submit" value="Proceed to Den" /></p>
</form>
<h3 class="ital" align="center">&copy; 2015 Isabel Molines</h3>
</body>
</html>