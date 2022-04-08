<?php
include($_SERVER['DOCUMENT_ROOT'] . '/webdev-base-webshop/core/db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Webshop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php

    include('core/checklogin_admin.php');
    include('core/header.php')
    ?>
    <ul>
        <li><a href="admins/">admin</a></li>
        <li><a href="orders/">Bestellingen</a></li>
        <li><a href="producten/">Producten</a></li>
        <li><a href=" customers/">customer</a></li>
        <li><a href="core/logout.php">logout</a></li>
    </ul>
</body>

</html>
<?php
$con->close();
?>