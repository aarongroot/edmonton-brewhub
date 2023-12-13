<?php
// Select 
$select_statement = $connection->prepare("SELECT * FROM edmonton_beer");
// Select Specific Beer
$select_specific_statement = $connection->prepare("SELECT * FROM edmonton_beer WHERE beer_id = ?");

// Insert
$insert_statement = $connection->prepare("INSERT INTO edmonton_beer
(beer_name, brewery_name, brewery_location, style, abv, ibu, beer_color, img_file, description) Values(?,?,?,?,?,?,?,?,?)");

// Update
$update_statement = $connection->prepare("UPDATE edmonton_beer SET beer_name = ?, brewery_name = ?, brewery_location = ?, style = ?, abv = ?, ibu = ?, beer_color = ?,  description = ? WHERE beer_id = ? ");

// Delete
$delete_statement = $connection->prepare("DELETE FROM edmonton_beer WHERE beer_id = ?");


// Database error
function handle_database_error($statement) {
    global $connection;
    die("Error in" . $statement . "Error Details" . $connection->error);
}

function get_all_beers(){
    global $connection;
    global $select_statement;

    if(!$select_statement->execute()){
        handle_database_error("fetching cities");
    }
    $result = $select_statement->get_result();
    $beers = [];
    while($row = $result->fetch_assoc()){
        $beers[] = $row;
    }
    return $beers;
}

function insert_beer($beer_name, $brewery_name, $url, $style, $abv, $ibu, $beer_color, $filename, $description){


    global $connection;
    global $insert_statement;
    $insert_statement->bind_param("sssssiiss", $beer_name, $brewery_name, $url, $style, $abv, $ibu, $beer_color, $filename, $description);
    if(!$insert_statement->execute()){
     handle_database_error("inserting Beer");
    }
}


function createSquareImageCopy($file, $folder, $newWidth){
   
    //echo "$filename, $folder, $newWidth";
    //exit();

    $thumb_width = $newWidth;
    $thumb_height = $newWidth;// tweak this for ratio

    list($width, $height) = getimagesize($file);

    $original_aspect = $width / $height;
    $thumb_aspect = $thumb_width / $thumb_height;

    if($original_aspect >= $thumb_aspect) {
       // If image is wider than thumbnail (in aspect ratio sense)
       $new_height = $thumb_height;
       $new_width = $width / ($height / $thumb_height);
    } else {
       // If the thumbnail is wider than the image
       $new_width = $thumb_width;
       $new_height = $height / ($width / $thumb_width);
    }

    $source = imagecreatefromjpeg($file);
    $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

    // Resize and crop
    imagecopyresampled($thumb,
                       $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                       0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                       0, 0,
                       $new_width, $new_height,
                       $width, $height);
   
    $newFileName = $folder. "/" .basename($file);
    imagejpeg($thumb, $newFileName, 80);
}

function select_beer_by_id($beer_id){
    global $connection;
    global $select_specific_statement, $connection;
    $select_specific_statement->bind_param("i", $beer_id);

    if(!$select_specific_statement->execute()){
        handle_database_error("fetching beer");
    }
    $result = $select_specific_statement->get_result();
    $beer = $result->fetch_assoc();
    return $beer;
}

function update_beer($user_beer_name, $user_brewery_name, $user_url, $user_style, $user_abv, $user_ibu, $user_beer_color, $user_description, $beer_id){
    global $connection;
    global $update_statement;

    $update_statement->bind_param("sssssiisi", $user_beer_name, $user_brewery_name, $user_url, $user_style, $user_abv, $user_ibu, $user_beer_color, $user_description, $beer_id);

    $update_statement->execute();

    if(!$update_statement->execute()){
        handle_database_error("Updating Beer");
    }
}

function delete_beer($beer_id){
    global $connection;
    global $delete_statement;
    
    $delete_statement->bind_param("i", $beer_id);

    $delete_statement->execute();

    if(!$delete_statement->execute()){
        handle_database_error("Deleting Beer");
    }
}

?>