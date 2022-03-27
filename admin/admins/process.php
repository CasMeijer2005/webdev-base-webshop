<?php

use LDAP\Result;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include('../../core/db_connect.php');
$id = 0;
$update = false;
$email = ' ';
$password = ' ';
$admin_user_name = ' ';
$mysqli = new mysqli('localhost', 'root', '', 'webshop') or die(mysqli_error($mysqli));
if (isset($_POST['save'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin_user_name = $_POST['admin_user_name'];
    $query = "INSERT INTO admin_user (`email`,`password`,`admin_user_name`) VALUES ('$email','$password','$admin_user_name')";
    echo $query;
    $mysqli->query($query) or
        die($mysqli->error);

    $_SESSION['message'] = "record has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: index.php");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM admin_user WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: /webdev-base-webshop/admin/users/index.php");
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM admin_user WHERE admin_user_id=$id") or die($mysqli->error());
    if ($result) {
        $row = $result->fetch_array();
        $email = $row['email'];
        $password = $row['password'];
        $admin_user_name = $row['admin_user_name'];
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin_user_name = $_POST['admin_user_name'];
    $query = "UPDATE admin_user set email='$email', password='$password', admin_user_name='$admin_user_name' where id=$id";
    $mysqli->query($query) or
        die(mysqli->error);

    $_SESSION['message'] = "record had been updated!";
    $_SESSION['msg_type'] = "warning";
    header('location: index.php');
}
