<?php
// include('../core/checklogin_admin.php');
include_once('../../core/db_connect.php');
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
        $result = $mysqli->query("SELECT * from admin_user") or die($mysqli->error);
        ?>
        <div class="row justify-conent-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>email</th>
                        <th>password</th>
                        <th>action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['admin_user_id']; ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['admin_user_id']; ?>" class="btn btn-danger">delete</a>
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
        <div class="row justify-content-center">
            <form action="process.php" method="POSt">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="enter your email">
                </div>
                <div class="form-group">
                    <label>password</label>
                    <input type="text" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="enter your password ">
                </div>
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
    </div>
</body>

</html>