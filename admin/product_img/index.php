<?php
include($_SERVER['DOCUMENT_ROOT'] . '/webdev-base-webshop/core/db_connect.php');

if (isset($_POST['upload'])) {
    $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "../../assets/upload/";

    //new file size in KB /
    $new_size = $file_size / 1024;
    // new file size in KB /

    //make file name in lower case /
    $new_file_name = strtolower($file);
    // make file name in lower case

    $final_file = str_replace(' ', '-', $new_file_name);

    if (move_uploaded_file($file_loc, $folder . $final_file)) {
        $sql = "INSERT INTO product_image(file,type,size) VALUES('$final_file','$file_type','$new_size')";
        mysqli_query($con, $sql);
        echo "File sucessfully upload";
    } else {
        echo "Error.Please try again";
    }
}
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
            <input type="file" name="file" />
        </div>
        <div class="form-group">
            <lable>image name</lable>
            <input type="text" name=img_name>
        </div>
        <button type=" submit" name="upload">upload</button>
    </form>

</body>

</html>