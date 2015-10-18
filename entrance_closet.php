<?php
    require_once 'header.php';

    if(!$loggedin) die();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Housekeeping Inspection System -  Entrance/Closet Area</title>
        <style type="text/css">
            body.back {background: lightblue}
            h1 {text-align: center}
            h2 {text-align: center}
            h3.ital {font-style: italic}
            p {text-align: center}
        </style>
    </head>
    <body class="back">
        <h2>Housekeeping Dept.<br>Inspection System</h2>
        <h1>Main Building</h1>
        <h3 class="ital" align="center">&copy; Isabel Molines</h3>
        <h2>ENTRANCE/CLOSET AREA (13 points)</h2>
<?php
session_start();
//echo "Session ID: ".session_id()."<br>";
$session = session_id();
$room = $_SESSION["room"];
$cleandate = $_SESSION["cleandate"];
$item1 = $_POST["1"];
//echo "Item 1 points off: ".$item1."<br>";
$item2 = $_POST["2"];
//echo "Item 2 points off: ".$item2."<br>";
$item3 = $_POST["3"];
//echo "Item 3 points off: ".$item3."<br>";

require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
        
    for($i=1; $i<=1; $i++){
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
        <form action="dresser.php" method="POST">
            <p><strong>Doors/ frames clean, connecting door locked: </strong><br>
                <input type="radio" name="2" value="0" checked="checked" />  0
                <input type="radio" name="2" value="-2" /> -2 </p>
            <p><strong>Room smells fresh & clean/ PRESENTATION: </strong><br>
                <input type="radio" name="3" value="0" checked="checked" />  0
                <input type="radio" name="3" value="-3" /> -3 </p>
            <p><strong>1 Laundry Tickets & 1 Bags: </strong><br>
                <input type="radio" name="4" value="0" checked="checked" />  0
                <input type="radio" name="4" value="-1" /> -1 </p>
            <p><strong>Iron is neatly stowed in a clean rack, free of water cable fold/iron board is clean and correctly hung: </strong><br>
                <input type="radio" name="5" value="0" checked="checked" />  0
                <input type="radio" name="5" value="-1" /> -1 </p>
            <p><strong>Closet stocked (6 Pant, 6 Clip, lugagge rack 2, satin hangers, 2 robes clean, free of stains or holes: </strong><br>
                <input type="radio" name="6" value="0" checked="checked" />  0
                <input type="radio" name="6" value="-2" /> -2 </p>
            <p><strong>Closet shelf and rod clean; no dust. Clean blanket neatly folded  with a pillow in zipper bag. Starch: </strong><br>
                <input type="radio" name="7" value="0" checked="checked" />  0
                <input type="radio" name="7" value="-2" /> -2 </p>
            <p><strong>Entrance Wall and Baseboard free of dust and marks: </strong><br>
                <input type="radio" name="8" value="0" checked="checked" />  0
                <input type="radio" name="8" value="-2" /> -2 </p>
            <p><input type="submit" value="Proceed to Dresser" /></p>
        </form>
    </body>
</html>
