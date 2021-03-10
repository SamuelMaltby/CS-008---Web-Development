<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'],ENT_QUOTES,"UTF-8");

$path_parts = pathinfo($phpSelf);

$currentPage=  $path_parts['filename'];

$databaseName = 'SMALTBY_cs008-final';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$dbUserName = "smaltby_writer";
$dbPassword = "W1jkwPD6QfUlM3gB";

print '<!-- Make DB connection -->';
$pdo = new PDO($dsn, $dbUserName, $dbPassword);
?>


<!DOCTYPE HTML>
<html lang="en">

    <head>
        <title>Frequency Music Co.</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="S.K.M" content="Samuel Maltby">
        <meta name="Home" content="A wide array of information and reviews of all genres of music.">
        <link rel="stylesheet" href="css/custom.css?version=1.0" type="text/css">
        <link rel="stylesheet" href="finaltop.php">
        <style type="text/css"></style>
    </head>

    <?php
    print '<body id="' . $path_parts['filename'] . '">' . PHP_EOL;


    include ("finalheader.php");
    print PHP_EOL;
    include ("finalnav.php");
    print PHP_EOL;

    print "<!-- End of top.php -->";
    ?>