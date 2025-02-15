<?php
    include('session.php');
?>
<?php
    require_once "config.php";

    if(isset($_GET['group']))
    {
        $group = $_GET['group'];
        if($group == "bai-hat")
        {
            $id = $_GET['IdBaiHat'];
            $sql = "DELETE FROM baihat WHERE IdBaiHat = $id;";
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            header('location:admin_music.php?group=bai-hat');
        }
        else if($group == "album")
        {
            $id = $_GET['IdAlbum'];
            $sql = "DELETE FROM album WHERE IdAlbum = $id;";
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            header('location:admin_music.php?group=album');
        }
        else if($group == "nghe-si")
        {
            $id = $_GET['IdNgheSi'];
            $sql = "DELETE FROM nghesi WHERE IdNgheSi = $id;";
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            header('location:admin_music.php?group=nghe-si');
        }
        if($group == "chu-de")
        {
            $id = $_GET['IdChuDe'];
            $sql = "DELETE FROM chude WHERE IdChuDe = $id;";
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            header('location:admin_music.php?group=chu-de');
        }
        if($group == "the-loai")
        {
            $id = $_GET['IdTheLoai'];
            $sql = "DELETE FROM theloai WHERE IdTheLoai = $id;";
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            header('location:admin_music.php?group=the-loai');
        }
    } else 
    header('location:admin_music.php');
?>