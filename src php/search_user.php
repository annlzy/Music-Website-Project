<div class="row sticky-top header">
        <div class="col d-flex justify-content-start py-2">
          <div>
            <form class="d-flex" role="search" action="admin_manage.php" method="get">
              <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
              <button class="btn btn-outline-primary btn-md" type="submit">Search</button>
            </form>

          </div>
        </div>
      </div>
<?php
if(isset($_GET["search"]) && !empty($_GET["search"]))
{
$key = $_GET["search"];
$sql = "SELECT Username, TenNguoiDung, email, phone, IdUser, level FROM user WHERE username LIKE '%$key%'  OR TenNguoiDung LIKE '%$key%'  OR email  LIKE '%$key%' 
            OR phone LIKE '%$key%' OR IdUser LIKE '%$key%' OR level LIKE '%$key%'";
}
else {
    $sql = "SELECT Username, TenNguoiDung, email, phone, IdUser, level FROM user ORDER BY level ASC ";
}
?>