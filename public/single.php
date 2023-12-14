<?php
require_once("/home/agroot2/data/connect.php");

require_once("../private/prepared.php");
session_start();

$beer_id = isset($_GET['beer_id']) ? $_GET['beer_id'] : "";
$beer = select_beer_by_id($beer_id);
$beer_name = $beer['beer_name'];
$img_file = $beer['img_file'];
$description = $beer['description'];
$beer_id = $beer['beer_id'];
$brewery_name = $beer['brewery_name'];
$brewery_location = $beer['brewery_location'];
$beer_style = $beer['style'];
$beer_abv = $beer['abv'];
$beer_ibu = $beer['ibu'];
$beer_color = $beer['beer_color'];
$title = $beer_name;

include("includes/header.php");
?>
<section>
    <div class="container single-beer">
        <div class="single-title">
            <?php echo "<img src=\"image600/$img_file\">" ?>
            <p>Description:</p> 
            <p><?php echo $description; ?></p>
        </div>
        <div class="single-info">
            <h2><?php echo $beer_name; ?></h2>
            <p>Beer Style: <b><?php echo $beer_style; ?></b></p>
            <p>ABV%: <b><?php echo $beer_abv; ?>%</b></p>
            <p>IBU: <b><?php echo $beer_ibu; ?></b></p>
            <p>Beer Color: <b><?php echo $beer_color; ?></b></p>
        </div>  
        <div class="single-brewery">
            <p>Find More Beers Created By:</p>
            <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode($brewery_name . '%'); ?>"><?php echo $brewery_name; ?></a>
            <iframe src="<?php echo $brewery_location; ?>" width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
        </div>
        
    </div>
   

</section>


<?php include("includes/footer.php"); ?>