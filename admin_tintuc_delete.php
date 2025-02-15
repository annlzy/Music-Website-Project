<?php
    include('session.php');
?>
<?php
    require_once "config.php";
    if (isset($_GET['IdTinTuc'])) {
    $id = $_GET['IdTinTuc'];
    $sql = "DELETE FROM `tintuc` WHERE IdTinTuc=$id;";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
}
header('location:admin_tintuc.php');
?>