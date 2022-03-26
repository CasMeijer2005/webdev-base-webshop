<?php
include('core/db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop met een leuke naam</title>
    <link rel="stylesheet" href="/webdev-base-webshop/assets/css/style.css">
</head>

<body>
    <header>
        <h1 class="logo">hoodie</h1>
        <nav>
            <ul>
                <li><a href="#"><span>boys</span></a></li>
                <li><a href="#"><span>girls</span></a></li>
                <li><a href="#"><span>other</span></a></li>
            </ul>



        </nav>
    </header>
</body>

</html>
<?php
$con->close();
?>