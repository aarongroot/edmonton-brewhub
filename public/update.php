<?php
session_start();
if (!isset($_SESSION['agafgdfsdghshfgshfghndnmrsegsfgsd'])){
    header("location:login.php");
}
require_once("/home/agroot2/data/connect.php");
$beer_id = "";

require_once("../private/prepared.php");
$title = "Update Beer";
include("includes/header.php");

$beer_id = isset($_GET['$beer_id']) ? $_GET['beer_id'] :"";

if(isset($_GET['beer_id'])){
    $beer_id = $_GET['beer_id'];
}elseif(isset($_POST['beer_id'])){
    $beer_id = $_POST['beer_id'];
}else{
    $beer_id = "";
}

$message = "";

$user_beer_name = isset($_POST['beer_name']) ? trim($_POST['beer_name']) : "";
$user_brewery_name = isset($_POST['brewery_name']) ? trim($_POST['brewery_name']) : "";
$user_url = isset($_POST['url']) ? trim($_POST['url']) : "";
$user_style = isset($_POST['style']) ? trim($_POST['style']) : "";
$user_abv = isset($_POST['abv']) ? trim($_POST['abv']) : "";
$user_ibu = isset($_POST['ibu']) ? trim($_POST['ibu']) : "";
$user_beer_color = isset($_POST['beer_color']) ? trim($_POST['beer_color']) : "";
$user_description = isset($_POST['description']) ? trim($_POST['description']) : "";

$existing_beer_name = "";
$existing_brewery_name = "";
$existing_url = "";
$existing_style = "";
$existing_abv = "";
$existing_ibu = "";
$existing_beer_color = "";
$existing_description = "";

if(isset($beer_id)){
    if(is_numeric($beer_id) && $beer_id > 0){
        // grab existing info

        $beer = select_beer_by_id($beer_id);

        if($beer){
            $existing_beer_name = $beer['beer_name'];
            $existing_brewery_name = $beer['brewery_name'];
            $existing_url = $beer['brewery_location'];
            $existing_style = $beer['style'];
            $existing_abv = $beer['abv'];
            $existing_ibu  = $beer['ibu'];
            $existing_beer_color = $beer['beer_color'];
            $existing_description = $beer['description'];
        }else{
            echo'<p>No record of that</p>';
        }
        
    
    
    }
}
$valid = 1;
if(isset($_POST['submit'])) {
    $message="";

    extract($_POST);

    $do_i_proceed = True;
    // validate Name
    $user_beer_name= filter_var($beer_name, FILTER_SANITIZE_STRING);
    if((strlen(trim($beer_name)) < 2) || (strlen($beer_name) > 40)) {
        $do_i_proceed = False;
        $message .= "<p> Please enter an Beer Name that is between 2-40 characters</p>";
    }

    // validate Brewery Name
    $user_brewery_name = filter_var($brewery_name, FILTER_SANITIZE_STRING);
    if(($brewery_name) == 'Select Brewery') {
        $do_i_proceed = False;
        $message .= "Please select a Brewery";
    }

    // validate Url
    $user_url = filter_var($url, FILTER_SANITIZE_URL);
    if((strlen(trim($url)) < 3) || (strlen($url) > 350)) {
        $do_i_proceed = False;
        $message .= "<p> Please enter a url that is between 3-350 characters</p>";
    }

    // validate Beer Style
    $user_style = filter_var($style, FILTER_SANITIZE_STRING);
    if(($style) == 'Select Beer Style') {
        $do_i_proceed = False;
        $message .= "Please select a Beer Style";
    }

    // validate Abv
    $user_abv= filter_var($abv, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if(((trim($abv)) < 0) || (trim($abv) > 20)) {
        $do_i_proceed = False;
        $message .= "<p> Please Enter an ABV between 0-20 with no % </p>";
    }

    $user_ibu= filter_var($ibu, FILTER_SANITIZE_NUMBER_INT);
    if(((trim($ibu)) < 0) || (trim($ibu) > 200)) {
        $do_i_proceed = False;
        $message .= "<p> Please enter a IBU that is between 0-200</p>";
    }

    $user_beer_color= filter_var($beer_color, FILTER_SANITIZE_NUMBER_INT);
    if(((trim($beer_color)) < 0) || (trim($beer_color) > 40)) {
        $do_i_proceed = False;
        $message .= "<p> Please enter a Beer Color that is between 0-40</p>";
    }

    $user_description= filter_var($description, FILTER_SANITIZE_STRING);
    if((strlen(trim($description)) < 3) || (strlen($description) > 200)) {
        $do_i_proceed = False;
        $message .= "<p> Please enter a description that is between 3-200 characters</p>";
    }

    if($do_i_proceed == True){
        update_beer($user_beer_name, $user_brewery_name, $user_url, $user_style, $user_abv, $user_ibu, $user_beer_color, $user_description, $beer_id);
        $message = "<p class=\"text-success\">Beer added Successfully</p>";
        header("location: edit.php");
        
     }else{
         $message .= "<p>There was a problem: " . "$connection->error" . "</p>";
     }
}
?>
<div class="container text-center">
    <h1>Update <?php echo $existing_beer_name?></h1>
    <p>To update a beer in our database, simply fill out the form below and hit "Update Beer".</p>
</div>
<div>
        <nav class="mb-5 text-center">
            <a href="add.php" class="btn btn-success">Add</a>
            <a href="edit.php" class="btn btn-warning">Edit</a>
            <a href="logout.php" class="btn btn-dark">Logout</a>
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
        <input type="text" name="beer_name" id="beer_name" class="form-control" value="<?php if($user_beer_name != ""){
                                                                                        echo $user_beer_name;
                                                                                    }else{
                                                                                        echo $existing_beer_name;
                                                                                    } ?>">
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
                            'Town Square Brewing Co.' => 'Town Square Brewing Co.'];

                            foreach($brewery_names as $key => $value) {
                                if($user_brewery_name == $key || $existing_brewery_name == $key){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                echo "\n<option value=\"$key\" $selected>$value</option>";
                            }
                        ?>
                    </select> 
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">Embed Map URL</label>
                    <input type="text" name="url" id="url" class="form-control" value="<?php if($user_url != ""){
                                                                                                echo $user_url;
                                                                                            }else{
                                                                                                echo $existing_url;
                                                                                            }  ?>">
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
                                if($user_style == $key || $existing_style == $key){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                                echo "\n<option value=\"$key\" $selected>$value</option>";
                            }
                        ?>
                        </select>
                    </div>
                
                <div class="mb-3">
                    <label for="abv" class="form-label">ABV % </label>
                    <input type="text" name="abv" id="abv" class="form-control" value="<?php if($user_abv != ""){
                                                                                                    echo $user_abv;
                                                                                                }else{
                                                                                                    echo $existing_abv;
                                                                                                }  ?>">
                </div>
                <div class="mb-3">
                    <label for="ibu" class="form-label">IBU</label>
                    <input type="text" name="ibu" id="ibu" class="form-control" value="<?php if($user_ibu != ""){
                                                                                                    echo $user_ibu;
                                                                                                }else{
                                                                                                    echo $existing_ibu;
                                                                                                }  ?>">
                </div>
                <div class="mb-3">
                    <label for="beer_color" class="form-label">Beer Color</label>
                    <input type="text" name="beer_color" id="beer_color" class="form-control" value="<?php if($user_beer_color != ""){
                                                                                                    echo $user_beer_color;
                                                                                                }else{
                                                                                                    echo $existing_beer_color;
                                                                                                }  ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Beer Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="3"><?php if($user_description != ""){
                                                                                                            echo $user_description;
                                                                                                        }else{
                                                                                                            echo $existing_description;
                                                                                                        }  ?></textarea>
                </div>
                <input type="hidden" name="beer_id" value=" <?php echo $beer_id; ?>">
                <input type="submit" value="Update Beer" name="submit" class="btn btn-success">
</form>



<?php include("includes/footer.php"); ?>