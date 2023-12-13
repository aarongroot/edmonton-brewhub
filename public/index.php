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
<main>
  <h2>Welcome to Edmonton Brewhub!</h2>
  <p>All of these breweries below are in Edmonton! Click on a logo if you want to find beers made by the breweries are just check out all our beers in the beer tab.</p>
  <ul class="results">
  <li class="result">
    <a href="#"><img src="img/alley-kat.png" width="500" height="500" alt=""></a>
  </li>
  <li class="result">
    <a href="#"><img src="img/analog.jpeg" width="500" height="500" alt=""></a>
  </li>
  <li class="result">
    <a href="#"><img src="img/bentstick.webp" width="500" height="500" alt=""></a>
  </li>
  <li class="result">
    <a href="#"><img src="img/blind-enthusiasm.png" width="500" height="500" alt=""></a>
  </li>
  <li class="result">
    <a href="#"><img src="img/campio.png" width="500" height="500" alt=""></a>
  </li>
  <li class="result">
    <a href="#"><img src="img/growlery.png" width="500" height="500" alt=""></a>
  </li>
  <li class="result">
    <a href="#"><img src="img/irrational.webp" width="500" height="500" alt=""></a>
  </li>
  <li class="result">
    <a href="#"><img src="img/omen.jpg" width="500" height="500" alt=""></a>
  </li>
  <li class="result">
    <a href="#"><img src="img/sea-change.png" width="500" height="500" alt=""></a>
  </li>
  <li class="result">
    <a href="#"><img src="img/syc.png" width="500" height="500" alt=""></a>
  </li>
  <li class="result">
    <a href="#"><img src="img/town-square.jpg" width="500" height="500" alt=""></a>
  </li>
</ul>
</main>



<?php include("includes/footer.php"); ?>