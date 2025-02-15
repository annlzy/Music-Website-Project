<aside class="mysidebar col-md-3 col-lg-2 d-flex flex-column flex-shrink-0 p-3 ">
  <div class="row">
    <div class="d-flex justify-content-center">
      <img src="img/logo.png" alt="logo music" class="img-fluid " style="width: 7em;">
    </div>
  </div>
  <hr>
  <ul class="nav nav-pills flex-column">
    <li class="nav-item">
      <a id="user_interface" href="user_interface.php" class="nav-link ">
        <i class="bi bi-house-heart pe-2"></i>
        Home
      </a>
    </li>
    <li>
      <a id="theloai" href="theloai.php?group=Dance/Electronic" class="nav-link ">
        <i class="bi bi-vinyl pe-2"></i>
        Thể loại
      </a>
    </li>
    <li>
      <a id='topchart' href="topchart.php" class="nav-link ">
        <i class="bi bi-music-note-beamed pe-2"></i>
        Bảng xếp hạng
      </a>
    </li>
    <li>
      <a id='album' href="album.php" class="nav-link ">
        <i class="bi bi-journal-album pe-2"></i>
        Albums
      </a>
    </li>
    <li>
      <a id='artist' href="artist.php" class="nav-link ">
        <i class="bi bi-mic pe-2"></i>
        Artists
      </a>
    </li>
  </ul>
  <h6 class="text-secondary">Music</h6>
  <ul class="nav nav-pills flex-column">
    <!-- <li class="nav-item">
          <a href="#" class="nav-link ">
            <i class="bi bi-pie-chart pe-2"></i>
            Analytics
          </a>
        </li> -->
    <li>
      <a id="favorite" href="favorite.php" class="nav-link ">
        <i class="bi bi-heart-pulse pe-2"></i>
        Yêu thích
      </a>
    </li>
    <li>
      <a id='history' href="history.php" class="nav-link ">
        <i class="bi bi-clock-history pe-2"></i>
        Lịch sử nghe
      </a>
    </li>
  </ul>
  <h6 class="text-secondary">Events</h6>
  <ul class="nav nav-pills flex-column">
    <li>
      <a id="event" href="event.php" class="nav-link ">
        <i class="bi bi-calendar2-event pe-2"></i>
        Events
      </a>
    </li>
  </ul>
  <hr>
  <?php
  if ($permission_sess == "Admin") {
  ?><ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="admin_dashboard.php" class="nav-link  py-0">
          <i class="fa-solid fa-bars-progress pe-2"></i>
          Admin
        </a>
      </li>
    </ul> <?php
        }
          ?>

</aside>