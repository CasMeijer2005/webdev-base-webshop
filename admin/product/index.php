<?php
include($_SERVER['DOCUMENT_ROOT'] . '/webdev-base-webshop/core/db_connect.php');
include_once('../core/checklogin_admin.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <?php include('../core/header.php') ?>
    <?php require_once 'process.php' ?>

    <?php
    if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'webshop') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * from product") or die($mysqli->error);
        ?>
        <div class="row justify-content-center">
            <form action="process.php" method="POSt" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="h1">create a new product</div>
                <div class="form-group">
                    <label>product name</label>
                    <input type="text" name="product_name" class="form-control" value="<?php echo $name; ?>" placeholder="enter the product name">
                </div>
                <div class="form-group">
                    <label>product description</label>
                    <textarea type="text" name="product_description" class="form-control" value="<?php echo $description; ?>" placeholder="enther the product description"><?php echo $description; ?></textarea>
                </div>
                <div class="form-group">
                    <label>category</label>
                    <input type="text" name="category" class="form-control" value="<?php echo $category_id; ?>" placeholder="enter the category id ">
                </div>
                <div class="form-group">
                    <label>price</label>
                    <input type="text" name="price" class="form-control" value="<?php echo $price; ?>" placeholder="enter the price">
                </div>
                <div class="form-group">
                    <label>color</label>
                    <input type="text" name="color" class="form-control" value="<?php echo $color; ?>" placeholder="enter the product color">
                </div>
                <div class="form-group">
                    <label>weight</label>
                    <input type="text" name="weight" class="form-control" value="<?php echo $weight; ?>" placeholder="enter the product weight">
                </div>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    Select Image File to Upload:
                    <input type="file" name="file">
                    <input type="submit" name="submit" value="Upload">
                </form>

                <div class="form-group">
                    <?php
                    if ($update == true) :
                    ?>
                        <button type="submit" class="btn btn-info" name="update">update</button>
                    <?php else : ?>
                        <button type="submit" class="btn btn-primary" name="save">save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="row justify-conent-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>description</th>
                        <th>category_id</th>
                        <th>price</th>
                        <th>color</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['category_id']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['color']; ?></td>

                        <td>
                            <a href="index.php?edit=<?php echo $row['product_id']; ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['product_id']; ?>" class="btn btn-danger">delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php


        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>

    </div>
    <?php include('../core/footer.php') ?>