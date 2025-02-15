<?php
include('session.php');
?>
<?php
require_once "config.php";
if (isset($_GET['IdUser'])) {
    $id = $_GET['IdUser'];
    $sql = "DELETE FROM `user` WHERE IdUser=$id;";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
}
header('location:admin_manage.php');
?>