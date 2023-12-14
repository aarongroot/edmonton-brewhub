<?php
session_start();
if (!isset($_SESSION['agafgdfsdghshfgshfghndnmrsegsfgsd'])){
    header("location:login.php");
}
require_once("/home/agroot2/data/connect.php");
$beer_id = "";

// Import our prepared statements.
require_once("../private/prepared.php");

$beer_name = "";
$brewery_name = "";
$url = "";
$style = "";
$abv = "";
$ibu = "";
$beer_color = "";
$description = "";
$filename =  "";



$title = "Add New Edmonton Beers";
include("includes/header.php");
$cost="";
$valid = 1;
if(isset($_POST['submit'])) {
    $message="";

    extract($_POST);

    $do_i_proceed = True;
    // validate Name
    $beer_name= filter_var($beer_name, FILTER_SANITIZE_STRING);
    if((strlen(trim($beer_name)) < 2) || (strlen($beer_name) > 40)) {
        $do_i_proceed = False;
        $message .= "<p> Please enter a Beer Name that is between 2-40 characters</p>";
    }

    // validate Brewery Name
    $brewery_name = filter_var($brewery_name, FILTER_SANITIZE_STRING);
    if(($brewery_name) == 'Select Brewery') {
        $do_i_proceed = False;
        $message .= "Please select a Brewery";
    }

    // validate Url
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if((strlen(trim($url)) < 3) || (strlen($url) > 350)) {
        $do_i_proceed = False;
        $message .= "<p> Please enter a url that is between 3-350 characters</p>";
    }

    // validate Beer Style
    $style = filter_var($style, FILTER_SANITIZE_STRING);
    if(($style) == 'Select Beer Style') {
        $do_i_proceed = False;
        $message .= "Please select a Beer Style";
    }

    // validate Abv
    $abv= filter_var($abv, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if(((trim($abv)) < 0) || (trim($abv) > 20)) {
        $do_i_proceed = False;
        $message .= "<p> Please Enter an ABV between 0-20 with no % </p>";
    }

    $ibu= filter_var($ibu, FILTER_SANITIZE_NUMBER_INT);
    if(((trim($ibu)) < 0) || (trim($ibu) > 200)) {
        $do_i_proceed = False;
        $message .= "<p> Please enter a IBU that is between 0-200</p>";
    }

    $beer_color= filter_var($beer_color, FILTER_SANITIZE_NUMBER_INT);
    if(((trim($beer_color)) < 0) || (trim($beer_color) > 40)) {
        $do_i_proceed = False;
        $message .= "<p> Please enter a Beer Color that is between 0-40</p>";
    }

    $description= filter_var($description, FILTER_SANITIZE_STRING);
    if((strlen(trim($description)) < 3) || (strlen($description) > 200)) {
        $do_i_proceed = False;
        $message .= "<p> Please enter a description that is between 3-200 characters</p>";
    }

// Image validation

        // Validation 

        // type - only jpg and PNG

        $allowedImages = ['image/jpeg', 'image/jpg'];

        if ($_FILES['myfile']['error'] === UPLOAD_ERR_OK) {
            
            $fileType = $_FILES['myfile']['type'];

            $fileExtension = pathinfo($_FILES['myfile']['name'], PATHINFO_EXTENSION);
        
            if (in_array($fileType, $allowedImages) && in_array($fileExtension, ['jpg', 'jpeg'])) {
                $valid = 1;
            } else {
                $valid = 0;
                $message .= "<p>Invalid file type. Needs to be jpg, jpeg.</p>";
            }
        } else {
            $valid = 0;
            $message .= "<p>File upload failed</p>";
        }

        if($_FILES['myfile']['size'] > (5 * 1024 * 1024)){
            $valid= 0;
            $message .= '<p>File is too Large, must be under 5MB';
        }

    // SUCCESS
    if($valid == 1){
        if(move_uploaded_file($_FILES['myfile']['tmp_name'],'uploadedfiles/' . $_FILES['myfile']['name'])){
            $thisFile = "uploadedfiles/" . $_FILES['myfile']['name'];
            $thisFolder = "thumbs200/";
            $thisWidth = "200";


            // createImageCopy($thisFile, $thisFolder, $thisWidth, 1);
            createSquareImageCopy($thisFile, $thisFolder, $thisWidth);



            $thisFolder = "image600/";
            $thisWidth = "600";
            // createImageCopy($thisFile, $thisFolder, $thisWidth, 0);
            createSquareImageCopy($thisFile, $thisFolder, $thisWidth);

            $filename =  $_FILES['myfile']['name'];
        }else{
            $message .= '<p>Image was not moved to folders';
        }
    }
       // if Validation has passed, then What?
       if(($do_i_proceed == True) && ($valid == 1)){
        insert_beer($beer_name, $brewery_name, $url, $style, $abv, $ibu, $beer_color, $filename, $description);
        $message = "<p class=\"text-success\">Beer added Successfully</p>";
        header("location: add.php");
        
     }else{
         $message .= "<p>There was a problem: " . "$connection->error" . "</p>";
     }
}
?>
<div class="container">
    <div class="text-center">
        <h2>Add A New Beer</h2>
        <p>To add a beer to my database, simply fill out the form below and hit "Add Beer".</p>
    </div>
<div>
        <nav class="mb-5 text-center">
            <a href="add.php" class="button">Add</a>
            <a href="edit.php" class="button">Edit</a>
            <a href="logout.php" class="button">Logout</a>
        </nav>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<?php
    if(isset($message)):?>
        <div class="message text-danger">
            <?php echo $message;?>
        </div>
<?php endif;?>
    <div class="mb-3">
        <label for="beer_name" class="form-label">Beer Name:</label>
        <input type="text" name="beer_name" id="beer_name" class="form-control" value="<?php if(isset($_POST['beer_name'])) echo $_POST['beer_name']; ?>">
    </div>
    <div class="mb-3">
                    <label for="brewery_name" class="form-label">Brewery Name</label>
                    <select name="brewery_name" id="brewery_name" class="form-select form-select">
                        <?php 
                            $brewery_names = ['Select Brewery' => 'Select Brewery',
                            'Alley Kat Brewing Company' => 'Alley Kat Brewing Company',
                            'Analog Brewing Company' => 'Analog Brewing Company',
                            'Bent Stick Brewing Co.' => 'Bent Stick Brewing Co.',
                            'Blind Enthusiasm Brewing Company' => 'Blind Enthusiasm Brewing Company',
                            'Campio Brewing Co.' => 'Campio Brewing Co.',
                            'Irrational Brewing company' => 'Irrational Brewing company',
                            'Omen Brewing' => 'Omen Brewing',
                            'Sea Change Brewing Co.' => 'Sea Change Brewing Co.',
                            'SYC Brewing Co.' => 'SYC Brewing Co.',
                            'The Growlery Beer Co.' => 'The Growlery Beer Co.',
                            'Town Square Brewing Co.' => 'Town Square Brewing Co.'
                            ];

                            foreach($brewery_names as $key => $value) {
                                $selected = isset($_POST['brewery_name']) && $_POST['brewery_name'] == $key ?'selected':'';
                                echo "\n<option value=\"$key\" $selected>$value</option>";
                            }
                        ?>
                    </select> 
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">Embed Map URL</label>
                    <input type="text" name="url" id="url" class="form-control" value="<?php if(isset($_POST['url'])) echo $_POST['url']; ?>" >
                </div>
                    <div class="mb-3">
                        <label for="style" class="style">Beer Style</label>
                        <select name="style" id="style" class="form-select">
                        <?php 
                            $beer_styles = ['Select Beer Style' => 'Select Beer Style',
                            'Pale Lager' => 'Pale Lager',
                            'Dark Lager' => 'Dark Lager',
                            'Pilsner' => 'Pilsner',
                            'Wheat Beer' => 'Wheat Beer',
                            'Pale Ale' => 'Pale Ale',
                            'India Pale Ale' => 'India Pale Ale',
                            'Sour' => 'Sour',
                            'Porter' => 'Porter',
                            'Stout' => 'Stout',
                            'Saison' => 'Saison',
                            'Cream Ale' => 'Cream Ale',
                            'Barrel Aged' => 'Barrel Aged',
                            'Barrel Fermented' => 'Barrel Fermented'];

                            foreach($beer_styles as $key => $value) {
                                $selected = isset($_POST['style']) && $_POST['style'] == $key ?'selected':'';
                                echo "\n<option value=\"$key\" $selected>$value</option>";
                            }
                        ?>
                        </select>
                    </div>
                
                <div class="mb-3">
                    <label for="abv" class="form-label">ABV % </label>
                    <input type="text" name="abv" id="abv" class="form-control" value="<?php if(isset($_POST['abv'])) echo $_POST['abv']; ?>" >
                </div>
                <div class="mb-3">
                    <label for="ibu" class="form-label">IBU</label>
                    <input type="text" name="ibu" id="ibu" class="form-control" value="<?php if(isset($_POST['ibu'])) echo $_POST['ibu']; ?>" >
                </div>
                <div class="mb-3">
                    <label for="beer_color" class="form-label">Beer Color</label>
                    <input type="text" name="beer_color" id="beer_color" class="form-control" value="<?php if(isset($_POST['beer_color'])) echo $_POST['beer_color']; ?>" >
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Beer Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="3"><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="myfile" class="form-label">Beer Cover Art</label>
                    <input type="file" class="form-control" id="myfile" name="myfile" >
                </div>
         
                <input type="submit" value="Add Beer" name="submit" class="button mb-5">
</form>
</div>
<?php include("includes/footer.php"); ?>