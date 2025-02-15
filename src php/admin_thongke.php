<?php
include('session2.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Music</title>
  <link rel="shortcut icon" type="image/png" href="img/4472584.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="css/mystyle.css" />
  <link rel="stylesheet" href="css/dashboard.css" />
  <link rel="stylesheet" href="css/colormode.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class='container-fluid '>
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
		var element = document.getElementById("admin_thongke");
		element.classList.add("active");
		element.classList.remove("link-body-emphasis");
	</script>
    <!-- Làm trong thẻ div dưới này nè -->
    <div class="col-md-9 col-lg-10 col-sm bg-primary bg-opacity-10">
      <div class="main">
        <div class="content">
          <div class="p-0">

            <h1 class="card mt-2 mb-3 p-2 fw-bold">Thống kê</h1>

            <div class="row mb-3">
              <div class="col-xl-6 col-xxl-6 d-flex">
                <div class="card w-100">
                  <div class="card-body d-flex justify-content-center">
                    <div style="width: 35em;">
                      <canvas id="Chart1"></canvas>
                      <p class="text-center fw-bolder">Top 5 nghệ sĩ có lượt nghe cao nhất</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-6 col-xxl-6 d-flex">
                <div class="card w-100">
                  <div class="card-body d-flex justify-content-center">
                    <div style="width: 35em;">
                      <canvas id="Chart2"></canvas>
                      <p class="text-center fw-bolder">Top 5 chủ đề được nghe nhiều nhất</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="row mb-3">
              <div class="col-xl-6 col-xxl-6 d-flex">
                <div class="card w-100">
                  <div class="card-body d-flex justify-content-center align-items-end">
                    <div style="width: 35em;">
                      <canvas id="Chart3"></canvas>
                      <p class="text-center fw-bolder">Thống kê số album được phát hành mỗi tháng</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-6 col-xxl-6 d-flex">
                <div class="card w-100">
                  <div class="card-body d-flex justify-content-center">
                    <div style="width: 20em;">
                      <canvas id="Chart4"></canvas>
                      <p class="text-center fw-bolder">Thống kê giới tính user</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>


    <!--Lấy dữ liệu biểu đồ -->
    <?php
    require_once "config.php";
    //   Chart 1
    $sql = "SELECT b.`IdNgheSi`, n.TenNgheSi, SUM(`LuotNghe`) as total
				FROM `baihat` b, nghesi n 
				WHERE b.IdNgheSi = n.IdNgheSi
				GROUP BY n.TenNgheSi
				ORDER BY SUM(LuotNghe) DESC
				LIMIT 0, 5";
    $result = mysqli_query($conn, $sql);
    foreach ($result as $data) {
      $TenNS[] = $data['TenNgheSi'];
      $LuotNghe[] = $data['total'];
    }

    //   Chart 2
    $sql = "SELECT b.IdChuDe, c.TenChuDe, SUM(`LuotNghe`) as total
				FROM `baihat` b, chude c
				WHERE b.IdChuDe = c.IdChuDe
				GROUP BY c.TenChuDe
				ORDER BY SUM(LuotNghe) DESC
				LIMIT 0, 5";
    $result = mysqli_query($conn, $sql);
    foreach ($result as $data) {
      $TenCD[] = $data['TenChuDe'];
      $LuotNgheCD[] = $data['total'];
    }

    //   Chart 3
    $sql = "SELECT date_format(NgayPhatHanh, '%b') as mot, COUNT(IdAlbum) as count
				FROM `album` 
				GROUP BY mot
				ORDER BY month(NgayPhatHanh) ASC
                LIMIT 0,12";
    $result2 = mysqli_query($conn, $sql);
    foreach ($result2 as $data2) {
      $count[] = $data2['count'];
      $month[] = $data2['mot'];
    }

    //   Chart 4
    $sql = "SELECT COUNT(IdUser) as countgd, `gender` FROM `user` GROUP BY gender";
    $result2 = mysqli_query($conn, $sql);
    foreach ($result2 as $data2) {
      $gender[] = $data2['gender'];
      $countgd[] = $data2['countgd'];
    }
    ?>

    <!-- Tạo biểu đồ -->
    <script>
      //  Chart 1
      const labels1 = <?php echo json_encode($TenNS) ?>;
      const data1 = {
        labels: labels1,
        datasets: [{
          label: "Lượt nghe",
          data: <?php echo json_encode($LuotNghe) ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
          ],
          borderWidth: 1
        }]
      };

      const config1 = {
        type: 'bar',
        data: data1,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        },
      };

      var Chart1 = new Chart(
        document.getElementById('Chart1'),
        config1
      );

      //  Chart 2
      const labels2 = <?php echo json_encode($TenCD) ?>;
      const data2 = {
        labels: labels2,
        datasets: [{
          label: "Lượt nghe",
          data: <?php echo json_encode($LuotNgheCD) ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
          ],
          borderWidth: 1
        }]
      };

      const config2 = {
        type: 'bar',
        data: data2,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        },
      };

      var Chart2 = new Chart(
        document.getElementById('Chart2'),
        config2
      );

      //  Chart 3
      const labels3 = <?php echo json_encode($month) ?>;
      const data3 = {
        labels: labels3,
        datasets: [{
          label: 'Album',
          data: <?php echo json_encode($count) ?>,
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      };
      const config3 = {
        type: 'line',
        data: data3,
      };

      var Chart3 = new Chart(
        document.getElementById('Chart3'),
        config3
      );

      //  Chart 4
      const data4 = {
        labels: <?php echo json_encode($gender) ?>,
        datasets: [{
          label: 'Giới tính',
          data: <?php echo json_encode($countgd) ?>,
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(75, 192, 192)',
            'rgb(255, 205, 86)',
          ]
        }]
      };
      const config4 = {
        type: 'doughnut',
        data: data4,
        options: {}
      };

      var Chart4 = new Chart(
        document.getElementById('Chart4'),
        config4
      );
    </script>

  </main>
  <?php 
	include("footer.php");
	?>
  <script src="js/calendar.js"></script>
</body>

</html>
<?php
$sql = "SELECT `TenBaiHat`, HinhBaiHat, `Audio` , n.TenNgheSi
      FROM `baihat` b, nghesi n 
      WHERE b.IdNgheSi = n.IdNgheSi";
$result = mysqli_query($conn, $sql);
foreach ($result as $data) {
  $TenBH[] = $data['TenBaiHat'];
  $TenNS[] = $data['TenNgheSi'];
  $Audio[] = $data['Audio'];
  $Hinh[] = $data['HinhBaiHat'];
}
?>