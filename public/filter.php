<?php
require_once("/home/agroot2/data/connect.php");

// Import our prepared statements.
require_once("../private/prepared.php");
session_start();


$beer_id = "";
$displayby = isset($_GET['displayby']) ? $_GET['displayby'] : "";
$displayvalue = isset($_GET['displayvalue']) ? $_GET['displayvalue'] : "";
$title = "Edmonton Beers";
$msg = "All Edmonton Beers"; 
$brewery_name = "";
include("includes/header.php");
$max = isset($_GET['max']) ? $_GET['max'] : "";
$min = isset($_GET['min']) ? $_GET['min'] : "";
$beer_search = isset($_GET['beer_search']) ? $_GET['beer_search'] : '';

?>


    <Main>
    <div class="container">
        <div class="container filter-flex">
        <?php
            if ($displayby == 'brewery_name' && !empty($displayvalue)) {
                $msg = "All Beer Made By: <b> " . htmlspecialchars(urldecode($displayvalue)) . "</b>";
            }
            if ($displayby == 'abv' && !empty($max) && !empty($min)) {
                $msg = "All Beer Between: <b> $min% - $max% abv</b>";
            }
            if ($displayby == 'style' && !empty($displayvalue)) {
                $msg = "Beer Style: <b> " . htmlspecialchars(urldecode($displayvalue)) . "</b>";
            }
            if(isset($_GET['submit'])){
                $msg = "Search Results for: <b>$beer_search</b>";
            }
            ?>
                <h2 class="w-100"><?php echo $msg; ?></h2>
            <div class="flex-container">
                <?php
                $beers = get_all_beers();

                foreach ($beers as $beer) {
                    $beer_name = $beer['beer_name'];
                    $img_file = $beer['img_file'];
                    $description = $beer['description'];
                    $beer_id = $beer['beer_id'];
                    $brewery_name = $beer['brewery_name'];

                    echo "<div class=\"beer\">";
                    echo "\n <img src=\"thumbs200/$img_file\">";
                    echo "<div class=\"beer-content\">";
                    echo "\n <h3>$beer_name</h3>";
                    echo "\n <p>$description</p>";
                    echo "<a href=\"single.php?beer_id=$beer_id\" class=\"card-button\"> Click to find out more! </a> ";
                    echo "</div>";
                    echo "</div>";
                }
                ?>

                </div>
                <aside>
                        <div class="filters">
                                <h2 class="text-right">Search</h2>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
                                        <div class="mb-3">
                                                <label for="beer_search" class="form-label">Search Beers</label>
                                                <input type="text" class="form-control" id="beer_search" name="beer_search" value="">
                                        </div>
                                        <div class="mb-3">
                                                <input type="submit" id="submit" name="submit" value="Search Beers" class="button search-btn">
                                        </div>
                                </form>
                        <h2>Filters by Category</h2>
                        <div class="flex">
                                <h3>Breweries</h3>
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('Alley Kat Brewing Company'); ?>">Alley Kat Brewing Company</a> 
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('Analog Brewing Company'); ?>">Analog Brewing Company</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('Bent Stick Brewing Co.'); ?>">Bent Stick brewing Co.</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('Blind Enthusiasm Brewing Company'); ?>">Blind Enthusiasm Brewing Company</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('Campio Brewing Co.'); ?>">Campio Brewing Company</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('The Growlery Beer Co.'); ?>">The Growlery Brewing Co.</a>       
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('Irrational Brewing company'); ?>">Irrational Brewing Company</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('Omen Brewing'); ?>">Omen Brewing</a>  
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('Sea Change Brewing Co.'); ?>">Sea Change Brewing Co.</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('SYC Brewing Co.'); ?>">SYC Brewing Co.</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode('Town Square Brewing Co.'); ?>">Town Square Brewing Co.</a> 
                                
                                <h3>Alcohol Percent</h3>
                                <a href="filter.php?displayby=<?php echo urlencode('abv'); ?>&min=0.00&max=4.00"> < 4% </a>
                                <a href="filter.php?displayby=<?php echo urlencode('abv'); ?>&min=4.00&max=5.00">4-5%</a> 
                                <a href="filter.php?displayby=<?php echo urlencode('abv'); ?>&min=5.00&max=6.00">5-6%</a>
                                <a href="filter.php?displayby=<?php echo urlencode('abv'); ?>&min=6.00&max=7.00">6-7%</a>
                                <a href="filter.php?displayby=<?php echo urlencode('abv'); ?>&min=7.00&max=20.00">7%+</a>

                                <h3>Beer Styles</h3>
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Pale Lager'); ?>">Pale Lager</a> 
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Dark Lager'); ?>">Dark Lager</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Pilsner'); ?>">Pilsner</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Wheat Beer'); ?>">Wheat Beer</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Pale Ale'); ?>">Pale Ale</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('India Pale Ale'); ?>">India Pale Ale</a>       
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Sour'); ?>">Sour</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Porter'); ?>">Porter</a>  
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Stout'); ?>">Stout</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Saison'); ?>">Saison</a>    
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Cream Ale'); ?>">Cream Ale</a> 
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Barrel Aged'); ?>">Barrel Aged</a>
                                <a href="filter.php?displayby=<?php echo urlencode('style'); ?>&displayvalue=<?php echo urlencode('Barrel Fermented'); ?>">Barrel Fermented</a>
                        
                        
                        
                        </div>
                </div>
                        
                </aside>
        </div>
</Main>






<?php include("includes/footer.php"); ?>