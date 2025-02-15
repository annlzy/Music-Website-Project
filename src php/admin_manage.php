<?php
include('session2.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý thông tin người dùng</title>
  <link rel="shortcut icon" type="image/png" href="img/4472584.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="css/mystyle.css" />
  <link rel="stylesheet" href="css/colormode.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<body class='container-fluid'>
  <?php
  if ($permission_sess != "Admin") {
    header("location: login.php");
    die();
  }
  ?>
  <main class=" row">
    <?php
    include('sidebar_admin.php');
    require_once 'config.php';
    ?>
    <script>
      var element = document.getElementById("admin_manage");
      element.classList.add("active");
      element.classList.remove("link-body-emphasis");
    </script>
    <!-- Làm trong thẻ div dưới này nè -->
    <div class="col-md-9 col-lg-10 col-sm">
  <?php include("search_user.php"); ?>

      <div class="card card-outline-secondary ">
        <div class="card-header">
          <h1 class="mb-0"> Quản lý tài khoản người dùng</h1>
          <div class=" d-flex justify-content-end">
            <a class="text-decroation-none btn btn-primary" href="admin_manage_add.php" name="add-user"> <i class="fas fa-plus"></i> Thêm người dùng</a>
          </div>
        </div>
        <div class="card-body text-center" style="white-space: nowrap;">
          <form>
            <div class="form-group row mb-2 fw-bold">
              <label class="col-lg-2 col-form-label form-control-label">Tài khoản</label>
              <label class="col-lg-2 col-form-label form-control-label">Họ tên</label>
              <label class="col-lg-3 col-form-label form-control-label">Email</label>
              <label class="col-lg-2 col-form-label form-control-label">Số điện thoại</label>
              <label class="col-lg-1 col-form-label form-control-label">Vai trò</label>

            </div>
            <?php
            $sql_count = "SELECT COUNT(IdUser) as Total FROM `user`";
            $result = mysqli_query($conn, $sql_count);
            $row = mysqli_fetch_assoc($result);
            $total_records = $row['Total'];
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $limit = 10;
            $total_page = ceil($total_records / $limit);
            if ($current_page > $total_page) {
              $current_page = $total_page;
            } else if ($current_page < 1) {
              $current_page = 1;
            }
            $start = ($current_page - 1) * $limit;
            //hiển thị người dùng
            // $sql = "SELECT Username, TenNguoiDung, email, phone, IdUser, level FROM user ORDER BY level ASC limit $start,$limit";
            $sql = $sql . " limit $start,$limit";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="form-group row mb-2">
                  <div class="col-lg-2"><?php echo $row["Username"] ?></div>
                  <div class="col-lg-2"><?php echo $row["TenNguoiDung"] ?></div>
                  <div class="col-lg-3"><?php echo $row["email"] ?></div>
                  <div class="col-lg-2"><?php echo $row["phone"] ?></div>
                  <div class="col-lg-1"><?php echo $row["level"] ?></div>
                  <div class="col-lg-2">
                    <button class="btn btn-outline-dark" type="submit"><a class="text-decoration-none text-black" href="admin_manage_fix.php?IdUser=<?php echo $row['IdUser'] ?>">Sửa</a></button>
                    <button class="btn btn-outline-dark" type="submit"><a class="text-decoration-none text-black" href="admin_manage_delete.php?IdUser=<?php echo $row['IdUser'] ?>">Xóa</a></button>

                  </div>
                </div>
            <?php }
            }
            // phân trang

            mysqli_close($conn);
            ?>
          </form>
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <?php
              echo "<li class='page-item ";
              if ($current_page == 1) {
                echo "disabled";
              }
              echo "'>
                              <a class='page-link' href='admin_manage.php?page=" . ($current_page - 1) . "'>Previous</a>
                          </li>";
              for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $current_page) {
                  echo "<li class='page-item active' aria-current='page'>
                                          <span class='page-link'>" . $i . "</span>
                                      </li>";
                } else {
                  echo "<li class='page-item'><a class='page-link' href='admin_manage.php?page=" . $i . "'>" . $i . "</a></li>";
                }
              }
              echo "<li class='page-item ";
              if ($current_page == $total_page) {
                echo "disabled";
              }
              echo "'>
                              <a class='page-link' href='admin_manage.php?page=" . ($current_page + 1) . "'>Next</a>
                          </li>";
              ?>
            </ul>
          </nav>
        </div>
      </div>

    </div>
  </main>
  <?php
  include("footer.php");
  ?>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>