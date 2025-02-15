    <aside class="mysidebar col-md d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
      <div class="row">
        <div class="d-flex justify-content-center">
            <img src="img/logo.png" alt="logo music" class="img-fluid " style="width: 7em;">
        </div>
      </div>
      <hr>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a id="admin_dashboard" href="admin_dashboard.php" class="nav-link link-body-emphasis">
            <i class="bi bi-house-heart pe-2"></i>
            Dashboard
          </a>
        </li>
        <li>
          <a id="admin_manage" href="admin_manage.php" class="nav-link link-body-emphasis">
            <i class="fa-solid fa-user pe-2"></i>
            User
          </a>
        </li>
        <li>
          <a id="admin_thongke" href="admin_thongke.php" class="nav-link link-body-emphasis">
            <i class="fa-solid fa-chart-line pe-2"></i>
            Thống kê
          </a>
        </li>
        <li>
          <a id="admin_music" href="admin_music.php?group=bai-hat" class="nav-link link-body-emphasis">
            <i class="bi bi-music-note-beamed pe-2"></i>
            Music
          </a>
        </li>
        <li>
          <a id='admin_tintuc' href="admin_tintuc.php" class="nav-link link-body-emphasis">
            <i class="fa-solid fa-calendar-check pe-2"></i>
            Tin tức
          </a>
        </li>
      </ul>
      <hr>
			<ul class="nav nav-pills flex-column">
				<li class="nav-item">
					<a href="user_interface.php" class="nav-link link-body-emphasis py-0">
						<i class="fa-solid fa-headset pe-2"></i>
						Trang chủ
					</a>
				</li>
			</ul>
			<hr>
      <?php
      require_once "config.php";
      $anhdaidien = "";
      if ($login_session != "") {
        $sql2 = "SELECT `Avatar`, TenNguoiDung FROM `user` WHERE IdUser = $login_session";
        $result = mysqli_query($conn, $sql2);
        if ($row = mysqli_fetch_assoc($result)) {
          $anhdaidien = $row["Avatar"];
        }
      }


      if ($login_session != "") {
        echo "<div class='col d-flex justify-content-start'>
                    <div class='dropdown'>
                      <a href='#' class='d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                      <img src='" . $anhdaidien . "' alt='' width='32' height='32' class='rounded-circle me-2 mt-2'>" . $row['TenNguoiDung'] . "
                      </a>
                      <ul class='dropdown-menu text-small shadow'>
                      <li><a class='dropdown-item' href='changepass.php'>Change Password</a></li>
                      <li><a class='dropdown-item' href='userinf.php'>Profile</a></li>
                      <li><hr class='dropdown-divider'></li>
                      <li><a class='dropdown-item' href='logout.php'>Sign out</a></li>
                      </ul>
                    </div>
                    </div>";
      }

      ?>
    </aside>