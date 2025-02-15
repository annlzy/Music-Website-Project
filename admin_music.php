<?php
include('session2.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý nhạc</title>
  <link rel="shortcut icon" type="image/png" href="img/4472584.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="css/mystyle.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/colormode.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     
</head>

<body class='container-fluid'>
<?php 
	if ($permission_sess != "Admin") {
		header("location: login.php");
		die();
	}
    require_once "config.php";
    if(isset($_GET['group']))
    {
        $group = $_GET['group'];
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
      <div class="card card-outline-secondary ">
        <div class="card-header">
            <nav class="navbar navbar-expand-lg navbar-white">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavAltMarkup">
                        <div class="navbar-nav fs-2 ">
                            <a id="baihat" class="<?php if ($group == "bai-hat") echo "active"; ?> btn btn-outline-primary fs-3 me-4" href="admin_music.php?group=bai-hat">Bài hát</a>
                            <a id="album" class="<?php if ($group == "album") echo "active"; ?> btn btn-outline-primary fs-3 me-4" href="admin_music.php?group=album">Album</a>
                            <a id="nghesi" class="<?php if ($group == "nghe-si") echo "active"; ?> btn btn-outline-primary fs-3 me-4" href="admin_music.php?group=nghe-si">Nghệ sĩ</a>
                            <a id="chude" class="<?php if ($group == "chu-de") echo "active"; ?> btn btn-outline-primary fs-3 me-4" href="admin_music.php?group=chu-de">Chủ đề</a>
                            <a id="theloai" class="<?php if ($group == "the-loai") echo "active"; ?> btn btn-outline-primary fs-3 me-4" href="admin_music.php?group=the-loai">Thể loại</a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class=" d-flex justify-content-end">
                <?php
                    if(isset($_GET['group']))
                    {
                        $group = $_GET['group'];
                        if($group == "bai-hat")
                        {
                            ?><a class="text-decoration-none btn btn-primary" href="admin_music_add.php?group=bai-hat"> <i class="fas fa-plus"></i> Thêm mới</a><?php
                        }
                        else if($group == "album")
                        {
                            ?><a class="text-decoration-none btn btn-primary" href="admin_music_add.php?group=album"> <i class="fas fa-plus"></i> Thêm mới</a><?php
                        }
                        else if($group == "nghe-si")
                        {
                            ?><a class="text-decoration-none btn btn-primary" href="admin_music_add.php?group=nghe-si"> <i class="fas fa-plus"></i> Thêm mới</a><?php
                        }
                        else if($group == "chu-de")
                        {
                            ?><a class="text-decoration-none btn btn-primary" href="admin_music_add.php?group=chu-de"> <i class="fas fa-plus"></i> Thêm mới</a><?php
                        }
                        else if($group == "the-loai")
                        {
                            ?><a class="text-decoration-none btn btn-primary" href="admin_music_add.php?group=the-loai"> <i class="fas fa-plus"></i> Thêm mới</a><?php
                        }
                    }
                    ?>
                    <!--<a class="text-decoration-none btn btn-primary" href="admin_music_add.php" name="add-music"> <i class="fas fa-plus"></i> Thêm mới</a>-->
            </div>
        </div>
        
        <div class="card-body text-center ms-4" style="white-space: nowrap;">
            <?php
                if(isset($_GET['group']))
                {
                    $group = $_GET['group'];
                    if($group == "bai-hat")
                    {?>
                        <form>
                            <div class="form-group row mb-2 fw-bold">
                                <label class="col-lg-1 col-form-label form-control-label">Hình ảnh</label>
                                <label class="col-lg-3 col-form-label form-control-label">Tên bài hát</label>
                                <label class="col-lg-2 col-form-label form-control-label">Nghệ sĩ</label>
                                <label class="col-lg-3 col-form-label form-control-label">Album</label>
                                <label class="col-lg-1 col-form-label form-control-label">Ngày phát hành</label>
                                <label class="col-lg-2 col-form-label form-control-label">Thao tác</label>
                            </div>
                            <?php
                                $sql = "SELECT b.IdBaiHat, `TenBaiHat`, `HinhBaiHat`, b.`NgayPhatHanh`, n.TenNgheSi , a.TenAlbum
                                FROM baihat b, nghesi n, album a 
                                WHERE n.IdNgheSi = b.IdNgheSi AND a.IdAlbum = b.IdAlbum ORDER BY IdBaiHat";
                                //dùng chung
                                $result = mysqli_query($conn, $sql);
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $limit = 10;
                                $total_records = mysqli_num_rows($result);
                                $total_page = ceil($total_records / $limit);
                                if ($current_page > $total_page) {
                                    $current_page = $total_page;
                                } 
                                else if ($current_page < 1) {
                                    $current_page = 1;
                                }
                                $start = ($current_page - 1) * $limit;
                                //hiển thị
                                $sql = "SELECT b.IdBaiHat, `TenBaiHat`, `HinhBaiHat`, b.`NgayPhatHanh`, n.TenNgheSi , a.TenAlbum
                                FROM baihat b, nghesi n, album a 
                                WHERE n.IdNgheSi = b.IdNgheSi AND a.IdAlbum = b.IdAlbum ORDER BY IdBaiHat ASC limit $start,$limit";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <div class="form-group row mb-2">
                                            <div class="col-lg-1"><img src='<?php echo $row['HinhBaiHat'];?>' style = "width: 2.5em;"/></div>
                                            <div class="col-lg-3"><?php echo $row["TenBaiHat"] ?></div>
                                            <div class="col-lg-2"><?php echo $row["TenNgheSi"] ?></div>
                                            <div class="col-lg-3"><?php echo $row["TenAlbum"] ?></div>
                                            <div class="col-lg-1"><?php echo $row["NgayPhatHanh"] ?></div>
                                            <div class="col-lg-2">
                                               <a class="btn btn-outline-dark text-decoration-none text-black" href="admin_music_update.php?group=bai-hat&IdBaiHat=<?php echo $row['IdBaiHat'] ?>">Sửa</a>
                                                <a class="btn btn-outline-dark text-decoration-none text-black" href="admin_music_delete.php?group=bai-hat&IdBaiHat=<?php echo $row['IdBaiHat'] ?>">Xóa</a>

                                            </div>
                                        </div>
                                    <?php }
                                }
                            
                            // mysqli_close($conn);
                            ?>
                        </form> <!--hết form-->
                        <!-- phân trang-->
                        
                        <?php
                    }     

                    else if($group == "album")
                    {?>
                        <form>
                        <div class="form-group row mb-2 fw-bold">
                            <label class="col-lg-1 col-form-label form-control-label">Hình ảnh</label>
                            <label class="col-lg-4 col-form-label form-control-label">Album</label>
                            <label class="col-lg-2 col-form-label form-control-label">Nghệ sĩ</label>
                            <label class="col-lg-2 col-form-label form-control-label">Ngày phát hành</label>
                            <label class="col-lg-3 col-form-label form-control-label">Thao tác</label>
                        </div>
                            <?php
                                $sql = "SELECT a.IdAlbum, TenAlbum, HinhAlbum, NgayPhatHanh, n.TenNgheSi
                                FROM album a, nghesi n
                                WHERE n.IdNgheSi = a.IdNgheSi";
                                //dùng chung
                                $result = mysqli_query($conn, $sql);
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $limit = 10;
                                $total_records = mysqli_num_rows($result);
                                $total_page = ceil($total_records / $limit);
                                if ($current_page > $total_page) {
                                    $current_page = $total_page;
                                } 
                                else if ($current_page < 1) {
                                    $current_page = 1;
                                }
                                $start = ($current_page - 1) * $limit;
                                //hiển thị
                                $sql = "SELECT a.IdAlbum, TenAlbum, HinhAlbum, NgayPhatHanh, n.TenNgheSi
                                FROM album a, nghesi n
                                WHERE n.IdNgheSi = a.IdNgheSi ORDER BY IdAlbum ASC limit $start,$limit";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <div class="form-group row mb-2">
                                        <div class="col-lg-1"><img src='<?php echo $row['HinhAlbum'];?>' style = "width: 2.5em;"/></div>
                                        <div class="col-lg-4"><?php echo $row["TenAlbum"] ?></div>
                                        <div class="col-lg-2"><?php echo $row["TenNgheSi"] ?></div>
                                        <div class="col-lg-2"><?php echo $row["NgayPhatHanh"] ?></div>
                                        <div class="col-lg-3">
                
                                            <a class="btn btn-outline-dark" href="admin_music_update.php?group=album&IdAlbum=<?php echo $row['IdAlbum'] ?>">Sửa</a>
                                            <a class="btn btn-outline-dark" href="admin_music_delete.php?group=album&IdAlbum=<?php echo $row['IdAlbum'] ?>">Xóa</a>

                                        </div>
                                    </div>
                                <?php }
                                }
                            
                            // mysqli_close($conn);
                            ?>
                        </form> <!--hết form-->
                        
                        <?php
                    }
                        
                    else if($group == "nghe-si")
                    {?>
                        <form>
                            <div class="form-group row mb-2 fw-bold">
                                <label class="col-4 col-form-label form-control-label">Hình ảnh</label>
                                <label class="col-4 col-form-label form-control-label">Nghệ sĩ</label>
                                <label class="col-4 col-form-label form-control-label">Thao tác</label>
                            </div>
                            <?php
                                $sql = "SELECT * FROM nghesi ORDER BY IdNgheSi";
                                //dùng chung
                                $result = mysqli_query($conn, $sql);
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $limit = 10;
                                $total_records = mysqli_num_rows($result);
                                $total_page = ceil($total_records / $limit);
                                if ($current_page > $total_page) {
                                    $current_page = $total_page;
                                } 
                                else if ($current_page < 1) {
                                    $current_page = 1;
                                }
                                $start = ($current_page - 1) * $limit;
                                //hiển thị
                                $sql = "SELECT * FROM nghesi ORDER BY IdNgheSi ASC limit $start,$limit";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <div class="form-group row mb-2">
                                        <div class="col-4"><img src='<?php echo $row['HinhNgheSi'];?>' style = "width: 2.5em;"/></div>
                                        <div class="col-4"><?php echo $row["TenNgheSi"] ?></div>
                                        <div class="col-4">
                                            <a class="btn btn-outline-dark text-decoration-none text-black" href="admin_music_update.php?group=nghe-si&IdNgheSi=<?php echo $row['IdNgheSi'] ?>">Sửa</a>
                                            <a class="btn btn-outline-dark text-decoration-none text-black" href="admin_music_delete.php?group=nghe-si&IdNgheSi=<?php echo $row['IdNgheSi'] ?>">Xóa</a>

                                        </div>
                                    </div>
                                <?php }
                                }
                            
                           // mysqli_close($conn);
                            ?>
                        </form> <!--hết form-->
                        
                    <?php
                    }
                       
                    else if($group == "chu-de")
                    {?>
                        <form>
                            <div class="form-group row mb-2 fw-bold">
                                <label class="col-4 col-form-label form-control-label">Hình ảnh</label>
                                <label class="col-4 col-form-label form-control-label">Chủ đề</label>
                                <label class="col-4 col-form-label form-control-label">Thao tác</label>
                            </div>
                            <?php
                                $sql = "SELECT * FROM chude ORDER BY IdChuDe";
                                //dùng chung
                                $result = mysqli_query($conn, $sql);
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $limit = 10;
                                $total_records = mysqli_num_rows($result);
                                $total_page = ceil($total_records / $limit);
                                if ($current_page > $total_page) {
                                    $current_page = $total_page;
                                } 
                                else if ($current_page < 1) {
                                    $current_page = 1;
                                }
                                $start = ($current_page - 1) * $limit;
                                //hiển thị
                                $sql = "SELECT * FROM chude ORDER BY IdChuDe ASC";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <div class="form-group row mb-2">
                                        <div class="col-4"><img src='<?php echo $row['HinhChuDe'];?>' style = "width: 2.5em;"/></div>
                                        <div class="col-4"><?php echo $row["TenChuDe"] ?></div>
                                        <div class="col-4">
                                            <a class="btn btn-outline-dark text-decoration-none text-black" href="admin_music_update.php?group=chu-de&IdChuDe=<?php echo $row['IdChuDe'] ?>">Sửa</a>
                                            <a class="btn btn-outline-dark text-decoration-none text-black" href="admin_music_delete.php?group=chu-de&IdChuDe=<?php echo $row['IdChuDe'] ?>">Xóa</a>

                                        </div>
                                    </div>
                                <?php }
                                }
                            
                          //  mysqli_close($conn);
                            ?>
                        </form> <!--hết form-->
                    <?php
                    }
                        
                    else if($group == "the-loai")
                    {?>
                        <form>
                            <div class="form-group row mb-2 fw-bold">
                                <label class="col-4 col-form-label form-control-label">Hình ảnh</label>
                                <label class="col-4 col-form-label form-control-label">Thể loại</label>
                                <label class="col-4 col-form-label form-control-label">Thao tác</label>
                            </div>
                            <?php
                                $sql = "SELECT * FROM theloai ORDER BY IdTheLoai";
                                //dùng chung
                                $result = mysqli_query($conn, $sql);
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $limit = 10;
                                $total_records = mysqli_num_rows($result);
                                $total_page = ceil($total_records / $limit);
                                if ($current_page > $total_page) {
                                    $current_page = $total_page;
                                } 
                                else if ($current_page < 1) {
                                    $current_page = 1;
                                }
                                $start = ($current_page - 1) * $limit;
                                //hiển thị
                                $sql = "SELECT * FROM theloai ORDER BY IdTheLoai ASC";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <div class="form-group row mb-2">
                                        <div class="col-4"><img src='<?php echo $row['HinhTheLoai'];?>' style = "width: 2.5em;"/></div>
                                        <div class="col-4"><?php echo $row["TenTheLoai"] ?></div>
                                        <div class="col-4">
                                            <a class="btn btn-outline-dark text-decoration-none text-black" href="admin_music_update.php?group=the-loai&IdTheLoai=<?php echo $row['IdTheLoai'] ?>">Sửa</a>
                                            <a class="btn btn-outline-dark text-decoration-none text-black" href="admin_music_delete.php?group=the-loai&IdTheLoai=<?php echo $row['IdTheLoai'] ?>">Xóa</a>

                                        </div>
                                    </div>
                                <?php }
                                }
                            
                          //  mysqli_close($conn);
                            ?>
                        </form> <!--hết form-->
                    <?php
                    }

                    ?>
                    <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                            <?php
                            echo "<li class='page-item ";
                            if ($current_page == 1) {
                                echo "disabled";
                            }
                            echo "'>
                                            <a class='page-link' href='admin_music.php?group=".$group."&page=" . ($current_page - 1) . "'>Previous</a>
                                        </li>";
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $current_page) {
                                echo "<li class='page-item active' aria-current='page'>
                                                        <span class='page-link'>" . $i . "</span>
                                                    </li>";
                                } else {
                                echo "<li class='page-item'><a class='page-link' href='admin_music.php?group=".$group."&page=" . $i . "'>" . $i . "</a></li>";
                                }
                            }
                            echo "<li class='page-item ";
                            if ($current_page == $total_page) {
                                echo "disabled";
                            }
                            echo "'>
                                            <a class='page-link' href='admin_music.php?group=".$group."&page=" . ($current_page + 1) . "'>Next</a>
                                        </li>";
                            ?>
                            </ul>
                        </nav> <!--hết phân trang-->  
                    <?php
                }
            ?>
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