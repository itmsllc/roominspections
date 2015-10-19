<?php
    require_once 'header.php';
//echo "user = " . $user . "<br>";
//echo "loggedin = " . $loggedin . "<br>";

    if(!$loggedin) die();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1">
        <meta charset="UTF-8">
        <title>Entrance</title>
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
        <h2>Entrance Inspection (6 points)</h2>
        <?php
        //session_start();
        $session = session_id();
        $inspdate= $_POST["inspdate"];
        $_SESSION["inspdate"] = $inspdate;
        $room = $_POST["room"];
//        echo "Room number: ".$room."<br>";
        $_SESSION["room"] = $room;
//        echo "Room number: ".$_SESSION["room"]."<br>";
        $status = $_POST["status"];
        //echo "Room status: ".$status."<br>";
        $_SESSION["status"] = $status;
        $cleandate = $_POST["cleandate"];
//        echo $cleandate."<br>";
        $_SESSION["cleandate"] = $cleandate;

        $manager = $_POST["manager"];
        //echo "Manager: ".$manager."<br>";
        $_SESSION["manager"] = $manager;
        $supervisor = $_POST["supervisor"];
        //echo "Supervisor: ".$supervisor."<br>";
        $_SESSION["supervisor"] = $supervisor;
        $gra = $_POST["gra"];
        //echo "GRA: ".$gra."<br>";
        $_SESSION["gra"] = $gra;
        //echo "Session: ".$session."<br><br>";
        
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "INSERT INTO inspections (insp_date, room_number, room_status, clean_date, manager, supervisor, gra, session) VALUES ('$inspdate', $room, '$status', '$cleandate', '$manager', '$supervisor', '$gra', '$session')";

//echo $query;

$result = $conn->query($query);

//echo "<br> OK, so far - 1";


if(!$result) die($conn->error);
//echo "<br> OK, so far - 2";


//$result->close();

//echo "<br> OK, so far - 3";

$conn->close();
//echo "<br> OK, so far - 4";
       
        
        ?>
        <form action="kitchen.php" method="POST">
            <p><strong>Door/door frame clean and cob-web-free: </strong><br>
                <input type="radio" name="1" value="0" checked="checked" />  0
                <input type="radio" name="1" value="-2" /> -2
            <p><strong>Entrance floor, tiles, baseboards clean: </strong><br>
                <input type="radio" name="2" value="0" checked="checked" />  0
                <input type="radio" name="2" value="-2" /> -2
            <p><strong>Foyer clean, free of dust/stains: </strong><br>
                <input type="radio" name="3" value="0" checked="checked" />  0
                <input type="radio" name="3" value="-2" /> -2
            <p><input type="submit" value="Proceed to Kitchen" /></p>
        </form>
         <h3 class="ital" align="center">&copy; 2015 Isabel Molines</h3>
   </body>
</html>
