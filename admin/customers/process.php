<?php

use LDAP\Result;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include('../../core/db_connect.php');
$id = 0;
$update = false;
$first_name = ' ';
$middle_name = ' ';
$last_name = ' ';
$phone = ' ';
$mysqli = new mysqli('localhost', 'root', '', 'webshop') or die(mysqli_error($mysqli));
if (isset($_POST['save'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin_user_name = $_POST['admin_user_name'];
    $query = "INSERT INTO customer (`email`,`password`) VALUES ('$email','$password')";
    echo $query;
    $mysqli->query($query) or
        die($mysqli->error);

    $_SESSION['message'] = "record has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: index.php");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM customer WHERE customer_id=$id") or die($mysqli->error);

    $_SESSION['message'] = "record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: /webdev-base-webshop/admin/users/index.php");
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM customer WHERE customer_id=$id") or die($mysqli->error());
    if ($result) {
        $row = $result->fetch_array();
        $first_name = $row['first_name'];
        $middle_name = $row['middle_name'];
        $last_name = $row['last_name'];
        $phone = $row['phone'];
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "UPDATE admin_user set email='$email', password='$password' where id=$id";
    $mysqli->query($query) or
        die(mysqli->error);

    $_SESSION['message'] = "record had been updated!";
    $_SESSION['msg_type'] = "warning";
    header('location: index.php');
}
