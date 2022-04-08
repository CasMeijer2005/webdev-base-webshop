<?php

use LDAP\Result;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = 0;
$update = false;
$name = ' ';
$description = ' ';
$category_id = ' ';
$price = ' ';
$color = ' ';
$weight = ' ';
$mysqli = new mysqli('localhost', 'root', '', 'webshop') or die(mysqli_error($mysqli));
if (isset($_POST['save'])) {
    $name = $_POST['product_name'];
    $description = $_POST['product_description'];
    $category_id = $_POST['category'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $weight = $_POST['weight'];
    $query = "INSERT INTO product (`name`,`description`, `category_id`, `price`, `color`, `weight`) VALUES ('$name','$description', '$category_id', '$price', '$color', '$weight')";
    echo $query;
    $mysqli->query($query) or
        die($mysqli->error);

    $_SESSION['message'] = "record has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: index.php");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM product WHERE product_id=$id") or die($mysqli->error);

    $_SESSION['message'] = "record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: /webdev-base-webshop/admin/product/index.php");
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM product WHERE product_id=$id") or die($mysqli->error());
    if ($result) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $description = $row['description'];
        $category_id = $row['category_id'];
        $price = $row['price'];
        $color = $row['color'];
        $weight = $row['weight'];
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['product_name'];
    $description = $_POST['product_description'];
    $category_id = $_POST['category'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $weight = $_POST['weight'];
    $query = "UPDATE product SET name='$name', description='$description', category_id='$category_id', price='$price', color='$color', weight='$weight' where product_id=$id";
    $mysqli->query($query) or
        die(mysqli->error);

    $_SESSION['message'] = "record had been updated!";
    $_SESSION['msg_type'] = "warning";
    header('location: index.php');
}
