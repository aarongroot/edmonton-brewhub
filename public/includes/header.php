<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/reset.css">
    <link rel="stylesheet" href="../public/css/styles.css">
  </head>

  <body>
    <header>
    <div class="container">
            <div class="header-flex">
                <a href="index.php" class="logo">
                    <img src="img/logo.png" alt="Edmonton BrewHub Logo">
                </a>
            
            <nav>
                <ul class="menu">
                    <li><a href="filter.php">All Beers</a></li>
                    <li><a href="login.php">Login</a></li>
                    <?php 
                        if (isset($_SESSION['agafgdfsdghshfgshfghndnmrsegsfgsd'])){
                        echo" <a href=\"admin.php\" class=\"\">Admin</a>";
                        }
                      
                      ?>
                </ul>
            </nav>
            </div>
        </div>
    </header>