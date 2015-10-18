<?php
    require_once 'header.php';

    if(!$loggedin) die();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Computerized Inspection System -  Dresser</title>
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
        <h1>Main Building</h1>
        <h3 class="ital" align="center">&copy; Isabel Molines</h3>
        <h2>NIGHTSTAND & LAMPS (6 points)</h2>
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
        
    for($i=26; $i<=27; $i++){
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

        <form action="bed.php" method="POST">
            <p><strong>All lights in room are working and plugged in. Lamps/shades & cables are clean.Presentation: </strong><br>
                <input type="radio" name="28" value="0" checked="checked" />  0
                <input type="radio" name="28" value="-2" /> -2 </p>
            <p><strong>Night stand clean, free dust of dust & good condition magazines present & in good condition: </strong><br>
                <input type="radio" name="29" value="0" checked="checked" />  0
                <input type="radio" name="29" value="-2" /> -2 </p>
            <p><strong>Clock radio is OFF, plugged and time is correct& time is correct/linen card: </strong><br>
                <input type="radio" name="30" value="0" checked="checked" />  0
                <input type="radio" name="30" value="-1" /> -1 </p>
            <p><strong>Phone, speaker clean and cord is wrapped properly: </strong><br>
                <input type="radio" name="31" value="0" checked="checked" />  0
                <input type="radio" name="31" value="-1" /> -1 </p>
            <p><input type="submit" value="Proceed to Bed" /></p>
        </form>
    </body>
</html>
