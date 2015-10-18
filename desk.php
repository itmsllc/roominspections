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
        <h2>DESK, FLOOR & WALLS (14 points)</h2>
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
        
    for($i=14; $i<=17; $i++){
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
        <form action="window.php" method="POST">
             <p><strong>Desk top, glass, drawer clean/ compendium, paperwork, bible clean & in good condition, internet cable. Presentation: </strong><br>
                <input type="radio" name="18" value="0" checked="checked" />  0
                <input type="radio" name="18" value="-2" /> -2 </p>
            <p><strong>Phone clean, cord wrapped around,/note pad & pen: </strong><br>
                <input type="radio" name="19" value="0" checked="checked" />  0
                <input type="radio" name="19" value="-1" /> -1 </p>
            <p><strong>Trash can is clean with a trash bag on it: </strong><br>
                <input type="radio" name="20" value="0" checked="checked" />  0
                <input type="radio" name="20" value="-2" /> -2 </p>
            <p><strong>Sofa/chairs/sofa bed arranged properly, no crumbs: </strong><br>
                <input type="radio" name="21" value="0" checked="checked" />  0
                <input type="radio" name="21" value="-2" /> -2 </p>
           <p><strong>Carpet is stain free and vacuumed. Edges clean: </strong><br>
                <input type="radio" name="22" value="0" checked="checked" />  0
                <input type="radio" name="22" value="-3" /> -3 </p>
           <p><strong>Walls & baseboards are clean and dust free: </strong><br>
                <input type="radio" name="23" value="0" checked="checked" />  0
                <input type="radio" name="23" value="-2" /> -2 </p>
            <p><strong>Pictures, mirror, wall hangings/décor is clean: </strong><br>
                <input type="radio" name="24" value="0" checked="checked" />  0
                <input type="radio" name="24" value="-1" /> -1 </p>
            <p><strong>A/C is set to 68 F & A/C panel & vent clean: </strong><br>
                <input type="radio" name="25" value="0" checked="checked" />  0
                <input type="radio" name="25" value="-1" /> -1 </p>
            <p><input type="submit" value="Proceed to Window" /></p>
        </form>
    </body>
</html>
