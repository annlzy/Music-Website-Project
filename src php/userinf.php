<?php
include('session.php');
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Thông Tin Người Dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/unserinf.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    require_once "config.php";
    $sql = "SELECT * FROM user WHERE IdUser = $login_session";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $permission = $row["level"];
    }
    ?>
    <div class="container card card-outline-secondary mt-3">
        <div class="card-header">
            <h3 class="mb-0">Thông tin người dùng</h3>
        </div>
        <div class="card-body">
            <form class="form" action="userinf.php" method="post">
                <div class="row mb-2 d-flex align-items-end">
                    <div class="col-lg-3">
                        <div class="card" style="width: 9rem; height: 9rem;">
                            <img src="<?php echo $row['Avatar'] ?>" name="nhapavatar" alt="hình đại diện">
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
                    <div class="form-group row mb-2">
                        <p class="small pb-lg-2 text-end"><a class="link-dark link-underline-opacity-25 link-underline-opacity-100-hover" href="changepass.php">Đổi mật khẩu</a></p>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9 d-flex justify-content-end">
                            <button class="btn btn-outline-secondary mx-2 btn-lg" name="btn-cancel"><a class="text-decoration-none text-black" href="<?php
                                                                                                                                                        if ($permission == "Admin") {
                                                                                                                                                            echo "admin_dashboard.php";
                                                                                                                                                        } else {
                                                                                                                                                            echo "user_interface.php";
                                                                                                                                                        }
                                                                                                                                                        ?>">Hủy</a></button>
                            <button class="btn btn-primary btn-lg" name="btn-save" type="submit">Lưu thay đổi</button>
                        </div>
                    </div>
            </form>
            <?php
            if (isset($_POST['btn-save'])) {
                $fullname = $_POST["nhapHoTen"];
                $username = $_POST["nhapTenTK"];
                $email = $_POST["nhapEmail"];
                $phone = $_POST["nhapsdt"];
                $birthday = $_POST["birthday"];
                $gender = $_POST["gender"];
                $avatar = $_POST["nhapavatar"];
                $id = $login_session;
                //KiemTra value có rỗng không
                if (!empty($fullname) && !empty($username) && !empty($email) && !empty($phone) && !empty($birthday) && !empty($gender) && !empty($id)) {
                    //update
                    $sql2 = "UPDATE user SET  Username='$username', TenNguoiDung ='$fullname', email='$email', phone ='$phone', birthday='$birthday', gender='$gender', Avatar ='$avatar' WHERE IdUser=$id;";
                    $result2 = mysqli_query($conn, $sql2);
                    if ($result2) {
                        echo "<script> alert ('Cập nhật thành công!')</script>";
                    } else {
                        echo "<script> alert ('Có lỗi trong quá trình cập nhật. Vui lòng thử lại!')</script>";
                    }
                } else {
                    echo "<script> alert ('Vui lòng nhập đầy đủ thông tin!'); </script>";
                }
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="js/userinf.js.js"></script>
</body>

</html>