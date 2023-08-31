<?php
// Initialize the session
session_start();
// Include config file
require_once "config.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        img {
            height: 168px;
            width: 359px;
        }
    </style>
</head>

<body>
<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">OZB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <br>
    <?php
    if(!empty($_GET['product'])) {

// Prepare a select statement
    $sql = "SELECT id, name, description,price,image FROM products WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
// Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $_GET['product']);

// Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
// result
            mysqli_stmt_store_result($stmt);

// Check if username exists, if yes then verify password
            if (mysqli_stmt_num_rows($stmt) == 1) {

// Bind result variables


?>
    <div class="container">
    <div class="card">
        <div class="card-body">
            <div class="container-fliud">
                <?php
                mysqli_stmt_bind_result($stmt,$id, $name, $description,$price,$image);

                if (mysqli_stmt_fetch($stmt)) {

                ?>

                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active img-fluid" id="pic-1"><img src="<?php echo 'uploadImage/'.$image; ?>" /></div>
                        </div>
                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title"><?php echo $name; ?></h3>
                        <p class="product-description"><?php echo $description; ?></p>
                        <h4 class="price">Price: <span><?php echo $price ?></span></h4>

                        <div class="action">
                            <button class="add-to-cart btn btn-info" type="button">Add To Cart</button>
                            <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                        </div>
                    </div>
                </div>
                <?php

                }
            }
            else{
                header("location: index.php");
            }
        }
    }
                ?>
            </div>
        </div>
    </div>
</div>
    <?php
        }
        else{
            header("location: index.php");
        }
    ?>
</div>
</body>
</html>
