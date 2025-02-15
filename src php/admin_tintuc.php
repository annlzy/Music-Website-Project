<?php
    include('session2.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quản lý Tin Tức</title>
	<link rel="shortcut icon" type="image/png" href="img/4472584.png" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="css/mystyle.css" />
	<link rel="stylesheet" href="css/dashboard.css" />
	<link rel="stylesheet" href="css/colormode.css" />
	<link rel="stylesheet" href="css/footer.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class='container-fluid'>
	<?php
	if ($permission_sess != "Admin") {
		header("location: login.php");
		die();
	}
    require_once "config.php";
	?>
	<main class='row'>
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
			<div class="main">
				<div class="content">
					<div class="container-fluid p-0" style='margin-top: 10px'>

						<h2 class="card mt-2 mb-3 p-2 bg-secondary-subtle border border-dark-subtle fw-bold" style='text-align:center'>Tin tức - Sự kiện âm nhạc</h2>
                        <div class=" d-flex justify-content-end">
                            <a class="text-decoration-none btn btn-primary" href="admin_tintuc_add.php"> <i class="fas fa-plus"></i> Thêm mới</a>
                        </div>
                        <div class="card-body text-center" style="padding: 10px; padding-left: 30px;">
                            <form>
                                <div class="form-group row mb-2 fw-bold">
                                    <label class="col-lg-2 col-form-label form-control-label">Hình ảnh</label>
                                    <label class="col-lg-4 col-form-label form-control-label">Sự kiện</label>
                                    <label class="col-lg-3 col-form-label form-control-label">Địa điểm</label>
                                    <label class="col-lg-2 col-form-label form-control-label">Thao tác</label>
                                </div>
                                <?php
                                    $sql = "SELECT * FROM tintuc ORDER BY IdTinTuc";
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
                                    $sql = "SELECT * FROM tintuc ORDER BY IdTinTuc limit $start,$limit";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <div class="form-group row mb-2">
                                                <div class="col-lg-2"><img src='<?php echo $row['HinhAnh'];?>' style = "width: 40px;"/></div>
                                                <div class="col-lg-4"><?php echo $row["TieuDe"] ?></div>
                                                <div class="col-lg-3"><?php echo $row["DiaDiem"] ?></div>
                                                <div class="col-lg-2">
                                                    <button class="btn btn-outline-dark" type="submit"><a class="text-decoration-none text-black" href="admin_tintuc_update.php?IdTinTuc=<?php echo $row['IdTinTuc'] ?>">Sửa</a></button>
                                                    <button class="btn btn-outline-dark" type="submit"><a class="text-decoration-none text-black" href="admin_tintuc_delete.php?IdTinTuc=<?php echo $row['IdTinTuc'] ?>">Xóa</a></button>

                                                </div>
                                            </div>
                                        <?php }
                                    }
                                
                                // mysqli_close($conn);
                                ?>
                            </form>
                        </div>
					</div>
				</div>
			</div>
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <?php
               echo "<li class='page-item ";
                if ($current_page == 1){
                    echo "disabled";
                }
                echo "'>
                    <a class='page-link' href='admin_tintuc.php?page=".($current_page - 1)."'>Previous</a>
                </li>";
                for ($i=1; $i <= $total_page; $i++) {
                    if ($i == $current_page){
                        echo "<li class='page-item active'>
                                <span class='page-link'>".$i."</span>
                            </li>";
                    }
                    else{
                        echo "<li class='page-item'><a class='page-link' href='admin_tintuc.php?page=".$i."'>".$i."</a></li>";
                    }
                }
                echo "<li class='page-item ";
                if ($current_page == $total_page){
                    echo "disabled";
                }
                echo "'>
                    <a class='page-link' href='admin_tintuc.php?page=".($current_page + 1)."'>Next</a>
                </li>";
                ?>
            </ul>
        </nav>
		</div>
	</main>

	<?php include("footer.php");?>
	<script src="js/calendar.js"></script>
</body>

</html>