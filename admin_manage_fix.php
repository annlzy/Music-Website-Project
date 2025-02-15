<?php
include('session2.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cập nhật thông tin người dùng</title>
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
		var element = document.getElementById("admin_manage");
		element.classList.add("active");
		element.classList.remove("link-body-emphasis");
	</script>
    <!-- Làm trong thẻ div dưới này nè -->
    <div class="col-md-9 col-lg-10 col-sm">
      <?php
      require_once "config.php";
      if (isset($_GET['IdUser'])) {
        $id = $_GET['IdUser'];
        $sql = "SELECT * FROM user WHERE IdUser = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC); // lấy dữ liệu
        // Nếu không tìm thấy dữ liệu -> thông báo lỗi
        if (empty($row)) {
          echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
        }
      ?>
        <div class="container">
          <h1 class="mb-3">Cập nhật thông tin người dùng</h1>

          <form method="post" action="admin_manage_fix.php?IdUser=<?php echo $row['IdUser'] ?>" class="form">

            <div class="form-group form-floating mb-3">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="permission" id="user" value="User" <?php if ($row['level'] == 'User') echo 'checked = "checked"'; ?>>
                <label class="form-check-label" for="user">
                  User
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="permission" id="admin" value="Admin" <?php if ($row['level'] == 'Admin') echo 'checked = "checked"'; ?>>
                <label class="form-check-label" for="admin">
                  Admin
                </label>
              </div>
            </div>
            <div class="form-group form-floating text-black mb-3">
              <input type="text" name="nhapHoTen" class="form-control" id="nhapHoTen" placeholder="Nguyễn Văn A" value="<?php echo $row['TenNguoiDung'] ?>">
              <label for="nhapHoTen" class="fw-medium">Họ tên</label>
            </div>
            <div class="form-group form-floating text-black mb-3">
              <input type="text" name="nhapTenTK" class="form-control" id="nhapTenTK" placeholder="nguyenvana123" value="<?php echo $row['Username'] ?>">
              <label for="nhapTenTK" class="fw-medium">Tên tài khoản</label>
            </div>
            <div class="form-group form-floating text-black mb-3">
              <input type="email" name="nhapEmail" class="form-control" id="nhapEmail" placeholder="name@example.com" value="<?php echo $row['email'] ?>">
              <label for="nhapEmail" class="fw-medium">Email</label>
            </div>
            <div class="form-group form-floating text-black mb-3">
              <input type="phone_number" name="nhapsdt" class="form-control" id="nhapsdt" placeholder="0123456789" value="<?php echo $row['phone'] ?>">
              <label for="nhapsdt" class="fw-medium">Số điện thoại</label>
            </div>
            <div class="form-group form-floating mb-3">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="Male" value="Nam" <?php if ($row['gender'] == 'Nam') echo 'checked = "checked"'; ?>>
                <label class="form-check-label" for="Male">Nam</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="Female" value="Nữ" <?php if ($row['gender'] == 'Nữ') echo 'checked = "checked"'; ?>>
                <label class="form-check-label" for="Female">Nữ</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="Another" value="Khác" <?php if ($row['gender'] == 'Khác') echo 'checked = "checked"'; ?>>
                <label class="form-check-label" for="Another">Khác</label>
              </div>
            </div>
            <div class="form-group form-floating text-black mb-3">
              <input type="text" name="nhapavatar" class="form-control" id="nhapavatar" placeholder="" value="<?php echo $row['Avatar'] ?>">
              <label for="nhapavtar" class="fw-medium">Ảnh đại diện</label>
            </div>
            <div class="form-group form-floating text-black mb-3">
              <input type="date" name="birthday" class="form-control fw-medium" id="nhapngaysinh" placeholder="" value="<?php echo $row['birthday'] ?>">
              <label for="nhapngaysinh" class="fw-medium">Ngày Sinh</label>
            </div>
            <div class="input-group  password_toggle mb-3">
              <div class=" form-floating text-black ">
                <input type="password" name="nhapPassword1" class="form-control inpPassword" id="nhapPassword1" placeholder="nguyen123@">
                <label for="nhapPassword1" class="fw-medium">Mật khẩu</label>
              </div>
              <button class="icon btn btn-light rounded-end input-group-text btnPassword" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 576 512" class="icon_eye"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                  <path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zm151 118.3C226 97.7 269.5 80 320 80c65.2 0 118.8 29.6 159.9 67.7C518.4 183.5 545 226 558.6 256c-12.6 28-36.6 66.8-70.9 100.9l-53.8-42.2c9.1-17.6 14.2-37.5 14.2-58.7c0-70.7-57.3-128-128-128c-32.2 0-61.7 11.9-84.2 31.5l-46.1-36.1zM394.9 284.2l-81.5-63.9c4.2-8.5 6.6-18.2 6.6-28.3c0-5.5-.7-10.9-2-16c.7 0 1.3 0 2 0c44.2 0 80 35.8 80 80c0 9.9-1.8 19.4-5.1 28.2zm51.3 163.3l-41.9-33C378.8 425.4 350.7 432 320 432c-65.2 0-118.8-29.6-159.9-67.7C121.6 328.5 95 286 81.4 256c8.3-18.4 21.5-41.5 39.4-64.8L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5zm-88-69.3L302 334c-23.5-5.4-43.1-21.2-53.7-42.3l-56.1-44.2c-.2 2.8-.3 5.6-.3 8.5c0 70.7 57.3 128 128 128c13.3 0 26.1-2 38.2-5.8z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 576 512" class="icon_eye is_active"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                  <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                </svg>
              </button>
            </div>
            <div class="input-group password_toggle mb-3">
              <div class=" form-floating text-black ">
                <input type="password" name="nhapPassword2" class="form-control inpPassword" id="nhapPassword2" placeholder="nguyen123@">
                <label for="nhapPassword2" class="fw-medium">Nhập lại mật khẩu</label>
              </div>
              <button class="icon btn btn-light rounded-end input-group-text btnPassword" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 576 512" class="icon_eye"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                  <path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zm151 118.3C226 97.7 269.5 80 320 80c65.2 0 118.8 29.6 159.9 67.7C518.4 183.5 545 226 558.6 256c-12.6 28-36.6 66.8-70.9 100.9l-53.8-42.2c9.1-17.6 14.2-37.5 14.2-58.7c0-70.7-57.3-128-128-128c-32.2 0-61.7 11.9-84.2 31.5l-46.1-36.1zM394.9 284.2l-81.5-63.9c4.2-8.5 6.6-18.2 6.6-28.3c0-5.5-.7-10.9-2-16c.7 0 1.3 0 2 0c44.2 0 80 35.8 80 80c0 9.9-1.8 19.4-5.1 28.2zm51.3 163.3l-41.9-33C378.8 425.4 350.7 432 320 432c-65.2 0-118.8-29.6-159.9-67.7C121.6 328.5 95 286 81.4 256c8.3-18.4 21.5-41.5 39.4-64.8L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5zm-88-69.3L302 334c-23.5-5.4-43.1-21.2-53.7-42.3l-56.1-44.2c-.2 2.8-.3 5.6-.3 8.5c0 70.7 57.3 128 128 128c13.3 0 26.1-2 38.2-5.8z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 576 512" class="icon_eye is_active"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                  <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                </svg>
              </button>
            </div>
            <div class="d-flex justify-content-end">
              <button class="btn btn-outline-secondary mx-2 btn-lg" type="submit" name="btn-cancel"><a class="text-decoration-none text-black" href="admin_manage.php">Hủy</a></button>
              <button class="btn btn-primary btn-lg" name="btn-fix" type="submit">Cập Nhật</button>
            </div>
          </form>
        <?php

        if (isset($_POST['btn-fix'])) {
          $permission = $_POST["permission"];
          $fullname = $_POST["nhapHoTen"];
          $username = $_POST["nhapTenTK"];
          $email = $_POST["nhapEmail"];
          $phone = $_POST["nhapsdt"];
          $birthday = $_POST["birthday"];
          $gender = $_POST["gender"];
          $avatar = $_POST["nhapavatar"];
          $password = $_POST["nhapPassword1"];
          $re_password = $_POST["nhapPassword2"];
          //KiemTra value có rỗng không
          if (!empty($fullname) && !empty($username) && !empty($email) && !empty($phone) && !empty($birthday) && !empty($gender) && !empty($id)) {
            if (!empty($password) && !empty($re_password)) {
              //Kiểm tra mật khẩu trùng khớp chưa
              if ($password != $re_password) {
                echo "<script> alert ('Mật khẩu nhập lại chưa trùng khớp, vui lòng nhập lại!'); </script>";
              } else {
                // Mã hóa mật khẩu
                $password = md5($password);
              }
              //update
              $sql2 = "UPDATE user SET  Username='$username', level='$permission', TenNguoiDung ='$fullname', email='$email', phone ='$phone', birthday='$birthday', gender='$gender', Avatar ='$avatar', Password='$password' WHERE IdUser=$id;";
              $result2 = mysqli_query($conn, $sql2);
              if ($result2) {
                echo "<script> alert ('Cập nhật thành công!'); window.location.href='admin_manage.php';                        </script>";
              } else {
                echo "<script> alert ('Có lỗi trong quá trình cập nhật. Vui lòng thử lại!')</script>";
              }
            } else {
              $sql3 = "UPDATE user SET  Username='$username', level='$permission', TenNguoiDung ='$fullname', email='$email', phone ='$phone', birthday='$birthday', gender='$gender', Avatar ='$avatar' WHERE IdUser=$id;";
              $result3 = mysqli_query($conn, $sql3);
              if ($result3) {
                echo "<script> alert ('Cập nhật thành công!');window.location.href='admin_manage.php';</script>";
              } else {
                echo "<script> alert ('Có lỗi trong quá trình cập nhật. Vui lòng thử lại!')</script>";
              }
            }
          } else {
            echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); </script>";
          }
        }

        mysqli_close($conn);
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