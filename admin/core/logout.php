<?php // Start PHP
// Hier stopt de session (Het logt je uit)
session_start();
if (isset($_SESSION['Sadmin_id'])) {
    unset($_SESSION['Sadmin_id']);
}
// Redirect de user naar de login pagina
header("location: ../index.php");
die;
?>
<!-- Einde PHP -->