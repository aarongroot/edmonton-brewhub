<?php
session_start();
if (!isset($_SESSION['agafgdfsdghshfgshfghndnmrsegsfgsd'])){
    header("location:login.php");
}
require_once("/home/agroot2/data/connect.php");
$beer_id = "";

// Import our prepared statements.
require_once("../private/prepared.php");
$message = "";
$update_message ="";


// Since we will have many files sharing this header, lets use a variable for the title

$title = "Edit Edmonton Beers";
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

<section class="container">
        <h1 class="fw-light text-center mt-5">Update Existing Beer</h1>
        <p class="text-muted mb-5 text-center">To edit a Beer, Please select one from the list below and click "Edit". If you would like to delete a beer click "Delete"</p>
        <?php 
        if($message != ""): ?>
    <div class="alert alert-info">
            <?php echo $message; ?>
    </div>
    <?php endif; ?>
        <?php
     $beers = get_all_beers();
     if(count($beers)> 0){

         echo "\n <table class=\"table table-bordered table-hover\">";
         echo "\n\t<tr>";
         echo  "\n\t\t<th scope=\"col\">Name</th>";
         echo  "\n\t\t<th scope=\"col\">Brewery</th>";
         echo  "\n\t\t<th scope=\"col\">Edit?</th>";
         echo  "\n\t\t<th scope=\"col\">Delete?</th>";
         echo "\n\t</tr>";
         foreach($beers as $beer){
             extract($beer);
             echo  "\n\t\t<tr><td>$beer_name</td>";
             echo "<td>$brewery_name</td>";
             echo "<td><a href=\"update.php?beer_id=$beer_id\" class=\"btn btn-primary\">Edit</a></td>";
             echo "<td><a href=\"delete.php?beer_id=$beer_id\" class=\"btn btn-danger\">Delete</a></td>";
             echo "\n\t</tr>"; 
         }
         echo "\n</table>";
     }
        ?>
    </section>

<?php include("includes/footer.php"); ?>