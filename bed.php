<?php
    require_once 'header.php';

    if(!$loggedin) die();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1">
        <meta charset="UTF-8">
        <title>Computerized Inspection System -  Bed</title>
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
        <h2>BED (11 points)</h2>
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
        
    for($i=28; $i<=31; $i++){
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
        <form action="bath.php" method="POST">
            <p><strong>Duvet hangs evenly on all sides, crisp & clean: </strong><br>
                <input type="radio" name="32" value="0" checked="checked" />  0
                <input type="radio" name="32" value="-2" /> -2 </p>
            <p><strong>Bed: Sheets are clean, crisp and tight. Bed skirt hang evenly: </strong><br>
                <input type="radio" name="33" value="0" checked="checked" />  0
                <input type="radio" name="33" value="-4" /> -4 </p>
             <p><strong>Feather pillows & decorative items clean, properly positioned on bed. BKFS menu in good condition: </strong><br>
                <input type="radio" name="34" value="0" checked="checked" />  0
                <input type="radio" name="34" value="-3" /> -3 </p>
            <p><strong>Around bed is clean; no debris or dust on headboard: </strong><br>
                <input type="radio" name="35" value="0" checked="checked" />  0
                <input type="radio" name="35" value="-2" /> -2 </p>
            <p><input type="submit" value="Proceed to Bathroom" /></p>
        </form>
    </body>
</html>
