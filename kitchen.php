<?php
/**
 * Created by PhpStorm.
 * User: Atilio
 * Date: 10/19/2015
 * Time: 5:54 AM
 */
    require_once 'header.php';

    if(!$loggedin) die();
?>
<?php
session_start();
//echo "Session ID: ".session_id()."<br>";
$session = session_id();
//echo $_SESSION["room"];
//echo $_SESSION["cleandate"];

//        echo "Room number: ".$_SESSION["room"]."<br>";
//echo "room number = ".$_SESSION["room"]." <br><br>";

$room = $_SESSION["room"];
//echo "$room = <br><br>";
//echo "$room = ".$room."<br><br>";
$cleandate = $_SESSION["cleandate"];
//echo "$cleandate = ".$cleandate."<br><br>";
//echo "$cleandate = <br><br>";

$item1 = $_POST["1"];
//echo "Item 1 points off: ".$item1."<br>";
$item2 = $_POST["2"];
//echo "Item 2 points off: ".$item2."<br>";
$item3 = $_POST["3"];
//echo "Item 3 points off: ".$item3."<br>";

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

for($i=1; $i<=3; $i++) {
    //echo "$i ".$i." points off: ".$points."<br>";
    //$points[$i] = $_POST["$i"];
    //echo "Item ".$i." points off: ".$_POST[$i]."<br>";

    $query = "INSERT INTO inspection (session, room_number, clean_date, item_id, points_off) VALUES ('$session', '$room', '$cleandate', '$i', $_POST[$i])";

    //echo $query;

    $result = $conn->query($query);
    if (!$result) die($conn->error);

}

$conn->close();


?>

<html>
<head>
    <meta name="viewport" content="initial-scale=1">
    <meta charset="UTF-8">
    <title>Kitchen</title>
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
<h2>Kitchen Inspection (28 points)</h2>
<form action="living.php" method="POST">
    <p><strong>Floor clean, free of hair and dirt: </strong><br>
        <input type="radio" name="4" value="0" checked="checked" />  0
        <input type="radio" name="4" value="-4" /> -4</p>
    <p><strong>Counter tops, cabinets,<br>
            drawers, bar stools are clean: </strong><br>
        <input type="radio" name="5" value="0" checked="checked" />  0
        <input type="radio" name="5" value="-3" /> -3</p>
    <p><strong>Sink, back splashes and walls<br> are clean. Chrome polished: </strong><br>
        <input type="radio" name="6" value="0" checked="checked" />  0
        <input type="radio" name="6" value="-2" /> -2</p>
    <p><strong>Trash bin empty and clean <br>with proper bag/dish rack clean: </strong><br>
        <input type="radio" name="7" value="0" checked="checked" />  0
        <input type="radio" name="7" value="-2" /> -2</p>
    <p><strong>Kitchen inventory<br> counted/replaced and clean: </strong><br>
        <input type="radio" name="8" value="0" checked="checked" />  0
        <input type="radio" name="8" value="-3" /> -3</p>
    <p><strong>Dishwasher empty, clean<br> and free from food leftovers: </strong><br>
        <input type="radio" name="9" value="0" checked="checked" />  0
        <input type="radio" name="9" value="-2" /> -2</p>
    <p><strong>Fridge clean in,<br> out and around: </strong><br>
        <input type="radio" name="10" value="0" checked="checked" />  0
        <input type="radio" name="10" value="-2" /> -2</p>
    <p><strong>Microwave clean in & out,<br> top & under (free of grease): </strong><br>
        <input type="radio" name="11" value="0" checked="checked" />  0
        <input type="radio" name="11" value="-2" /> -2</p>
    <p><strong>3 regular & 1 decaf coffee<br>
            4 creamers, 2 tea bags, 4 Splenda<br>
            4 Equal, 4 sugar and 4 Sweet and Low: </strong><br>
        <input type="radio" name="12" value="0" checked="checked" />  0
        <input type="radio" name="12" value="-2" /> -2</p>
    <p><strong>Sink clean and<br> chrome areas polished: </strong><br>
        <input type="radio" name="13" value="0" checked="checked" />  0
        <input type="radio" name="13" value="-2" /> -2</p>
    <p><strong>3 clean dish towels,<br>1 Palmolive and<br>2 dishwasher soap: </strong><br>
        <input type="radio" name="14" value="0" checked="checked" />  0
        <input type="radio" name="14" value="-2" /> -2</p>
    <p><strong>Toaster, coffee maker<br>and knives block clean: </strong><br>
        <input type="radio" name="15" value="0" checked="checked" />  0
        <input type="radio" name="15" value="-2" /> -2</p>
    <p><input type="submit" value="Proceed to Living" /></p>
</form>
<h3 class="ital" align="center">&copy; 2015 Isabel Molines</h3>
</body>
</html>