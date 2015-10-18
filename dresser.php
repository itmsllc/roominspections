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
        <h2>DRESSER (7 points)</h2>
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
        
    for($i=2; $i<=8; $i++){
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
        <form action="coffee.php" method="POST">
            <p><strong>Top, behind, around free of dust & trash/ 3 water with price tags in good condition: </strong><br>
                <input type="radio" name="9" value="0" checked="checked" />  0
                <input type="radio" name="9" value="-1" /> -1 </p>
            <p><strong>Drawers clean free of debris/shoe shine sleeve & bag in good condition/Fridge clean & working: </strong><br>
                <input type="radio" name="10" value="0" checked="checked" />  0
                <input type="radio" name="10" value="-3" /> -3 </p>
            <p><strong>TV working, clean, centered, remote clean & on place: </strong><br>
                <input type="radio" name="11" value="0" checked="checked" />  0
                <input type="radio" name="11" value="-1" /> -1 </p>
            <p><strong>Safe is open and clean: </strong><br>
                <input type="radio" name="12" value="0" checked="checked" />  0
                <input type="radio" name="12" value="-1" /> -1 </p>
            <p><strong>Guest clothing on floor is folded, shoes paired (Stay Over): </strong><br>
                <input type="radio" name="13" value="0" checked="checked" />  0
                <input type="radio" name="13" value="-2" /> -2 </p>
            <p><input type="submit" value="Proceed to Coffee Set-up/Kitchen" /></p>
        </form>
    </body>
</html>
