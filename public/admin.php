<?php
session_start();
if (!isset($_SESSION['agafgdfsdghshfgshfghndnmrsegsfgsd'])){
    header("location:login.php");
  
}
$attraction_id = "";


$title = "Edmonton BrewHub - Admin Area";
include("includes/header.php");
?>
<div class="container text-center">
    <h1>Welcome Admin!</h1>
    <p>Would you like to make a few changes?</p>
</div>
<div>
<nav class="mb-5 text-center">
            <a href="add.php" class="button">Add</a>
            <a href="edit.php" class="button">Edit</a>
            <a href="logout.php" class="button">Logout</a>
        </nav>
</div>


<?php include("includes/footer.php"); ?>