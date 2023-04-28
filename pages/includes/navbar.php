<?php
function navabar($title)
{

    $product = "";
    $category = "";
    $stock ="";
    if ($title == 'Product') {
        $product = 'active';
    }
    if ($title == 'Category') {
        $category = 'active';
    }if ($title == 'Stock') {
        $stock = 'active';
    }

    echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $title . ' page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/constant.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="maxw" style="padding: 10px 0">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <h2 class="logo">iGrocery</h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item '.$product.'">
                            <a class="nav-link" aria-current="page" href="product.php">Product</a>
                        </li>
                        <li class="nav-item '.$stock.'">
                            <a class="nav-link" href="stock.php">Stock</a>
                        </li>
                        <li class="nav-item '.$category.'">
                            <a class="nav-link" href="category.php">Category</a>
                        </li>
                        <li class="nav-item">
                    </ul>
                    <p style="margin-right:40px">Hi, '.$_SESSION['name'].'</p>
                    <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </div>
    ';
}
