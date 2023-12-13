<?php
require_once("/home/agroot2/data/connect.php");

// Import our prepared statements.
require_once("../private/prepared.php");



// Since we will have many files sharing this header, lets use a variable for the title

$title = "Delete Beer";
include("includes/header.php") ;

$beer_id = isset($_GET['$beer_id']) ? $_GET['beer_id'] :"";

if(isset($_GET['beer_id'])){
    $beer_id = $_GET['beer_id'];
}elseif(isset($_POST['beer_id'])){
    $beer_id = $_POST['beer_id'];
}else{
    $beer_id = "";
}

if(isset($beer_id)){
    if(is_numeric($beer_id) && $beer_id > 0){

        $beer = select_beer_by_id($beer_id);
        if($beer){
            $beer_name = $beer['beer_name'];
        }else{
            echo'<p>No record of that</p>';
        }
        
    
    
    }
}
if(isset($_POST['submit'])){
delete_beer($beer_id);
header("Location:edit.php");
}
?>
<main>
<h2>Delete: <?php echo $beer_name; ?> </h2>
<form action="<?php $_SERVER['REQUEST_URI']; ?>" method="post">
    <input type="submit" value="Delete" name="submit" class="btn btn-danger">
</form>


</main>
<?php
include("includes/footer.php") ;
?>