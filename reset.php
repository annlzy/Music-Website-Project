<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quên Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/login.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php 
    function create_pass($chars)
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0, $chars);
    }
    if(isset($_GET['token'])){
        $token=$_GET['token'];
        require_once "config.php";
        $sql="SELECT * FROM user WHERE token ='$token'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            $user = mysqli_fetch_assoc($result);
            $email = $user['email'];
            $pass_new = create_pass(8);
            $pass_new_mh = md5($pass_new);
            $sql = " UPDATE user SET Password = '$pass_new_mh', token ='' WHERE email = '$email'";
            mysqli_query($conn, $sql);

        }
    }
    ?>
<section class="vh-100 gradient-custom">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-4 mt-md-4">
                                    <div class="mb-5 fs-3"><?php echo "Mật khẩu mới của bạn là:".$pass_new;?></div>
                                    <a class="btn btn-outline-light btn-lg px-1" href="changepass.php" type="submit" name="btn-changepass">Đổi mật khẩu</a>
                                    <a class="btn btn-outline-light btn-lg px-1" href="user_interface.php" type="submit" name="btn-home">Trang chủ</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="js/resetpass.js"></script>
</body>

</html>
