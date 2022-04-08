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
    <link rel="stylesheet" href="/webdev-base-webshop/assets/css/index_admin.css">
</head>

<body>
    <?php
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        //default user: test@test.nl
        //default password: test123
        $email = $con->real_escape_string($_POST['email']);
        $password = $con->real_escape_string($_POST['password']);

        $liqry = $con->prepare("SELECT admin_user_id,email,password FROM admin_user WHERE email = ? LIMIT 1;");
        if ($liqry === false) {
            trigger_error(mysqli_error($con));
        } else {
            $liqry->bind_param('s', $email);
            $liqry->bind_result($adminId, $email, $dbHashPassword);
            if ($liqry->execute()) {
                $liqry->store_result();
                $liqry->fetch();
                if ($liqry->num_rows == '1' && password_verify($password, $dbHashPassword)) {
                    $_SESSION['Sadmin_id'] = $adminId;
                    $_SESSION['Sadmin_email'] = stripslashes($email);
                    echo "Bezig met inloggen... <meta http-equiv=\"refresh\" content=\"1; URL=index_loggedin.php\">";
                    exit();
                } else {
                    echo "ERROR tijdens inloggen";
                }
            }
            $liqry->close();
        }
    }
    ?>
    <section id="cover" class="min-vh-100">
        <div id="cover-caption">
            <div class="container">
                <div class="row text-white">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                        <h1 class="display-4 py-2 text-truncate">welcome to the admin pagef</h1>
                        <div class="px-2">
                            <form action="index.php" method="post" class="justify-content-center">
                                <div class="form-group">
                                    <lable class="sr-only">email</lable>
                                    <input type="email" name="email" id="" class="form-control form-control-lg" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">password</label>
                                    <input type="password" name="password" id="" class="form-control form-control-lg" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-info btn-lg btn-block" type="submit" name="submit" value="Login">

                                </div>
                                <div class="form-group">
                                    <a href="forgot_password.php">Forgot Password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<?php include('../core/footer.php') ?>