<?php
    require_once 'header.php';

    if(!$loggedin) die();
?>
<!DOCTYPE html>
<html>
    <head>
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
        <h2>BATHROOM (35 points)</h2>
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
        
    for($i=32; $i<=35; $i++){
        //echo "$i ".$i." points off: ".$points."<br>";
        //$points[$i] = $_POST["$i"];
        //echo "Item ".$i." points off: ".$_POST[$i]."<br>";
        $query = "INSERT INTO inspection (session, room_number, clean_date, item_id, points_off) VALUES ('$session', '$room', '$cleandate', '$i', $_POST[$i])";
//echo $sql;

$result = $conn->query($query);
if(!$result) die($conn->error);
    }          
//$result->close();
$conn->close();
               
        ?>
        <form action="summarymb.php" method="POST">
            <p><strong>Bathroom Door clean and working properly: </strong><br>
                <input type="radio" name="36" value="0" checked="checked" />  0
                <input type="radio" name="36" value="-2" /> -2 </p>
            <p><strong>Bathroom and hallway floor clean & NO HAIR: </strong><br>
                <input type="radio" name="37" value="0" checked="checked" />  0
                <input type="radio" name="37" value="-4" /> -4 </p>
            <p><strong>Tub/Shower: Tile are clean, no marks/mildew/hair. Vent is clean, shower head free of calcium: </strong><br>
                <input type="radio" name="38" value="0" checked="checked" />  0
                <input type="radio" name="38" value="-4" /> -4 </p>
             <p><strong>Shower curtain & liner are clean, drawn to door, liner inside tub, curtain out. Hooks are closed. Shower rod polished. Drain is left open chrome polished. Clean bathmat with unopened body soap on it: </strong><br>
                <input type="radio" name="39" value="0" checked="checked" />  0
                <input type="radio" name="39" value="-3" /> -3 </p>
            <p><strong>Vanity counter & surrounding areas including the walls, clean, no dust, hair, toothpaste residue. Chrome polished. Mirror/Makeup mirror are clean, good condition. Toilet paper holder clean in good condition: </strong><br>
                <input type="radio" name="40" value="0" checked="checked" />  0
                <input type="radio" name="40" value="-2" /> -2 </p>
            <p><strong>Vanity Tray clean, amenities are properly displayed. Kleenex and toilet tissue are pointed and at proper level. Cards & Rugs clean present & in good condition: </strong><br>
                <input type="radio" name="41" value="0" checked="checked" />  0
                <input type="radio" name="41" value="-2" /> -2 </p>
             <p><strong>Sink clean, drain closed, no hair, chrome polished: </strong><br>
                <input type="radio" name="42" value="0" checked="checked" />  0
                <input type="radio" name="42" value="-3" /> -3 </p>
            <p><strong>Glasses are clean with coasters properly displayed/Hair dryer in good condition in a clean bag: </strong><br>
                <input type="radio" name="43" value="0" checked="checked" />  0
                <input type="radio" name="43" value="-2" /> -2 </p>
            <p><strong>Towels in correct counts clean & presentable: </strong><br>
                <input type="radio" name="44" value="0" checked="checked" />  0
                <input type="radio" name="44" value="-3" /> -3 </p>
            <p><strong>Toilet bowl and surrounding area are clean. Extra roll on tank with wrap: </strong><br>
                <input type="radio" name="45" value="0" checked="checked" />  0
                <input type="radio" name="45" value="-4" /> -4 </p>
            <p><strong>Trash can is clean, polished with a trash bag in it: </strong><br>
                <input type="radio" name="46" value="0" checked="checked" />  0
                <input type="radio" name="46" value="-2" /> -2 </p>
            <p><strong>Amenities are replaced at 75% use or less (Stay Over): </strong><br>
                <input type="radio" name="47" value="0" checked="checked" />  0
                <input type="radio" name="47" value="-2" /> -2 </p>
            <p><strong>Guest Toiletries are arranged on washcloth (Stay Over): </strong><br>
                <input type="radio" name="48" value="0" checked="checked" />  0
                <input type="radio" name="48" value="-2" /> -2 </p>
          <p><input type="submit" value="Proceed to Summary2" /></p>
        </form>
    </body>
</html>
