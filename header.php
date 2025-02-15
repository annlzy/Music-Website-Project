<div class="row sticky-top header">
  <div class="col d-flex justify-content-start py-2">
    <div>
      <form class="d-flex" role="search"  action="search.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
        <button class="btn btn-outline-primary btn-md" type="submit">Search</button>
      </form>
      
    </div>
  </div>
  <?php
  $anhdaidien = "";
  if ($login_session != "") {
    $sql = "SELECT `Avatar`, TenNguoiDung FROM `user` WHERE IdUser = $login_session";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
      $anhdaidien = $row["Avatar"];
    }
  }
  if ($login_session != "") {
    echo "<div class='col d-flex justify-content-end'>
            <div class='dropdown'>
              <a href='#' class='d-flex align-items-center text-decoration-none dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                <img src='" . $anhdaidien . "' alt='' width='32' height='32' class='rounded-circle me-2 mt-2'>" . $row['TenNguoiDung'] . "
              </a>
              <ul class='dropdown-menu text-small shadow'>
                <li><a class='dropdown-item' href='changepass.php'>Change Password</a></li>
                <li><a class='dropdown-item' href='userinf.php'>Profile</a></li>
                <li><hr class='dropdown-divider'></li>
                <li><a class='dropdown-item' href='logout.php'>Sign out</a></li>
              </ul>
            </div>";
  } else {
    echo "<div class='col d-flex justify-content-end pt-2'>      
            <a href='login.php' class='btn btn-outline-primary fs-6 fw-bold mb-2'>Login</a>";
  }
  ?> 
          <div id="colormode" class="ms-3"><i class="fs-3 bi bi-brightness-high-fill"></i></div></div>
    
</div>
      