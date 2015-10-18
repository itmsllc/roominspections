<!DOCTYPE html>
<html>
    <head>
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
        <h2>Housekeeping Dept.<br>Inspection System</h2>
        <h1>Main Building</h1>
        <h3 class="ital" align="center">&copy; Isabel Molines</h3>
        <h2>CART SET UP (3 points)</h2>
        <?php
        session_start();
        $session = session_id();
        $inspdate= $_POST["inspdate"];
        $_SESSION["inspdate"] = $inspdate;
        $room = $_POST["room"];
        //echo "Room number: ".$room."<br>";
        $_SESSION["room"] = $room;
        $status = $_POST["status"];
        //echo "Room status: ".$status."<br>";
        $_SESSION["status"] = $status;
        $cleandate = $_POST["cleandate"];
        //echo $cleandate."<br>";
        $_SESSION["cleandate"] = $cleandate;
        $date_array = explode("-", $cleandate);
        //echo $date_array[0]."<br>";
        //echo $date_array[1]."<br>";
        //echo $date_array[2]."<br>";
        global $supervisor;
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
if(!$result) die($conn->error);
        
//$result->close();
$conn->close();
       
        
        ?>
        <form action="entrance_closet.php" method="POST">
            <p><strong>Cart arranged neatly, logical order and not overloaded: </strong><br>
                <input type="radio" name="1" value="0" checked="checked" />  0
                <input type="radio" name="1" value="-3" /> -3
            <p><input type="submit" value="Proceed to Entrance/Closet Area" /></p>
        </form>
    </body>
</html>
