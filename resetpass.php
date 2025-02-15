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
    <button class="bg-body-secondary border-start-0 rounded-end fs-4 mt-1" onclick="window.location.href='user_interface.php'">
        Back
        <i class="fa-solid fa-arrow-rotate-left fs-5 text-danger"></i>
    </button>
    <section class="vh-100 gradient-custom">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-4 mt-md-4">

                                <h2 class="fw-bold mb-5 text-uppercase">Đặt lại mật khẩu</h2>
                                <form id="register-form" role="form" autocomplete="off" class="form" action="resetpass.php" method="post">

                                    <div class="form-floating text-black mb-5">
                                        <input type="email" class="form-control" id="nhapEmail" name="nhapEmail" placeholder="name@example.com">
                                        <label for="nhapEmail" class="fw-medium">Email</label>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit" name="btn-reset">Đặt lại mật khẩu</button>

                                </form>
                            </div>
                            <?php
                            require_once "config.php";
                            require_once "PHPmailer/Exception.php";
                            require_once "PHPmailer/PHPMailer.php";
                            require_once "PHPmailer/SMTP.php";

                            use PHPMailer\PHPMailer\PHPMailer;
                            use PHPMailer\PHPMailer\SMTP;
                            use PHPMailer\PHPMailer\Exception;

                            //hàm gửi mail
                            function fnSendMail($to, $subject, $content)
                            {
                                //Create an instance; passing `true` enables exceptions
                                $mail = new PHPMailer(true);

                                try {
                                    //Server settings
                                    $mail->isSMTP();                                            //Send using SMTP
                                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                    $mail->Username   = 'tinhvu37871887@gmail.com';                     //SMTP username
                                    $mail->Password   = 'mwqfilpfoagzqzvdm';                               //SMTP password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                    //Recipients
                                    $mail->setFrom('tinhvu37871887@gmail.com', 'Alice Music'); //gửi đi từ mail nào
                                    $mail->addAddress($to);     //Add a recipient

                                    //Content
                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = $subject;
                                    $mail->Body    = $content;

                                    $mail->send();
                                    echo "<script>alert('Gửi mail thành công.')</script>";
                                } catch (Exception $e) {
                                    echo $e;
                                }
                            }
                            function create_pass($chars)
                            {
                                $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
                                return substr(str_shuffle($data), 0, $chars);
                            }
                            if (isset($_POST["btn-reset"])) {
                                $email = $_POST["nhapEmail"];
                                $token = create_pass(8); 
                                $token = md5($token);
                                $sql="UPDATE user set token = '$token' where email = '$email'";
                                mysqli_query($conn,$sql);
                                $link = "<a href='localhost/alicemusicweb.ddns.net/reset.php?token=".$token."'>Link</a>"; //nhớ đổi đường dẫn
                                fnSendMail($email, 'Reset Password', 'MusicWebsite gửi bạn link để reset mật khẩu: '.$link);
                                
                                
                            }
                            mysqli_close($conn);

                            ?>
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