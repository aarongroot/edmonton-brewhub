<?php
require_once("/home/agroot2/data/connect.php");

// Import our prepared statements.
require_once("../private/prepared.php");
session_start();

// Since we will have many files sharing this header, lets use a variable for the title
$attraction_id = "";
$title = "Edmonton Attractions";
include("includes/header.php");

?>







<?php include("includes/footer.php"); ?>