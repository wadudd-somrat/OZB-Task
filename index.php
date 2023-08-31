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


if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$sql = "SELECT id,name,description,price,image FROM products LIMIT $offset, $no_of_records_per_page";

if($stmt = mysqli_prepare($link, $sql)) {
//var_dump($stmt);
    /* execute statement */
   mysqli_stmt_execute($stmt);



    $total_pages = ceil($stmt->fetch() / $no_of_records_per_page);
    /* bind result variables */
   mysqli_stmt_bind_result($stmt, $id,$name, $description,$price,$image);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }

        img {
            height: 50px;
            width: 80px;
        }
        li {
            margin:0 10px 10px 0;
        }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
    </p>
    <div class="container">
        <p align="right">
            <a href="products.php" class="btn btn-info">New Create</a>
        </p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                /* fetch values */
                while (mysqli_stmt_fetch($stmt)) {
                ?>
                <tr>
                <th scope="row"><?php echo $i++ ?></th>
                <td><?php echo $name ?></td>
                <td><?php echo $description ?></td>
                <td><?php echo $price ?></td>
                <td><?php if(!empty($image)){ ?> <img src="<?php  echo 'uploadImage/'.$image; ?>" /><?php }  ?></td>
                    <td><a href="product_details.php?product=<?php echo $id ?>">Details</a></td>
            </tr>
            <?php

            }
                /* close statement */
                mysqli_stmt_close($stmt);
                }
                /* close connection */
                mysqli_close($link);
            ?>

            </tbody>

        </table>
        <ul class="pagination">
            <li><a href="?pageno=1">First</a></li>
            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
            </li>
            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>

    </div>
</body>
</html>