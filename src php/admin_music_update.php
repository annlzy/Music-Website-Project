<?php
include('session2.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cập nhật thông tin</title>
  <link rel="shortcut icon" type="image/png" href="img/4472584.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="css/mystyle.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link href="css/login.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/colormode.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class='container-fluid'>
<?php 
	if ($permission_sess != "Admin") {
		header("location: login.php");
		die();
	}
	?>
<main class="row">
    <?php
    include('sidebar_admin.php');
    ?>
    <script>
		var element = document.getElementById("admin_music");
		element.classList.add("active");
		element.classList.remove("link-body-emphasis");
	</script>
    <!-- Làm trong thẻ div dưới này nè -->
    <div class="col-md-9 col-lg-10 col-sm">
      <?php
      require_once "config.php";
      if(isset($_GET['group']))
      {
        $group = $_GET['group'];
        if($group == "bai-hat")
        {
            $id = $_GET['IdBaiHat'];
            $sql = "SELECT b.`IdBaiHat`, `TenBaiHat`, `HinhBaiHat`, b.`IdAlbum`, b.`IdTheLoai`, b.`IdChuDe`, b.`IdNgheSi`, b.`NgayPhatHanh`, `Audio`, n.TenNgheSi, a.TenAlbum, t.TenTheLoai, c.TenChuDe
            FROM `baihat` b, nghesi n, theloai t, chude c, album a
            WHERE b.IdNgheSi = n.IdNgheSi AND b.IdAlbum = a.IdAlbum AND b.IdTheLoai = t.IdTheLoai AND b.IdChuDe = c.IdChuDe AND b.IdBaiHat = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC); // lấy dữ liệu
            // Nếu không tìm thấy dữ liệu -> thông báo lỗi
            if (empty($row)) {
            echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
            }
            ?>
            <div class="container">
            <h1 class="mb-3" style='text-align:center'>Cập nhật thông tin bài hát</h1>

            <form method="post" action="admin_music_update.php?group=bai-hat&IdBaiHat=<?php echo $row['IdBaiHat'] ?>" class="form">

                <div class="form-group form-floating text-black mb-3">
                    <input type="text" name="nhapBaiHat" class="form-control" id="nhapBaiHat" placeholder="Pink Venom" value="<?php echo $row['TenBaiHat'] ?>">
                    <label for="nhapBaiHat" class="fw-medium">Bài hát</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                    <input type="text" name="nhapAlbum" class="form-control" id="nhapAlbum" placeholder="BORN PINK" value="<?php echo $row['TenAlbum'] ?>">
                    <label for="nhapAlbum" class="fw-medium">Album</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                    <input type="text" name="nhapNgheSi" class="form-control" id="nhapNgheSi" placeholder="BLACKPINK" value="<?php echo $row['TenNgheSi'] ?>">
                    <label for="nhapNgheSi" class="fw-medium">Nghệ sĩ</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                    <input type="text" name="nhapTheLoai" class="form-control" id="nhapTheLoai" placeholder="Dance/ Electronic" value="<?php echo $row['TenTheLoai'] ?>">
                    <label for="nhapTheLoai" class="fw-medium">Thể loại</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                    <input type="text" name="nhapChuDe" class="form-control" id="nhapChuDe" placeholder="Party" value="<?php echo $row['TenChuDe'] ?>">
                    <label for="nhapChuDe" class="fw-medium">Chủ đề</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                    <input type="date" name="release_date" class="form-control" id="release_date" placeholder="" value="<?php echo $row['NgayPhatHanh'] ?>">
                    <label for="nhapNgayPhatHanh" class="fw-medium">Ngày phát hành</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                    <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="" value="<?php echo $row['HinhBaiHat'] ?>">
                    <label for="nhapAnh" class="fw-medium">Ảnh</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                    <input type="text" name="nhapAudio" class="form-control" id="nhapAudio" placeholder="" value="<?php echo $row['Audio'] ?>">
                    <label for="nhapAudio" class="fw-medium">Audio bài hát</label>
                </div>

                <div class="d-flex justify-content-end">
                <a class="btn btn-outline-secondary btn-lg text-decoration-none text-black" href="admin_music.php?group=bai-hat">Hủy</a>
                <button class="btn btn-primary btn-lg ms-1" name="btn-update-baihat" type="submit">Cập Nhật</button>
                </div>
            </form>
            <?php

            
            //mysqli_close($conn);
        }

        if($group == "album")
        {
            $id = $_GET['IdAlbum'];
            $sql = "SELECT a.`IdAlbum`, a.`TenAlbum`, a.`HinhAlbum`, a.`NgayPhatHanh`, n.TenNgheSi
            FROM `album` a, nghesi n 
            WHERE a.IdNgheSi = n.IdNgheSi AND a.IdAlbum = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC); // lấy dữ liệu
            // Nếu không tìm thấy dữ liệu -> thông báo lỗi
            if (empty($row)) {
            echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
            }
            ?>
            <div class="container">
            <h1 class="mb-3" style='text-align:center'>Cập nhật thông tin album</h1>

            <form method="post" action="admin_music_update.php?group=album&IdAlbum=<?php echo $row['IdAlbum'] ?>" class="form">

                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAlbum" class="form-control" id="nhapAlbum" placeholder="The Album" value="<?php echo $row['TenAlbum'] ?>">
                  <label for="nhapAlbum" class="fw-medium">Album</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapNgheSi" class="form-control" id="nhapNgheSi" placeholder="BLACKPINK" value="<?php echo $row['TenNgheSi'] ?>">
                  <label for="nhapNgheSi" class="fw-medium">Nghệ sĩ</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="date" name="release_date" class="form-control" id="release_date" placeholder="" value="<?php echo $row['NgayPhatHanh'] ?>">
                  <label for="nhapNgayPhatHanh" class="fw-medium">Ngày phát hành</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="" value="<?php echo $row['HinhAlbum'] ?>">
                  <label for="nhapAnh" class="fw-medium">Ảnh</label>
                </div>

                <div class="d-flex justify-content-end">
                <a class="btn btn-outline-secondary btn-lg text-decoration-none text-black" href="admin_music.php?group=album">Hủy</a>
                <button class="btn btn-primary btn-lg ms-1" name="btn-update-album" type="submit">Cập Nhật</button>
                </div>
            </form>
            <?php

           
            //mysqli_close($conn);
        }

        else if($group == "nghe-si")
        {
            $id = $_GET['IdNgheSi'];
            $sql = "SELECT * FROM nghesi WHERE IdNgheSi = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC); // lấy dữ liệu
            // Nếu không tìm thấy dữ liệu -> thông báo lỗi
            if (empty($row)) {
            echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
            }
            ?>
            <div class="container">
            <h1 class="mb-3" style='text-align:center'>Cập nhật thông tin nghệ sĩ</h1>

            <form method="post" action="admin_music_update.php?group=nghe-si&IdNgheSi=<?php echo $row['IdNgheSi'] ?>" class="form">

                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapNgheSi" class="form-control" id="nhapNgheSi" placeholder="BLACKPINK" value="<?php echo $row['TenNgheSi'] ?>">
                  <label for="nhapNgheSi" class="fw-medium">Nghệ sĩ</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="" value="<?php echo $row['HinhNgheSi'] ?>">
                  <label for="nhapAnh" class="fw-medium">Ảnh</label>
                </div>

                <div class="d-flex justify-content-end">
                <a class="btn btn-outline-secondary btn-lg text-decoration-none text-black" href="admin_music.php?group=nghe-si">Hủy</a>
                <button class="btn btn-primary btn-lg ms-1" name="btn-update-nghesi" type="submit">Cập Nhật</button>
                </div>
            </form>
            <?php

            
            //mysqli_close($conn);
        }

        else if($group == "chu-de")
        {
            $id = $_GET['IdChuDe'];
            $sql = "SELECT * FROM chude WHERE IdChuDe = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC); // lấy dữ liệu
            // Nếu không tìm thấy dữ liệu -> thông báo lỗi
            if (empty($row)) {
            echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
            }
            ?>
            <div class="container">
            <h1 class="mb-3" style='text-align:center'>Cập nhật thông tin chủ đề</h1>

            <form method="post" action="admin_music_update.php?group=chu-de&IdChuDe=<?php echo $row['IdChuDe'] ?>" class="form">

                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapChuDe" class="form-control" id="nhapChuDe" placeholder="Party" value="<?php echo $row['TenChuDe'] ?>">
                  <label for="nhapChuDe" class="fw-medium">Chủ đề</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="" value="<?php echo $row['HinhChuDe'] ?>">
                  <label for="nhapAnh" class="fw-medium">Ảnh</label>
                </div>

                <div class="d-flex justify-content-end">
                <a class="btn btn-outline-secondary btn-lg text-decoration-none text-black" href="admin_music.php?group=chu-de">Hủy</a>
                <button class="btn btn-primary btn-lg ms-1" name="btn-update-chude" type="submit">Cập Nhật</button>
                </div>
            </form>
            <?php

            
            //mysqli_close($conn);
        }

        else if($group == "the-loai")
        {
            $id = $_GET['IdTheLoai'];
            $sql = "SELECT * FROM theloai WHERE IdTheLoai = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC); // lấy dữ liệu
            // Nếu không tìm thấy dữ liệu -> thông báo lỗi
            if (empty($row)) {
            echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
            }
            ?>
            <div class="container">
            <h1 class="mb-3" style='text-align:center'>Cập nhật thông tin thể loại</h1>

            <form method="post" action="admin_music_update.php?group=the-loai&IdTheLoai=<?php echo $row['IdTheLoai'] ?>" class="form">

                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapTheLoai" class="form-control" id="nhapTheLoai" placeholder="Dance/ Electronic" value="<?php echo $row['TenTheLoai'] ?>">
                  <label for="nhapTheLoai" class="fw-medium">Thể loại</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="" value="<?php echo $row['HinhTheLoai'] ?>">
                  <label for="nhapAnh" class="fw-medium">Ảnh</label>
                </div>

                <div class="d-flex justify-content-end">
                <a class="btn btn-outline-secondary btn-lg text-decoration-none text-black" href="admin_music.php?group=the-loai">Hủy</a>
                <button class="btn btn-primary btn-lg ms-1" name="btn-update-theloai" type="submit">Cập Nhật</button>
                </div>
            </form>
            <?php

            
            //mysqli_close($conn);
        }
    }

// bai hat
if (isset($_POST['btn-update-baihat'])) {
    $baihat = $_POST["nhapBaiHat"];
    $album = $_POST["nhapAlbum"];
    $nghesi = $_POST["nhapNgheSi"];
    $theloai = $_POST["nhapTheLoai"];
    $chude = $_POST["nhapChuDe"];
    $date = $_POST["release_date"];
    $img = $_POST["nhapAnh"];
    $audio = $_POST["nhapAudio"];
    //Kiểm Tra value có rỗng không
    if (!empty($baihat) && !empty($nghesi) && !empty($theloai) && !empty($chude) && !empty($date) && !empty($img) && !empty($audio)) {
    //update
	//check bai hat
    $sql_check = "SELECT `IdNgheSi`, `TenNgheSi`, `HinhNgheSi` FROM `nghesi` WHERE TenNgheSi = '$nghesi'";
        $result = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $idNgheSi = $row['IdNgheSi'];
        } 
        else {
          $sql_insert = "INSERT INTO `nghesi`(`TenNgheSi`) VALUES ('$nghesi')";
          if (mysqli_query($conn, $sql_insert) > 0) {
            $sql_check = "SELECT `IdNgheSi`, `TenNgheSi`, `HinhNgheSi` FROM `nghesi` WHERE TenNgheSi = '$nghesi'";
            $result = mysqli_query($conn, $sql_check);
            if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              $idNgheSi = $row['IdNgheSi'];
            } 
          } 
        }

         //check album
         $sql_check = "SELECT `IdAlbum`, `TenAlbum`, `HinhAlbum`, `NgayPhatHanh`, `IdNgheSi` 
         FROM `album` 
         WHERE TenAlbum =  '$album'";
         $result = mysqli_query($conn, $sql_check);
         if (mysqli_num_rows($result) > 0) {
           $row = mysqli_fetch_assoc($result);
           $idAlbum = $row['IdAlbum'];
         } 
         else {
           $sql_insert = "INSERT INTO `album`(`TenAlbum`, `IdNgheSi`) VALUES ('$album', '$idNgheSi')";
           if (mysqli_query($conn, $sql_insert) > 0) {
             $sql_check = "SELECT `IdAlbum`, `TenAlbum`, `HinhAlbum`, `NgayPhatHanh`, `IdNgheSi` 
             FROM `album` 
             WHERE TenAlbum =  '$album'";
             $result = mysqli_query($conn, $sql_check);
             if (mysqli_num_rows($result) > 0) {
               $row = mysqli_fetch_assoc($result);
               $idAlbum = $row['IdAlbum'];
             } 
           } 
         }
 
         //check the loai
         $sql_check = "SELECT `IdTheLoai`, `TenTheLoai`, `HinhTheLoai` FROM `theloai` WHERE TenTheLoai = '$theloai'";
         $result = mysqli_query($conn, $sql_check);
         if (mysqli_num_rows($result) > 0) {
           $row = mysqli_fetch_assoc($result);
           $idTheLoai = $row['IdTheLoai'];
         } 
         else {
           $sql_insert = "INSERT INTO `theloai`(`TenTheLoai`) VALUES ('$theloai')";
           if (mysqli_query($conn, $sql_insert) > 0) {
             $sql_check = "SELECT `IdTheLoai`, `TenTheLoai`, `HinhTheLoai` FROM `theloai` WHERE TenTheLoai = '$theloai'";
             $result = mysqli_query($conn, $sql_check);
             if (mysqli_num_rows($result) > 0) {
               $row = mysqli_fetch_assoc($result);
               $idTheLoai = $row['IdTheLoai'];
             } 
           } 
         }
 
         //check chu de
         $sql_check = "SELECT `IdChuDe`, `TenChuDe`, `HinhChuDe` FROM `chude` WHERE TenChuDe = '$chude'";
         $result = mysqli_query($conn, $sql_check);
         if (mysqli_num_rows($result) > 0) {
           $row = mysqli_fetch_assoc($result);
           $idChuDe = $row['IdChuDe'];
         } 
         else {
           $sql_insert = "INSERT INTO `chude`(`TenChuDe`) VALUES ('$chude')";
           if (mysqli_query($conn, $sql_insert) > 0) {
             $sql_check = "SELECT `IdChuDe`, `TenChuDe`, `HinhChuDe` FROM `chude` WHERE TenChuDe = '$chude'";
             $result = mysqli_query($conn, $sql_check);
             if (mysqli_num_rows($result) > 0) {
               $row = mysqli_fetch_assoc($result);
               $idChuDe = $row['IdChuDe'];
             } 
           } 
         }
 
    $sql2 = "UPDATE baihat SET TenBaiHat='$baihat', IdAlbum='$idAlbum', IdNgheSi='$idNgheSi', IdTheLoai='$idTheLoai', IdChuDe='$idChuDe', NgayPhatHanh='$date', HinhBaiHat='$img', Audio='$audio' WHERE IdBaiHat = '$id'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        echo "<script> alert ('Cập nhật thành công!'); window.location.href='admin_music.php?group=bai-hat'; </script>";
    } else {
        echo "<script> alert ('Có lỗi trong quá trình cập nhật. Vui lòng thử lại!')</script>";
    }
    } 
    else {
        echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); </script>";
    }
}
// nghe si
if (isset($_POST['btn-update-nghesi'])) {
    $nghesi = $_POST["nhapNgheSi"];
    $img = $_POST["nhapAnh"];
    //Kiểm Tra value có rỗng không
    if (!empty($nghesi) && !empty($img)) {
    //update
    $sql2 = "UPDATE nghesi SET TenNgheSi='$nghesi', HinhNgheSi='$img' WHERE IdNgheSi = $id;";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        echo "<script> alert ('Cập nhật thành công!'); window.location.href='admin_music.php?group=nghe-si'; </script>";
    } else {
        echo "<script> alert ('Có lỗi trong quá trình cập nhật. Vui lòng thử lại!')</script>";
    }
    } 
    else {
        echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); </script>";
    }
}
//album
if (isset($_POST['btn-update-album'])) {
    $album = $_POST["nhapAlbum"];
    $nghesi = $_POST["nhapNgheSi"];
    $date = $_POST["release_date"];
    $img = $_POST["nhapAnh"];
    //Kiểm Tra value có rỗng không
    if (!empty($album) && !empty($nghesi) && !empty($date) && !empty($img)) {
    //update
    $sql_check = "SELECT `IdNgheSi`, `TenNgheSi`, `HinhNgheSi` FROM `nghesi` WHERE TenNgheSi = '$nghesi'";
    $result = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $idNgheSi = $row['IdNgheSi'];
    } 
    else {
      $sql_insert = "INSERT INTO `nghesi`(`TenNgheSi`) VALUES ('$nghesi')";
      if (mysqli_query($conn, $sql_insert) > 0) {
        $sql_check = "SELECT `IdNgheSi`, `TenNgheSi`, `HinhNgheSi` FROM `nghesi` WHERE TenNgheSi = '$nghesi'";
        $result = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $idNgheSi = $row['IdNgheSi'];
        } 
      } 
    }

    $sql2 = "UPDATE album SET TenAlbum='$album', IdNgheSi='$idNgheSi', NgayPhatHanh='$date', HinhAlbum='$img' WHERE IdAlbum = '$id'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        echo "<script> alert ('Cập nhật thành công!'); window.location.href='admin_music.php?group=album'; </script>";
    } else {
        echo "<script> alert ('Có lỗi trong quá trình cập nhật. Vui lòng thử lại!')</script>";
    }
    } 
    else {
        echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); </script>";
    }
}

//the loai
if (isset($_POST['btn-update-theloai'])) {
    $theloai = $_POST["nhapTheLoai"];
    $img = $_POST["nhapAnh"];
    //Kiểm Tra value có rỗng không
    if (!empty($theloai) && !empty($img)) {
    //update
    $sql2 = "UPDATE theloai SET TenTheLoai='$theloai', HinhTheLoai='$img' WHERE IdTheLoai = $id;";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        echo "<script> alert ('Cập nhật thành công!'); window.location.href='admin_music.php?group=the-loai'; </script>";
    } else {
        echo "<script> alert ('Có lỗi trong quá trình cập nhật. Vui lòng thử lại!')</script>";
    }
    } 
    else {
        echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); </script>";
    }
}
//chu de
if (isset($_POST['btn-update-chude'])) {
    $chude = $_POST["nhapChuDe"];
    $img = $_POST["nhapAnh"];
    //Kiểm Tra value có rỗng không
    if (!empty($chude) && !empty($img)) {
    //update
    $sql2 = "UPDATE chude SET TenChuDe='$chude', HinhChuDe='$img' WHERE IdChuDe = $id;";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        echo "<script> alert ('Cập nhật thành công!'); window.location.href='admin_music.php?group=chu-de'; </script>";
    } else {
        echo "<script> alert ('Có lỗi trong quá trình cập nhật. Vui lòng thử lại!')</script>";
    }
    } 
    else {
        echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); </script>";
    }
}




        ?>
        </div>
    </div>
  </main>
  <?php
    include("footer.php");
  ?>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="js/signup.js"></script>
</body>

</html>