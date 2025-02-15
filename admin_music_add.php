<?php
include('session2.php');
if ($permission_sess != "Admin") {
  header("location: login.php");
  die();
}
require_once "config.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thêm mới</title>
  <link rel="shortcut icon" type="image/png" href="img/4472584.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="css/mystyle.css" />
  <link href="css/login.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/colormode.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class='container-fluid'>
  <main class=" row">
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
      <div class="">
        <?php
          if(isset($_GET['group']))
          {
            $group = $_GET['group'];
            if($group == "bai-hat")
            {?>
              <h1 class="mb-3" style="text-align: center">Thêm mới bài hát</h1>

              <form name="frmCreate" method="post" action="admin_music_add.php" class="form">
                
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapBaiHat" class="form-control" id="nhapBaiHat" placeholder="Pink Venom">
                  <label for="nhapBaiHat" class="fw-medium">Bài hát</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAlbum" class="form-control" id="nhapAlbum" placeholder="BORN PINK">
                  <label for="nhapAlbum" class="fw-medium">Album</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapNgheSi" class="form-control" id="nhapNgheSi" placeholder="BLACKPINK">
                  <label for="nhapNgheSi" class="fw-medium">Nghệ sĩ</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapTheLoai" class="form-control" id="nhapTheLoai" placeholder="Dance/ Electronic">
                  <label for="nhapTheLoai" class="fw-medium">Thể loại</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapChuDe" class="form-control" id="nhapChuDe" placeholder="Party">
                  <label for="nhapChuDe" class="fw-medium">Chủ đề</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="date" name="release_date" class="form-control fw-medium" id="release_date" placeholder="">
                  <label for="nhapNgayPhatHanh" class="fw-medium">Ngày phát hành</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="">
                  <label for="nhapAnh" class="fw-medium">Ảnh</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAudio" class="form-control" id="nhapAudio" placeholder="">
                  <label for="nhapAudio" class="fw-medium">Audio bài hát</label>
                </div>
                
                <div class="d-flex justify-content-end">
                  <button class="btn btn-outline-secondary mx-2 btn-lg " type="submit" name="btn-cancel"><a class="text-decoration-none text-black" href="admin_music.php?group=bai-hat">Hủy</a></button>
                  <button class="btn btn-primary btn-lg" name="btn_add_baihat" type="submit">Thêm mới</button>
                </div>
              </form>
              <?php

            }

            if ($group == "album")
            {?>
              <h1 class="mb-3" style="text-align: center">Thêm mới album</h1>

              <form name="frmCreate" method="post" action="admin_music_add.php" class="form">
                
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAlbum" class="form-control" id="nhapAlbum" placeholder="The Album">
                  <label for="nhapAlbum" class="fw-medium">Album</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapNgheSi" class="form-control" id="nhapNgheSi" placeholder="BLACKPINK">
                  <label for="nhapNgheSi" class="fw-medium">Nghệ sĩ</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="date" name="release_date" class="form-control fw-medium" id="release_date" placeholder="">
                  <label for="nhapNgayPhatHanh" class="fw-medium">Ngày phát hành</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="">
                  <label for="nhapAnh" class="fw-medium">Ảnh</label>
                </div>
                
                <div class="d-flex justify-content-end">
                  <button class="btn btn-outline-secondary mx-2 btn-lg " type="submit" name="btn-cancel"><a class="text-decoration-none text-black" href="admin_music.php?group=album">Hủy</a></button>
                  <button class="btn btn-primary btn-lg" name="btn_add_album" type="submit">Thêm mới</button>
                </div>
              </form>
              <?php
              
              //mysqli_close($conn);
            }

            if ($group == "nghe-si")
            {?>
              <h1 class="mb-3" style="text-align: center">Thêm mới nghệ sĩ</h1>
              <form name="frmCreate" method="post" action="admin_music_add.php" class="form">
                
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapNgheSi" class="form-control" id="nhapNgheSi" placeholder="BLACKPINK">
                  <label for="nhapNgheSi" class="fw-medium">Nghệ sĩ</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="">
                  <label for="nhapAnh" class="fw-medium">Ảnh</label>
                </div>
                
                <div class="d-flex justify-content-end">
                  <button class="btn btn-outline-secondary mx-2 btn-lg " type="submit" name="btn-cancel"><a class="text-decoration-none text-black" href="admin_music.php?group=nghe-si">Hủy</a></button>
                  <button class="btn btn-primary btn-lg" name="btn_add_nghesi" type="submit">Thêm mới</button>
                </div>
              </form>
              <?php
              
              //mysqli_close($conn);
            }

            if($group == "chu-de")
            {?>
              <h1 class="mb-3" style="text-align: center">Thêm mới chủ đề</h1>

              <form name="frmCreate" method="post" action="admin_music_add.php" class="form">
                
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapChuDe" class="form-control" id="nhapChuDe" placeholder="Party">
                  <label for="nhapChuDe" class="fw-medium">Chủ đề</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="">
                  <label for="nhapAnh" class="fw-medium">Ảnh</label>
                </div>
                
                <div class="d-flex justify-content-end">
                  <button class="btn btn-outline-secondary mx-2 btn-lg " type="submit" name="btn-cancel"><a class="text-decoration-none text-black" href="admin_music.php?group=chu-de">Hủy</a></button>
                  <button class="btn btn-primary btn-lg" name="btn_add_chude" type="submit">Thêm mới</button>
                </div>
              </form>
              <?php
              
              //mysqli_close($conn);
            }

            if($group == "the-loai")
            {?>
              <h1 class="mb-3" style="text-align: center">Thêm mới thể loại</h1>

              <form name="frmCreate" method="post" action="admin_music_add.php" class="form">
                
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapTheLoai" class="form-control" id="nhapTheLoai" placeholder="Dance/ Electronic">
                  <label for="nhapTheLoai" class="fw-medium">Thể loại</label>
                </div>
                <div class="form-group form-floating text-black mb-3">
                  <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="">
                  <label for="nhapAnh" class="fw-medium">Ảnh</label>
                </div>
                
                <div class="d-flex justify-content-end">
                  <button class="btn btn-outline-secondary mx-2 btn-lg " type="submit" name="btn-cancel"><a class="text-decoration-none text-black" href="admin_music.php?group=the-loai">Hủy</a></button>
                  <button class="btn btn-primary btn-lg" name="btn_add_theloai" type="submit">Thêm mới</button>
                </div>
              </form>
              <?php
             
              //mysqli_close($conn);
            }
          }
        ?>
      </div>
    </div>
  </main>
  <?php 
  //Bai hat
   if (isset($_POST["btn_add_baihat"])) {
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
      $flag = true;
      //Kiểm tra bài hát đã tồn tại chưa
      $result1 = mysqli_query($conn, "SELECT TenBaiHat FROM baihat WHERE TenBaiHat ='$baihat'");
      if (mysqli_num_rows($result1) > 0) {
        $flag = false;
        echo "<script>alert ('Đã tồn tại bài hát trong kho nhạc. Vui lòng thêm bài hát khác!');
        window.location.href='admin_music_add.php?group=bai-hat';
        </script>";
      }

      //Insert data
      if ($flag) {
        //check nghe si
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


        $sql = "INSERT INTO `baihat`(`TenBaiHat`, `HinhBaiHat`, `IdAlbum`, `IdTheLoai`, `IdChuDe`, `IdNgheSi`, `NgayPhatHanh`, `Audio`) 
                              VALUES ('$baihat', '$img' , '$idAlbum', '$idTheLoai', '$idChuDe', '$idNgheSi','$date','$audio')";
        $result3 = mysqli_query($conn, $sql);
        if ($result3) {
          echo "<script>
                                var result = confirm('Thêm mới thành công. Quay về trang quản lý bài hát?');
                                if (result){
                                    window.location.href='admin_music.php?group=bai-hat';
                                }
                                else{
                                    window.location.href='admin_music_add.php?group=bai-hat';
                                }
                                </script>";
        } else {
          echo "<script> alert ('Có lỗi trong quá trình thêm mới. Vui lòng thử lại!');
          window.location.href='admin_music_add.php?group=bai-hat';
          </script>";
        }
      }
    } else {
      echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!');
      window.location.href='admin_music_add.php?group=bai-hat'; </script>";
    }
  }
  
  // Album
  if (isset($_POST["btn_add_album"])) {
    $album = $_POST["nhapAlbum"];
    $nghesi = $_POST["nhapNgheSi"];
    $date = $_POST["release_date"];
    $img = $_POST["nhapAnh"];
    //Kiểm Tra value có rỗng không
    if (!empty($album) && !empty($nghesi) && !empty($date) && !empty($img)) {
      $flag = true;
      //Kiểm tra album đã tồn tại chưa
      $result1 = mysqli_query($conn, "SELECT TenAlbum FROM album WHERE TenAlbum ='$album'");
      if (mysqli_num_rows($result1) > 0) {
        $flag = false;
        echo "<script>alert ('Đã tồn tại album trong kho nhạc. Vui lòng thêm album khác!');
        window.location.href='admin_music_add.php?group=album';
        </script>";
      } 

      //Insert data
      if ($flag) {
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


        $sql = "INSERT INTO `album`(`TenAlbum`,`IdNgheSi`, `NgayPhatHanh`, `HinhAlbum`) VALUES ('$album','$idNgheSi','$date','$img')";
        $result3 = mysqli_query($conn, $sql);
        if ($result3) {
          echo "<script>
                                var result = confirm('Thêm mới thành công. Quay về trang quản lý album?');
                                if (result){
                                    window.location.href='admin_music.php?group=album';
                                }
                                else{
                                    window.location.href='admin_music_add.php?group=album';
                                }
                                </script>";
        } else {
          echo "<script> alert ('Có lỗi trong quá trình thêm mới. Vui lòng thử lại!');
          window.location.href='admin_music_add.php?group=album';
          </script>";
        }
      }
    } else {
      echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); 
      window.location.href='admin_music_add.php?group=album';</script>";
    }
  }

// Nghệ sĩ
if (isset($_POST["btn_add_nghesi"])) {
  $nghesi = $_POST["nhapNgheSi"];
  $img = $_POST["nhapAnh"];
  //Kiểm Tra value có rỗng không
  if (!empty($nghesi) && !empty($img)) {
    
    //Kiểm tra nghệ sĩ đã tồn tại chưa
    $result1 = mysqli_query($conn, "SELECT TenNgheSi FROM nghesi WHERE TenNgheSi ='$nghesi'");
    if (mysqli_num_rows($result1) > 0) {
      $flag = false;
      echo "<script>alert ('Đã tồn tại nghệ sĩ này. Vui lòng thêm nghệ sĩ khác!')</script>";
    } else {
      $flag = true;
    }

    //Insert data
    if ($flag) {
      $sql = "INSERT INTO `nghesi`(`TenNgheSi`, `HinhNgheSi`) VALUES ('$nghesi','$img')";
      $result3 = mysqli_query($conn, $sql);
      if ($result3) {
        echo "<script>
                              const result = confirm('Thêm mới thành công. Quay về trang quản lý nghệ sĩ?');
                              if (result){
                                  window.location.href='admin_music.php?group=nghe-si';
                              }
                              else{
                                  window.location.href='admin_music_add.php?group=nghe-si';
                              }
                              </script>";
      } else {
        echo "<script> alert ('Có lỗi trong quá trình thêm mới. Vui lòng thử lại!')</script>";
      }
    }
  } else {
    echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); </script>";
  }
}

//Chủ đề
if (isset($_POST["btn_add_chude"])) {
  $chude = $_POST["nhapChuDe"];
  $img = $_POST["nhapAnh"];
  //Kiểm Tra value có rỗng không
  if (!empty($chude) && !empty($img)) {
    
    //Kiểm tra chủ đề đã tồn tại chưa
    $result1 = mysqli_query($conn, "SELECT TenChuDe FROM chude WHERE TenChuDe ='$chude'");
    if (mysqli_num_rows($result1) > 0) {
      $flag = false;
      echo "<script>alert ('Đã tồn tại chủ đề này. Vui lòng thêm chủ đề khác!')</script>";
    } else {
      $flag = true;
    }

    //Insert data
    if ($flag) {
      $sql = "INSERT INTO `chude`(`TenChuDe`, `HinhChuDe`) VALUES ('$chude','$img')";
      $result3 = mysqli_query($conn, $sql);
      if ($result3) {
        echo "<script>
                              const result = confirm('Thêm mới thành công. Quay về trang quản lý chủ đề?');
                              if (result){
                                  window.location.href='admin_music.php?group=chu-de';
                              }
                              else{
                                  window.location.href='admin_music_add.php?group=chu-de';
                              }
                              </script>";
      } else {
        echo "<script> alert ('Có lỗi trong quá trình thêm mới. Vui lòng thử lại!')</script>";
      }
    }
  } else {
    echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); </script>";
  }
}

//Thể loại
if (isset($_POST["btn_add_theloai"])) {
  $theloai = $_POST["nhapTheLoai"];
  $img = $_POST["nhapAnh"];
  //Kiểm Tra value có rỗng không
  if (!empty($theloai) && !empty($img)) {
    
    //Kiểm tra thể loại đã tồn tại chưa
    $result1 = mysqli_query($conn, "SELECT TenTheLoai FROM theloai WHERE TenTheLoai ='$theloai'");
    if (mysqli_num_rows($result1) > 0) {
      $flag = false;
      echo "<script>alert ('Đã tồn tại thể loại này. Vui lòng thêm thể loại khác!')</script>";
    } else {
      $flag = true;
    }

    //Insert data
    if ($flag) {
      $sql = "INSERT INTO `theloai`(`TenTheLoai`, `HinhTheLoai`) VALUES ('$theloai','$img')";
      $result3 = mysqli_query($conn, $sql);
      if ($result3) {
        echo "<script>
                              const result = confirm('Thêm mới thành công. Quay về trang quản lý thể loại?');
                              if (result){
                                  window.location.href='admin_music.php?group=the-loai';
                              }
                              else{
                                  window.location.href='admin_music_add.php?group=the-loai';
                              }
                              </script>";
      } else {
        echo "<script> alert ('Có lỗi trong quá trình thêm mới. Vui lòng thử lại!')</script>";
      }
    }
  } else {
    echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); </script>";
  }
}
  ?>
  <?php 
  include('footer.php');
  ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="js/signup.js"></script>
</body>

</html>