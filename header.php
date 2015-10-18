<?php
/**
 * Created by PhpStorm.
 * User: Isabel
 * Date: 9/28/2015
 * Time: 4:50 PM
 */
    session_start();

    echo "<DOCTYPE html>\n<html><head>";

    require_once 'functions.php';

    $userstr = ' (Guest)';

    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
//echo "user = " . $user . "<br>";
        $loggedin = TRUE;
//echo "loggedin = " . $loggedin . "<br>";
        $userstr = " ('user')";
    }
    else $loggedin = FALSE;

?>