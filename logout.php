<?php
/**
 * Created by PhpStorm.
 * User: Isabel
 * Date: 9/28/2015
 * Time: 4:31 PM
 */
    require_once 'header.php';
//echo "user = " . $user . "<br>";
//echo "loggedin = " . $loggedin . "<br><br>";
//echo "sessionuser = " . $_SESSION['user'] . "<br>";

    if(isset($_SESSION['user'])) {
//echo "user = " . $_SESSION['user'] . "<br>";

        destroySession();
        echo "<div class='main'>You have been logged out. Please " .
        "<a href='newhome.php'>click here</a> to refresh the screen.";
    }
    else echo "<div class='main'><br>" .
        "You cannot log out because you are not logged in";
?>
        <br><br></div>
    </body>
</html>
