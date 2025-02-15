<?php
include('session2.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>
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

<body class="container-fluid">
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
		var element = document.getElementById("admin_dashboard");
		element.classList.add("active");
		element.classList.remove("link-body-emphasis");
	</script>
		<!-- Làm trong thẻ div dưới này nè -->
		<div class="col-md-9 col-lg-10 col-sm bg-primary bg-opacity-10">
			<div class="main">
				<div class="content">
					<div class="container-fluid p-0">

						<h1 class="card mt-2 mb-3 p-2 fw-bold">Dashboard</h1>

						<div class="row">
							<?php
							$sql1 = "SELECT COUNT(`IdBaiHat`) as count FROM `baihat`";
							$sql2 = "SELECT COUNT(`IdUser`) as count FROM `user` WHERE level = 'User'";
							$sql3 = "SELECT COUNT(`IdNgheSi`) as count FROM `nghesi`";
							$sql4 = "SELECT COUNT(`IdUser`) as count FROM `user` WHERE level = 'Admin'";
							?>
							<div class="col-xl-6 col-xxl-5 d-flex">
								<div class="w-100">
									<div class="row">
										<div class="col-sm-6">
											<div class="card mb-3">
												<div class="card-body row align-items-center">
													<div class="col-3 ">
														<i class="fa-solid fa-music fs-2 ps-2" style="color: rgb(255, 99, 132);"></i>
													</div>
													<div class="col-9">
														<div class="row">
															<div class="col mt-0">
																<h5 class="card-title">Total songs</h5>
															</div>
														</div>

														<?php
														$result = mysqli_query($conn, $sql1);
														if (mysqli_num_rows($result) > 0) {
															while ($row = mysqli_fetch_assoc($result)) {
																echo "<h1 class='mt-1 mb-3'>" . $row['count'] . "</h1>";
															}
														}
														?>

														<div class="mb-0">
															<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> </span>
															<span class="text-success">Now</span>
														</div>
													</div>
												</div>
											</div>
											<div class="card mb-3">
												<div class="card-body row align-items-center">
													<div class='col-3'>
														<i class="fa-solid fa-user fs-2 ps-2" style="color: rgb(255, 159, 64);"></i>
													</div>
													<div class='col-9'>
														<div class="row">
															<div class="col mt-0">
																<h5 class="card-title">User</h5>
															</div>

															<div class="col-auto">
																<div class="stat text-primary">
																	<i class="align-middle" data-feather="users"></i>
																</div>
															</div>
														</div>
														<?php
														$result = mysqli_query($conn, $sql2);
														if (mysqli_num_rows($result) > 0) {
															while ($row = mysqli_fetch_assoc($result)) {
																echo "<h1 class='mt-1 mb-3'>" . $row['count'] . "</h1>";
															}
														}
														?>
														<div class="mb-0">
															<span class="text-success">Now</span>
														</div>
													</div>

												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="card mb-3">
												<div class="card-body row align-items-center">
													<div class="col-3 ">
														<i class="fa-solid fa-guitar fs-2 ps-2" style="color: rgb(54, 162, 235);"></i>
													</div>
													<div class="col-9">
														<div class="row">
															<div class="col mt-0">
																<h5 class="card-title">Artists</h5>
															</div>
														</div>
														<?php
														$result = mysqli_query($conn, $sql3);
														if (mysqli_num_rows($result) > 0) {
															while ($row = mysqli_fetch_assoc($result)) {
																echo "<h1 class='mt-1 mb-3'>" . $row['count'] . "</h1>";
															}
														}
														?>
														<div class="mb-0">
															<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> </span>
															<span class="text-success">Now</span>
														</div>
													</div>
												</div>
											</div>
											<div class="card mb-3">
												<div class="card-body row align-items-center">
													<div class='col-3'>
														<i class="fa-solid fa-user-astronaut fs-2 ps-2" style="color: rgb(75, 192, 192);"></i>
													</div>
													<div class='col-9'>
														<div class="row">
															<div class="col mt-0">
																<h5 class="card-title">Admin</h5>
															</div>

															<div class="col-auto">
																<div class="stat text-primary">
																	<i class="align-middle" data-feather="users"></i>
																</div>
															</div>
														</div>
														<?php
														$result = mysqli_query($conn, $sql4);
														if (mysqli_num_rows($result) > 0) {
															while ($row = mysqli_fetch_assoc($result)) {
																echo "<h1 class='mt-1 mb-3'>" . $row['count'] . "</h1>";
															}
														}
														?>
														<div class="mb-0">
															<span class="text-success">Now</span>
														</div>
													</div>

												</div>
											</div>
										</div>

									</div>
								</div>
							</div>


							<div class="col-xl-6 col-xxl-7">
								<div class="card flex-fill w-100 mb-3">
									<div class="card-body mt-2">
										<div class="d-flex justify-content-center" style="height: 18rem;">
											<canvas id="Chart"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row ">
							<div class="col-8 col-md-8 col-xxl-8 d-flex order-3 order-xxl-2 mb-3">
								<div class="card flex-fill">
									<div class="card-header pb-1">

										<h5 class="card-title my-2">Admin Profile</h5>
									</div>
									<table class="table table-hover my-0">
										<thead>
											<tr>
												<th>Avatar</th>
												<th>Name</th>
												<th class="d-none d-xl-table-cell">Email</th>
												<th class="d-none d-md-table-cell">Gender</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql = "SELECT `email`, `gender`, `TenNguoiDung`, `Avatar` FROM `user` WHERE level = 'Admin'";
											$result = mysqli_query($conn, $sql);
											if (mysqli_num_rows($result) > 0) {
												while ($row = mysqli_fetch_assoc($result)) {
											?>
													<tr>
														<td><img src="<?php echo $row["Avatar"] ?>" alt="" style="width: 2em;"></td>
														<td class="d-none d-md-table-cell"><?php echo $row["TenNguoiDung"] ?></td>
														<td class="d-none d-xl-table-cell"><?php echo $row["email"] ?></td>
														<td class="d-none d-xl-table-cell"><?php echo $row["gender"] ?></td>
														<td><span class="badge bg-success">------</span></td>
													</tr>
											<?php
												}
											}
											?>

										</tbody>
									</table>
								</div>
							</div>
							<div class="col-4 col-md-4 col-xxl-4 d-flex order-1 order-xxl-1 mb-3">
								<div class="card flex-fill">
									<div class="card-header row m-0 p-0 mt-2 ">
										<h3 class="col" id="monthAndYear"></h3>
										<div class="col d-flex justify-content-end pb-2">
											<button class="btn btn-outline-dark" id="previous" onclick="previous()">Previous</button>
											<button class="btn btn-outline-dark" id="next" onclick="next()">Next</button>
										</div>
									</div>
									<div class="card-body d-flex table-responsive pt-0 p-2">
										<table class="table table-bordered" id="calendar">
											<thead>
												<tr>
													<th>Sun</th>
													<th>Mon</th>
													<th>Tue</th>
													<th>Wed</th>
													<th>Thu</th>
													<th>Fri</th>
													<th>Sat</th>
												</tr>
											</thead>

											<tbody id="calendar-body">

											</tbody>
										</table>

										<br />
										<form class="" hidden>
											<select name="month" id="month">
												<option value=0>Jan</option>
												<option value=1>Feb</option>
												<option value=2>Mar</option>
												<option value=3>Apr</option>
												<option value=4>May</option>
												<option value=5>Jun</option>
												<option value=6>Jul</option>
												<option value=7>Aug</option>
												<option value=8>Sep</option>
												<option value=9>Oct</option>
												<option value=10>Nov</option>
												<option value=11>Dec</option>
											</select>


											<label for="year"></label><select name="year" id="year">
												<option value=2020>2020</option>
												<option value=2021>2021</option>
												<option value=2022>2022</option>
												<option value=2023>2023</option>
												<option value=2024>2024</option>
											</select>
										</form>
									</div>
									<div class="row justify-content-center" hidden>


									</div>
								</div>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>



		<!-- Lấy dữ liệu biểu đồ -->
		<div>
			<?php



			// Bar chart
			$sql = "SELECT  DATE_FORMAT(date, '%m/%Y') as mont, total 
						FROM `truycap` 
						GROUP BY mont 
						ORDER BY YEAR(date) DESC, MONTH(date) DESC
						Limit 0,10";
			$result = mysqli_query($conn, $sql);
			foreach ($result as $data) {
				$mont[] = $data['mont'];
				$total[] = $data['total'];
			}
			mysqli_close($conn);
			?>
		</div>

		<script>
			// Bar chart
			const x3 = <?php echo json_encode($mont) ?>;
			const y3 = <?php echo json_encode($total) ?>;
			const data3 = {
				labels: x3,
				datasets: [{
					label: 'Traffic',
					data: y3,
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 159, 64, 0.2)',
						'rgba(255, 205, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(201, 203, 207, 0.2)',
					],
					borderColor: [
						'rgb(255, 99, 132)',
						'rgb(255, 159, 64)',
						'rgb(255, 205, 86)',
						'rgb(75, 192, 192)',
						'rgb(54, 162, 235)',
						'rgb(153, 102, 255)',
						'rgb(201, 203, 207)',
					],
					borderWidth: 1,
				}]
			};
			const option3 = {
				scales: {
					y: {
						beginAtZero: true
					}
				},

			};

			const config3 = {
				type: 'bar',
				data: data3,
				options: option3
			};


			var Chart3 = new Chart(document.getElementById('Chart'), config3);
		</script>

	</main>
	<?php 
	include("footer.php");
	?>
	<script src="js/calendar.js"></script>
</body>

</html>