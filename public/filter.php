<?php
require_once("/home/agroot2/data/connect.php");

// Import our prepared statements.
require_once("../private/prepared.php");
session_start();

// Since we will have many files sharing this header, lets use a variable for the title
$attraction_id = "";
$title = "Edmonton Beers";
include("includes/header.php");

?>

<h1 class="container">Edmonton Beers</h1>
<Main>
        <div class="container">

       
                <div class="flex-container">

        
        <?php

         $beers = get_all_beers();
         $beers = array_reverse($beers);
         foreach($beers as $beer){
            $beer_name = $beer['beer_name'];
            $brewery_name = $beer['brewery_name'];
            $brewery_location = $beer['brewery_location'];
            $style = $beer['style'];
            $abv = $beer['abv'];
            $ibu = $beer['ibu'];
            $beer_color = $beer['beer_color'];
            $img_file = $beer['img_file'];
            $description = $beer['description'];
            $beer_id = $beer['beer_id'];

            echo   "<div class = \"beer\">";
            echo "\n <img src=\"thumbs200/$img_file\">"; 
            echo "<div class=\"beer-content\">";
            echo "\n <h3>$beer_name</h3>";
            echo "\n <p>$description</p>"; 
            echo "<a href=\"single.php?beer_id=$beer_id\" class=\"button\"> Click to find out more! </a> ";
            echo "</div>";
            echo "</div>";
            }

                               
                    ?>
                </div>
        </div>
</Main>






<?php include("includes/footer.php"); ?>