<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>

  <body class="container p-5">
    <header class="text-center">
        <nav class="mb-5">
            <a href="index.php" class="btn btn-dark">Home</a>
            <a href="login.php" class="btn btn-success">Login</a>
        <?php 
        if (isset($_SESSION['agafgdfsdghshfgshfghndnmrsegsfgsd'])){
         echo" <a href=\"admin.php\" class=\"btn btn-success\">Admin</a>";
        }
        
        ?>
        </nav>

    </header>