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
  <title>Thêm mới sự kiện</title>
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
  <main class="row">
    <?php
    include('sidebar_admin.php');
    ?>
    <script>
		var element = document.getElementById("admin_tintuc");
		element.classList.add("active");
		element.classList.remove("link-body-emphasis");
	</script>
    <!-- Làm trong thẻ div dưới này nè -->
    <div class="col-md-9 col-lg-10 col-sm">
    <div class="">
        <h1 class="mb-3"style='text-align:center'>Thêm mới sự kiện</h1>

        <form name="frmCreate" method="post" action="admin_tintuc_add.php" class="form">

          <div class="form-group form-floating text-black mb-3">
            <input type="text" name="nhapTieuDe" class="form-control" id="nhapTieuDe" placeholder="Tên sự kiện">
            <label for="nhapTieuDe" class="fw-medium">Tiêu đề</label>
          </div>
          <div class="form-group form-floating text-black mb-3">
            <input type="text" name="nhapAnh" class="form-control" id="nhapAnh" placeholder="">
            <label for="nhapAnh" class="fw-medium">Ảnh sự kiện</label>
          </div>
          <div class="form-group form-floating text-black mb-3">
            <input type="text" name="nhapDiaDiem" class="form-control fw-medium" id="nhapDiaDiem" placeholder="Bắc Kinh">
            <label for="nhapDiaDiem" class="fw-medium">Địa điểm</label>
          </div>

          <div class="d-flex justify-content-end">
            <button class="btn btn-outline-secondary mx-2 btn-lg " type="submit" name="btn-cancel"><a class="text-decoration-none text-black" href="admin_tintuc.php">Hủy</a></button>
            <button class="btn btn-primary btn-lg" name="btn_add" type="submit">Thêm mới</button>
          </div>
        </form>
        <?php
        require_once "config.php";
        if (isset($_POST["btn_add"])) {
          $tieude = $_POST["nhapTieuDe"];
          $anh = $_POST["nhapAnh"];
          $diadiem = $_POST["nhapDiaDiem"];
          //KiemTra value có rỗng không
          if (!empty($tieude) && !empty($anh) && !empty($diadiem)) {
            //Kiểm tra sự kiện này đã có trên hệ thống chưa
            $result1 = mysqli_query($conn, "SELECT TieuDe FROM tintuc WHERE TieuDe = '$tieude'");
            if (mysqli_num_rows($result1) > 0) {
              $flag = false;
              echo "<script>alert ('Đã có sự kiện này trên hệ thống. Vui lòng nhập sự kiện khác!')</script>";
              exit();
            } else {
              $flag = true;
            }

            //Insert data
            if ($flag) {
              $sql = "INSERT INTO `tintuc` (`TieuDe`, `HinhAnh`, `DiaDiem`) VALUE ('$tieude', '$anh', '$diadiem')";
              $result3 = mysqli_query($conn, $sql);
              if ($result3) {
                echo "<script>
                                      const result = confirm('Thêm mới thành công. Quay về trang quản lý sự kiện?');
                                      if (result){
                                          window.location.href='admin_tintuc.php';
                                      }
                                      else{
                                          window.location.href='admin_tintuc_add.php';
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

        mysqli_close($conn);

        ?>
      </div>
    </div>
  </main>
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1 ps-4">
        <i class="bi bi-music-note-list"></i>
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="mt-3 pe-3"><a class="text-body-secondary text-decoration-none" href="#"><i class="fa-brands fa-google-play fs-3"></i> Google Play</a></li>
      <li class="mt-3 pe-3"><a class="text-body-secondary text-decoration-none" href="#"><i class="fa-brands fa-app-store-ios fs-3"></i> App Store</a></li>
      <li class="mt-3 pe-3"><a class="text-body-secondary text-decoration-none" href="#"><i class="fa-brands fa-windows fs-3"></i> Window</a></li>
    </ul>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="js/signup.js"></script>
</body>

</html>