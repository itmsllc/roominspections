<?php
/**
 * Created by PhpStorm.
 * User: Isabel
 * Date: 9/28/2015
 * Time: 12:24 PM
 */
require_once 'header.php';
//echo "user = " . $user . "<br>";
//echo "sessionuser = " . $_SESSION['user'] . "<br>";

if(!$loggedin) die();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1">
        <meta charset="UTF-8">
        <title>Main Page</title>
        <style type="text/css">
            body {background: lightblue}
            h1 {text-align: center}
            h2 {text-align: center}
            h3.ital {font-style: italic}
	    ul {font-size:16pt; font-weight:bold}
	    li {font-size:14pt}
            p {text-align: center}
        </style>
    </head>
    <body>
        <h1>Computerized Inspection System</h1>
        <h3 class="ital" align="center">&copy; Isabel Molines</h3>
        <h2>Main Page</h2>
	<table align='center' width='300'>
		<tr>
			<td>
        			<ul>New Inspection<br><br>
            				<li><a href="index.php">Villas</a></li>
            				<li><a href="mb.php">Main Building</a></li>
				</ul>
				<br>
        			<ul>Reports<br><br>
            				<li><a href="grascores.php">GRA Scores</a></li>
            				<li><a href="ranking.php">GRA Ranking</a></li>
            				<li><a href="dailycount.php">Inspections To Date</a></li>

				</ul>
			</td>
		</tr>		
	</table>
<?php
//echo "user = " . $user . "<br>";
//echo "sessionuser = " . $_SESSION['user'] . "<br>";
?>
    
    </body>
</html>
