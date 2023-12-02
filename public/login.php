<?php
include("../private/data.php");
$username = isset ($_POST['username']) ? $_POST['username'] :'';
$password = isset ($_POST['password']) ? $_POST['password'] :'';
$msg="";
$beer_id = "";
$title= "Please Login to Edmonton BrewHub";
include("includes/header.php");
?>

<div class="container">
<h1>Secure Login</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
</div>
<?php
if(isset($_POST['submit'])){
    if(($username == $username_good) && (password_verify($password, $pw_enc))){
        

        session_start();
        $_SESSION['agafgdfsdghshfgshfghndnmrsegsfgsd'] = session_id();

        header("location: admin.php");
       

    } else{

        if($username != "" && $password != ""){
        $msg = 'Invalid Login';
            }else{
                $msg = "Please input the correct username and password";
                }
    }
    
    if($msg){
        echo "\n<div class=\"alert alert-danger\"> $msg </div>";
        }
}
?>


<?php
include("includes/footer.php");
?> 