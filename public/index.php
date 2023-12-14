<?php
require_once("/home/agroot2/data/connect.php");
require_once("../private/prepared.php");
session_start();

$breweries = [
    41 => 'Alley Kat Brewing Company',
    43 => 'Analog Brewing Company',
    38 => 'Bent Stick Brewing Co.',
    34 => 'Blind Enthusiasm Brewing Company',
    46 => 'Campio Brewing Co.',
    60 => 'The Growlery Beer Co.',
    48 => 'Irrational Brewing company',
    50 => 'Omen Brewing',
    53 => 'Sea Change Brewing Co.',
    56 => 'SYC Brewing Co.',
    62 => 'Town Square Brewing Co.'
];

$title = "Edmonton Beers";
include("includes/header.php");
?>

<main>
    <div class="container">
        <h2>Welcome to Edmonton Brewhub!</h2>
        <p>All of these breweries below are in Edmonton! Click on a logo if you want to find beers made by the breweries or just check out all our beers in the beer tab. This was a project created for a PHP class where we had to input a variety of different inputs so that we could filter by each. These inputs also include images. These images have been resized so that we can use the images in different capacities.</p>
    </div>

    <ul class="results">
        <?php foreach ($breweries as $beerId => $breweryName): ?>
            <li class="result">
                <a href="filter.php?displayby=<?php echo urlencode('brewery_name'); ?>&displayvalue=<?php echo urlencode($breweryName . '%'); ?>">
                    <img src="img/<?php $beer = select_beer_by_id($beerId); echo "$beer[brewery_logo]"; ?>" width="500" height="500" alt="">
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php include("includes/footer.php"); ?>
