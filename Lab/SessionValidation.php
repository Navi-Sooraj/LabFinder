<?php
session_start();
if($_SESSION['lid'] == "")
{
    header("location:../Guest/Login.php");
}
?>