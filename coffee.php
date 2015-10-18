<?php
    require_once 'header.php';

    if(!$loggedin) die();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Housekeeping Inspection System -  Dresser</title>
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
        <h2>COFFEE SET-UP/KITCHEN (6 points)</h2>
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
        
    for($i=9; $i<=13; $i++){
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
        <form action="desk.php" method="POST">
            <p><strong>Ice bucket clean w/liner, 2 Clean glasses w/coasters: </strong><br>
                <input type="radio" name="14" value="0" checked="checked" />  0
                <input type="radio" name="14" value="-1" /> -1 </p>
            <p><strong>Set-up includes: 1 tray, 2 Napkins, 2 Stirs, 2 Cups w/lids, 2 Reg, 2 Dec. Coffee, 1 Grn Tea, 4 creamers, 4 of each sugar(Reg, Spl, Eq, S&L) arranged properly: </strong><br>
                <input type="radio" name="15" value="0" checked="checked" />  0
                <input type="radio" name="15" value="-2" /> -2 </p>
            <p><strong>Coffee maker, microwave clean and correct time: </strong><br>
                <input type="radio" name="16" value="0" checked="checked" />  0
                <input type="radio" name="16" value="-1" /> -1 </p>
            <p><strong>Counter top/drawers/cabinets cleaned properly: </strong><br>
                <input type="radio" name="17" value="0" checked="checked" />  0
                <input type="radio" name="17" value="-2" /> -2 </p>
            <p><input type="submit" value="Proceed to Desk, floor & walls" /></p>
        </form>
    </body>
</html>
