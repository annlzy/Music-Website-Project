<?php
session_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/login.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <button class="bg-body-secondary border-start-0 rounded-end fs-4 mt-1" onclick="window.location.href='user_interface.php'">
        Trang chủ
        <i class="fa-solid fa-arrow-rotate-left fs-5 text-danger"></i>
    </button>
    <section class="vh-100 gradient-custom">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4">
                                <h2 class="fw-bold mb-5 text-uppercase">Đăng nhập</h2>

                                <form id="dangnhap" action="login.php" method="post">
                                    <div class="form-group form-floating text-black mb-3">
                                        <input type="email" class="form-control" id="nhapEmail" name="nhapEmail" placeholder="name@example.com">
                                        <label for="nhapEmail" class="fw-medium">Email</label>
                                    </div>
                                    <div class="input-group password_toggle">
                                        <div class=" form-floating text-black ">
                                            <input type="password" class="form-control" id="nhapPassword" name="nhapPassword" placeholder="nguyen123@">
                                            <label for="nhapPassword" class="fw-medium">Mật khẩu</label>
                                        </div>
                                        <button class="icon btn btn-light rounded-end input-group-text" id="btnPassword" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 576 512" class="icon_eye"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                                <path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zm151 118.3C226 97.7 269.5 80 320 80c65.2 0 118.8 29.6 159.9 67.7C518.4 183.5 545 226 558.6 256c-12.6 28-36.6 66.8-70.9 100.9l-53.8-42.2c9.1-17.6 14.2-37.5 14.2-58.7c0-70.7-57.3-128-128-128c-32.2 0-61.7 11.9-84.2 31.5l-46.1-36.1zM394.9 284.2l-81.5-63.9c4.2-8.5 6.6-18.2 6.6-28.3c0-5.5-.7-10.9-2-16c.7 0 1.3 0 2 0c44.2 0 80 35.8 80 80c0 9.9-1.8 19.4-5.1 28.2zm51.3 163.3l-41.9-33C378.8 425.4 350.7 432 320 432c-65.2 0-118.8-29.6-159.9-67.7C121.6 328.5 95 286 81.4 256c8.3-18.4 21.5-41.5 39.4-64.8L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5zm-88-69.3L302 334c-23.5-5.4-43.1-21.2-53.7-42.3l-56.1-44.2c-.2 2.8-.3 5.6-.3 8.5c0 70.7 57.3 128 128 128c13.3 0 26.1-2 38.2-5.8z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 576 512" class="icon_eye is_active"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                                <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <p class="small m-2 pb-lg-2 text-end"><a class="text-white-50 text-decoration-none" href="resetpass.php">Quên mật khẩu?</a></p>
                                    
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit" name="btn-login">Đăng Nhập</button>
                                    <hr class="my-4" />
                                </form>
                            </div>

                            <div>
                                <p class="mb-0 mt-5">
                                    Bạn chưa có tài khoản? <a href="signup.php" class="text-white-50 fw-bold text-decoration-none">Đăng Ký</a>
                                </p>
                            </div>
                            <?php
                            require_once "config.php";
                            if (isset($_POST["btn-login"])) {
                                $email = $_POST["nhapEmail"];
                                $password = $_POST["nhapPassword"];
                                $password = md5($password);
                                $rows1 = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' AND Password = '$password'");
                                $count1 = mysqli_num_rows($rows1);
                                if ($count1 == 1) {
                                    $_SESSION["email_user"] = $email;
                                    $_SESSION["password_user"] = $password;
                                    echo "<script>
                                            result = alert('Đăng nhập thành công');
                                            window.location.href='user_interface.php';
                                            </script>";
                                    }
                                    else {
                                    echo "<script>
                                            alert('Đăng nhập không thành công');
                                            window.location.href='login.php';
                                            </script>";
                                }
                            }
                            mysqli_close($conn);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="blur-bg hidden-blur"></div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
    <script src="js/popup.js"></script>
</body>

</html>