<?php
/**
 * Created by PhpStorm.
 * User: Isabel
 * Date: 9/25/2015
 * Time: 10:53 AM
 */
	require_once 'login.php';
	$connection = new mysqli($hn, $un, $pw, $db);

	if ($connection->connect_error) die($connection->connect_error);
//	else echo "Connected to database <br>";

    require_once 'functions.php';

//echo "user: " . $user . "<br>";
//echo "password 1: " . $pass . "<br>";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1">
        <meta charset="UTF-8">
        <title>Log in</title>
        <style type="text/css">
    body.back {background: lightblue}
            h1 {text-align: center}
            h2 {text-align: center}
            h3.ital {font-style: italic}
            p {text-align: center}
		 body {
			width:500px;
			margin:20px auto;
			background:lightblue;
			border:2px solid #888;
			
		 }
		.fieldname {
			float:left;
			width:120px;
			font-family:verdana,sans-serif;
			font-size:12pt;
		}
		.taken, .error {
			color:red;
		}
        </style>
    </head>
    <body class="back">
        <h1>Computerized Inspection System</h1>
        <h3 class="ital" align="center">&copy; Isabel Molines</h3>
        <h2>Log in</h2>

        <?php
//echo "user: " . $user . "<br>";
        $error = $user = $pass = '';

        if (isset($_POST['user'])) {
            $user = sanitizeString($_POST['user']);
//echo "user: " . $user . "<br>";

            $pass = sanitizeString($_POST['pass']);
//echo "password 2: " . $pass . "<br>";
                $token = hash('ripemd128', "$salt1$pass$salt2");
//                echo "token: " . $token . "<br>";

/**
            if ($user == "" || $pass = "")
                $error = "Not all fields were entered<br><br>";
            else {
*/
	$salt1 = "qm&h*";
//echo "salt1: " . $salt1 . "<br>";

	$salt2 = "pg!@";
//echo "salt2: " . $salt2 . "<br>";
/**
                $token = hash('ripemd128', "kalahari");
                echo "token: " . $token . "<br>";
                $token = hash('ripemd128', "qm&h*kalaharipg!@");
                echo "token: " . $token . "<br>";

//echo "password 3: " . $pass . "<br>";
//$pass = 'kalahari';

                $token = hash('ripemd128', "$salt1$salt2");
                echo "token: " . $token . "<br>";
echo "password 4: " . $pass . "<br>";
                $token = hash('ripemd128', "$salt1$pass$salt2");
                echo "token: " . $token . "<br>";
*/
//            echo "password 4: " . $pass . "<br>";
            $token = hash('ripemd128', "$salt1$pass$salt2");
//            echo "token: " . $token . "<br>";
                $query = "SELECT username, password FROM users WHERE username= '$user' AND password ='$token'";
			$result = $connection->query($query);

                if ($result->num_rows == 0) {
                    $error = "<span class='error'>Username/Password invalid</span><br><br>";
                }
                else {
	   session_start();
                    $_SESSION['user'] = $user;
//echo "user = " . $user . "<br>";
//echo "sessionuser = " . $_SESSION['user'] . "<br>";

                    $_SESSION['pass'] = $pass;
                    die("You are now logged in. Please <a href='main.php'>".
                        "click here</a> to continue.<br><br>");
//                }
            }
        }
function sanitizeString($var) {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
}


echo <<<_END
    <form method='post' action='newhome.php'>$error
        <span class='fieldname'>Username</span>
        <input type='text' maxlength='16' name='user' value='$user'><br>
        <span class='fieldname'>Password</span>
        <input type='password' maxlength='16' name='pass' value='$pass'>
_END;

//$result->close();
$connection->close();

        ?>

        <br>
        <span class='fieldname'>&nbsp;</span>
        <input type='submit' value='Login'><br>
        </form><br></div>
    </body>