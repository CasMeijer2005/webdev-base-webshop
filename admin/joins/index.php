<?php
include($_SERVER['DOCUMENT_ROOT'] . '/webdev-base-webshop/core/db_connect.php');
$photoproduct = $con->query("select name from product");
$image_product = $con->query("select name from product")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foto Uploaden</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <?php include('../core/header.php') ?>
    <form method="post" action enctype="multipart/form-data">
        <div class="form-group">
            <lable>image slect</lable>
            <select type="select" name="product_name">
                <?php while ($rows = $photoproduct->fetch_assoc()) {
                    $product_name = $rows['name'];
                    echo "<option value='$product_name'>$product_name</option>";
                }
                ?>
            </select>
            <select name="prodcut_image" id="">
                <?php while ($rows = $photoproduct->fetch_assoc()) {
                    $product_name = $rows['name'];
                    echo "<option value='$product_name'>$product_name</option>";
                }
                ?>
            </select>

        </div>

    </form>

</body>

</html>