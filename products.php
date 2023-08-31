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


$name = $description = $price = $image = "";



    if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty(trim($_POST["name"])) && empty(trim($_POST["description"])) && empty(trim($_POST["price"])) && empty(trim($_FILES['image']))){
        $username_err = "Please enter valid data.";
    } else {


        /* create new name file */
        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo( $_FILES["image"]["name"], PATHINFO_EXTENSION );
        $basename   = $filename . "." . $extension;
        $source       = $_FILES["image"]["tmp_name"];
        $destination  = "uploadImage/{$basename}";

        $sql = "INSERT INTO products (name, description,price,image) VALUES (?, ?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $_POST["name"], $_POST["description"], $_POST["price"],$basename);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* move the file */
                move_uploaded_file( $source, $destination );
                // Redirect to login page
                header("location: products.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);


        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 500px; padding: 20px; align: center }
    </style>
</head>
<body>
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
<div class="wrapper">

    <h2>Product</h2>
    <p>Please fill this form to create an product.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control " value="">
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" name="price" class="form-control" value="">
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control " value="">
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group">
            <label>Image</label>
            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="index.php" class="btn btn-secondary ml-2" >Go Back</a>
        </div>

    </form>
</div>
</body>
</html>
