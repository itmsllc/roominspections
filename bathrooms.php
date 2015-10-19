<?php
/**
 * Created by PhpStorm.
 * User: Atilio
 * Date: 10/19/2015
 * Time: 6:02 AM
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

for($i=24; $i<=29; $i++){
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
<h2>Bathroom Inspection Checklist (23 points)</h2>
<form action="laundry.php" method="POST">
    <p><strong>Floors clean, free of hair and dirt: </strong><br>
        <input type="radio" name="30" value="0" checked="checked" />  0
        <input type="radio" name="30" value="-4" /> -4</p>
    <p><strong>Shower/tub/door clean, free of hair & soap scum and Mold/Mildew, Jacuzzi clean, jets mold free: </strong><br>
        <input type="radio" name="31" value="0" checked="checked" />  0
        <input type="radio" name="31" value="-4" /> -4</p>
    <p><strong>Toilet clean, in & out and around base: </strong><br>
        <input type="radio" name="32" value="0" checked="checked" />  0
        <input type="radio" name="32" value="-3" /> -3</p>
    <p><strong>Mirrors, Vanity clean, sink clean drain closed: </strong><br>
        <input type="radio" name="33" value="0" checked="checked" />  0
        <input type="radio" name="33" value="-2" /> -2</p>
    <p><strong>Correct count of vanity amenity and presentation: </strong><br>
        <input type="radio" name="34" value="0" checked="checked" />  0
        <input type="radio" name="34" value="-1" /> -1</p>
    <p><strong>Towel, correct count, good condition, presentation: </strong><br>
        <input type="radio" name="35" value="0" checked="checked" />  0
        <input type="radio" name="35" value="-2" /> -2</p>
    <p><strong>Trash can clean: </strong><br>
        <input type="radio" name="36" value="0" checked="checked" />  0
        <input type="radio" name="36" value="-2" /> -2</p>
    <p><strong>Klennex & Toilet papers folded to a triangular point: </strong><br>
        <input type="radio" name="37" value="0" checked="checked" />  0
        <input type="radio" name="37" value="-1" /> -1</p>
    <p><strong>1 hairdryer in bathroom and free of lint in catch cup: </strong><br>
        <input type="radio" name="38" value="0" checked="checked" />  0
        <input type="radio" name="38" value="-1" /> -1</p>
    <p><strong>Soap dish clean, free of soap scum: </strong><br>
        <input type="radio" name="39" value="0" checked="checked" />  0
        <input type="radio" name="39" value="-1" /> -1</p>
    <p><strong>Vanity tray clean, amenities are properly displayed. Kleenex and toilet tissue are pointed and at proper level. Card and rug clean present and in good condition: </strong><br>
        <input type="radio" name="40" value="0" checked="checked" />  0
        <input type="radio" name="40" value="-2" /> -2</p>
    <p><input type="submit" value="Proceed to Laundry" /></p>
</form>
<h3 class="ital" align="center">&copy; 2015 Isabel Molines</h3>
</body>
</html>