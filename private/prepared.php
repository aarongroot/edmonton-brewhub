<?php

// Insert
$insert_statement = $connection->prepare("INSERT INTO edmonton_beer
(beer_name, brewery_name, brewery_location, style, abv, ibu, beer_color, img_file, description) Values(?,?,?,?,?,?,?,?,?)");


// Database error
function handle_database_error($statement) {
    global $connection;
    die("Error in" . $statement . "Error Details" . $connection->error);
}

function insert_beer($beer_name, $brewery_name, $url, $style, $abv, $ibu, $beer_color, $filename, $description){


    global $connection;
    global $insert_statement;
    $insert_statement->bind_param("ssssiiiss", $beer_name, $brewery_name, $url, $style, $abv, $ibu, $beer_color, $filename, $description);
    if(!$insert_statement->execute()){
     handle_database_error("inserting Beer");
    }
}


function createImageCopy($file, $folder, $newWidth, $showThumb = 1){
    list($width, $height) = getimagesize($file);
    $imgRatio = $width/$height;
    $newHeight = $newWidth * $imgRatio;

    $thumb = imagecreatetruecolor($newWidth, $newHeight);
    $source = imagecreatefromjpeg($file);

    imagecopyresampled($thumb, $source, 0,0,0,0, $newWidth, $newHeight, $width, $height);

    $fileName = $folder . $_FILES['myfile']['name'];

    imagejpeg($thumb, $fileName, 80); //80 here is for the jpg quality

    imagedestroy($thumb);
    imagedestroy($source);
}

?>