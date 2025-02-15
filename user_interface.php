<?php
include('session2.php');
?>
<!DOCTYPE html>
<html  >

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Music</title>
  <link rel="shortcut icon" type="image/png" href="img/4472584.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="css/mystyle.css" />
  <link rel="stylesheet" href="css/colormode.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="container-fluid">
  <main class="row">
    <?php 
    include("sidebar_user.php");
    ?>
    <script>
		var element = document.getElementById("user_interface");
		element.classList.add("active");
		element.classList.remove("link-body-emphasis");
	</script>
    <!-- kết thúc side bar -->
    <div class="col-md-9 col-lg-10 col-sm">
      <?php 
      include("header.php");
      ?>
      <div class="row">
        <div id="carouseltop" class="carousel slide carousel-1" data-bs-ride="carousel">

          <!-- Indicators/dots -->
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouseltop" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouseltop" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouseltop" data-bs-slide-to="2"></button>
          </div>

          <!-- The slideshow/carousel -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <a href="music_info.php?id=10"><img src="img/hieuthuhai.jpg" alt="" class="d-block" style="width:100%; height: 30em;"></a>
            
            </div>
            <div class="carousel-item">
              <a href="music_info.php?id=13"><img src="img/taylor.jpg" alt="" class="d-block" style="width:100%; height: 30em;"></a>
              
            </div>
            <div class="carousel-item">
              <a href="music_info.php?id=2"><img src="img/Blackpink-Encore-1440x500v2-ead6a24188.jpg" alt="" class="d-block" style="width:100%; height: 30em;"></a>
            </div>
          </div>

          <!-- Left and right controls/icons -->
          <button class="carousel-control-prev" type="button" data-bs-target="#carouseltop" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouseltop" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>
      <!-- kết thúc carousel -->
        <div class="content px-3">
        <!-- Top chart -->
        <div class="row py-3">
          <span class="textsize text-uppercase text-secondary fw-semibold ">Listen top charts</span>
          <div class="col d-flex justify-content-start">
            <h3 class="fw-bold">Top <span class="text-primary">Chart</span></h3>
          </div>
          <div class="col d-flex justify-content-end">
            <a href="topchart.php" class="fw-semibold textsize">VIEW ALL</a>
          </div>
          <div class="row d-flex flex-row justify-content-center">
            <?php
            require_once "config.php";
            $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi FROM `baihat` b, nghesi n 
            WHERE b.IdNgheSi = n.IdNgheSi ORDER By b.LuotNghe DESC LIMIT 0,5";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              // output data of each row
              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["IdBaiHat"];
                echo "<div id='".$row['IdBaiHat']."' onclick='getInfo(\"$id\")' class='history card border-0 mt-2 mx-auto' style='width: 12em;'>
                                
                                  <img onclick='getInfo(\"$id\")' src='" . $row["HinhBaiHat"] . "'class='card-img-top' alt='...'>";
                echo "<div class='card-body px-0 pt-2'>
                                <h6 class='card-title m-0 text-nowrap overflow-hidden cursor'>" . $row["TenBaiHat"] . "</h6>";
                echo "<p class='card-text text-secondary text-nowrap overflow-hidden cursor'>" . $row["TenNgheSi"] . "</p>
                                </div>
                            
                            </div>";
              }
            } else {
              echo "0 results";
            };
            ?>
          </div>
        </div>
        <!--Upcoming Events-->
        <div class="row py-3">
          <div class="col-6 pt-2">
            <div class="row">
              <div class="col d-flex justify-content-start">
                <h3 class="fw-bold">Upcoming <span class="text-primary">Events</span></h3>
              </div>
              <div class="col d-flex justify-content-end">
                <a href="event.php" class="fw-semibold">EXPLORE MORE</a>
              </div>
            </div>
            <div class="my-3">
              <div class="row mx-auto my-auto justify-content-center">
                <?php
                $sql = "SELECT `TieuDe`, `HinhAnh`, `DiaDiem` FROM `tintuc` LIMIT 0,2";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  // output data of each row
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-6'>
                                  <div>
                                    <img src='" . $row["HinhAnh"] . "'class='img-fluid' alt='...' style='width: 90%; height: 10em;' >";
                    echo "<div class='card-body'>
                                  <p class='card-text text-secondary my-0 cursor'>" . $row["DiaDiem"] . "</p>";
                    echo "<p class='card-title my-0 fw-semibold cursor'>" . $row["TieuDe"] . "</p>

                                  
                                </div>
                              </div>
                          </div>";
                  }
                } else {
                  echo "0 results";
                };
                ?>
              </div>
            </div>
          </div>
          <div class="col-6 pt-2">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#recent">Recent</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#trending">Trending</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#international">International</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <!-- recent -->
              <?php
              $i = 0;
              $sql = "SELECT b.`IdBaiHat`, `TenBaiHat`, `HinhBaiHat`, `IdAlbum`, `IdTheLoai`, `IdPlaylist`, `IdChuDe`, n.`IdNgheSi`, `LuotNghe`, `YeuThich`, `NgayPhatHanh`, `Audio`, TenNgheSi, h.created_at FROM `baihat` b, history h, nghesi n 
              WHERE b.IdBaiHat = h.IdBaiHat AND h.IdUser = '$login_session' AND b.IdNgheSi = n.IdNgheSi 
              ORDER BY created_at DESC 
              LIMIT 0,5";
              $result = mysqli_query($conn, $sql);

              echo "<div id='recent' class='container tab-pane active'><br>";
              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row["IdBaiHat"];
                  echo " <div class='row pb-3'>
                  <div id='".$row['IdBaiHat']."' onclick='getInfo(\"$id\")' class='history col-7 d-flex flex-row align-items-center justify-content-start'>
                                  <div>
                                    <img onclick='getInfo(\"$id\")' src='" . $row["HinhBaiHat"] . "'alt='' class='rounded-2' style='width: 3em;'>
                                    </div>";
                  echo "<div class='ps-3'>
                                <h6 class='m-0 cursor'>" . $row["TenBaiHat"] . "</h6>";
                  echo "<p class='textsize text-secondary cursor'>" . $row["TenNgheSi"] . "</p>
                                </div>
                              </div>
                              <div class='col-5 d-flex align-items-center justify-content-end'>"; 
                              ?>
                                <span id='<?php echo $row['IdBaiHat'] ?>' class='<?php 
                                  include("heart.php")
                                ?> wishlist pe-3'></span>
                                <span id='timems_<?php echo $i;?>' class='text-secondary'></span>
                                <audio id='audio_<?php echo $i;?>' onloadedmetadata='GetTimeMs(this, <?php echo $i;?>)'>
                                  <source src='music_LTW/<?php echo $row["Audio"] ?>' type='audio/mpeg'>
                                </audio>
                              </div>
                          </div>
                  <?php
                  $i++;
                }
              } else {
                if ($login_session!='') {
                  echo "Bạn chưa nghe bài hát nào.";
                } else 
                echo "Hãy đăng nhập để xem những bài hát bạn nghe gần đây!";
              }
              echo "</div>";
              ?>
              <!-- trending -->
              <?php
              $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi FROM `baihat` b, nghesi n 
              WHERE b.IdNgheSi = n.IdNgheSi ORDER By b.LuotNghe DESC LIMIT 0,5";
              $result = mysqli_query($conn, $sql);

              echo "<div id='trending' class='container tab-pane fade'><br>";
              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row["IdBaiHat"];
                  echo " <div class='row pb-3'>
                  <div id='".$row['IdBaiHat']."' onclick='getInfo(\"$id\")' class='history col-7 d-flex flex-row align-items-center justify-content-start'>
                                  <div>
                                    <img onclick='getInfo(\"$id\")' src='" . $row["HinhBaiHat"] . "'alt='' class='rounded-2' style='width: 3em;'>
                                    </div>";
                  echo "<div class='ps-3'>
                                <h6 class='m-0 cursor'>" . $row["TenBaiHat"] . "</h6>";
                                echo "<p class='textsize text-secondary cursor'>" . $row["TenNgheSi"] . "</p>
                                </div>
                              </div>
                              <div class='col-5 d-flex align-items-center justify-content-end'>"; 
                              ?>
                                <span id='<?php echo $row['IdBaiHat'] ?>' class='<?php 
                                  include("heart.php")
                                ?> wishlist pe-3'></span>
                                <span id='timems_<?php echo $i;?>' class='text-secondary'></span>
                                <audio id='audio_<?php echo $i;?>' onloadedmetadata='GetTimeMs(this, <?php echo $i;?>)'>
                                  <source src='music_LTW/<?php echo $row["Audio"] ?>' type='audio/mpeg'>
                                </audio>
                              </div>
                          </div>
                  <?php
                  $i++;
                }
              } else {
                echo "0 results";
              }
              echo "</div>";
              ?>
              <!-- International -->
              <?php
              $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, b.IdInternational, n.TenNgheSi, i.IdInternational
              FROM `baihat` b, nghesi n, international i WHERE b.IdNgheSi = n.IdNgheSi AND i.IdInternational = b.IdInternational AND b.IdInternational = 1
              LIMIT 0,5";
              $result = mysqli_query($conn, $sql);

              echo "<div id='international' class='container tab-pane fade'><br>";
              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row["IdBaiHat"];
                  echo " <div class='row pb-3'>
                  <div id='".$row['IdBaiHat']."' onclick='getInfo(\"$id\")' class='history col-7 d-flex flex-row align-items-center justify-content-start'>
                                  <div>
                                    <img onclick='getInfo(\"$id\")' src='" . $row["HinhBaiHat"] . "'alt='' class='rounded-2' style='width: 3em;'>
                                    </div>";
                  echo "<div class='ps-3'>
                                <h6 class='m-0 cursor'>" . $row["TenBaiHat"] . "</h6>";
                                echo "<p class='textsize text-secondary cursor'>" . $row["TenNgheSi"] . "</p>
                                </div>
                              </div>
                              <div class='col-5 d-flex align-items-center justify-content-end'>"; 
                              ?>
                                <span id='<?php echo $row['IdBaiHat'] ?>' class='<?php 
                                  include("heart.php")
                                ?> wishlist pe-3'></span>
                                <span id='timems_<?php echo $i;?>' class='text-secondary'></span>
                                <audio id='audio_<?php echo $i;?>' onloadedmetadata='GetTimeMs(this, <?php echo $i;?>)'>
                                  <source src='music_LTW/<?php echo $row["Audio"] ?>' type='audio/mpeg'>
                                </audio>
                              </div>
                          </div>
                  <?php
                  $i++;
                }
              } else {
                echo "0 results";
              }
              echo "</div>";
              ?>

            </div>
          </div>
        </div>
        <!-- Featured Artists -->
        <div class="row py-3">
          <span class="textsize text-uppercase text-secondary fw-semibold ">best to listen</span>
          <div class="col d-flex justify-content-start">
            <h3 class="fw-bold">Featured <span class="text-primary">Artists</span></h3>
          </div>
          <div class="col d-flex justify-content-end">
            <a href="artist.php" class="fw-semibold textsize">VIEW ALL</a>
          </div>
        </div>
        <div class="text-center my-3 ">
          <div class="row mx-auto my-auto justify-content-center">
            <div class="row d-flex flex-row justify-content-center">
              <?php
              $sql = "SELECT IdNgheSi, `TenNgheSi`, `HinhNgheSi` FROM `nghesi` LIMIT 0,5";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<div class='card border-0 mt-2 mx-auto' style='width: 10em;'>
                                <a href='artist_info.php?id=".$row["IdNgheSi"]."' class='text-decoration-none'>
                                  <img src='" . $row["HinhNgheSi"] . "'class='card-img-top rounded-circle' alt='...'>";
                  echo "<div class='card-body px-0 pt-2'>
                                <h6 class='card-title m-0 '>" . $row["TenNgheSi"] . "</h6>
                                </div> </a>
                                </div>";
                }
              } else {
                echo "0 results";
              };
              ?>
            </div>
          </div>
          <!-- Top albums -->
          <div class="row py-3 top-albums mt-4">
            <span class="textsize text-uppercase text-secondary fw-semibold text-start">trending to listen</span>
            <div class="col d-flex justify-content-start">
              <h3 class="fw-bold">Top <span class="text-primary">Albums</span></h3>
            </div>
            <div class="col d-flex justify-content-end">
              <a href="album.php" class="fw-semibold textsize">VIEW ALL</a>
            </div>
          </div>



          <div class="row top-albums">

            <div class="col-6">

              <?php
              $sql = "SELECT IdAlbum, `TenAlbum`, `HinhAlbum`, n.TenNgheSi
                        FROM `album` a, nghesi n 
                        WHERE a.IdNgheSi = n.IdNgheSi LIMIT 5";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<div class='row pb-3'>
                                <div class='col-7 d-flex flex-row align-items-center justify-content-start'>
                                <div class='col-1'><div class='fs-5 stt'>" . ++$i . "</div></div>";
                  echo "<div>
                                <a href='music_info.php?id=".$row["IdAlbum"]."'><img src='" . $row["HinhAlbum"] . "'alt='' class='rounded-2' style='width: 3em;'></a>
                                    </div>";
                  echo "<div class='ps-3'>
                                <h6 class='m-0 text-start cursor'>" . $row["TenAlbum"] . "</h6>";
                  echo "<p class='textsize text-secondary text-start cursor'>" . $row["TenNgheSi"] . "</p>
                                </div>
                              </div>
                              <div class='col-5 d-flex align-items-center justify-content-end'>
                                
                                <i class='fa-solid fa-ellipsis'></i>
                              </div>
                            </div>";
                }
              } else {
                echo "0 results";
              }
              ?>

            </div>
            <div class="col-6">
              <?php
              $sql = "SELECT IdAlbum, `TenAlbum`, `HinhAlbum`, n.TenNgheSi
                        FROM `album` a, nghesi n 
                        WHERE a.IdNgheSi = n.IdNgheSi LIMIT 5 offset 5";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $i = 5;
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<div class='row pb-3'>
                                <div class='col-7 d-flex flex-row align-items-center justify-content-start'>
                                <div class='col-1'><div class=' fs-5'>" . ++$i . "</div></div>";
                  echo "<div>
                                <a href='music_info.php?id=".$row["IdAlbum"]."'><img src='" . $row["HinhAlbum"] . "'alt='' class='rounded-2' style='width: 3em;'></a>
                                    </div>";
                  echo "<div class='ps-3'>
                                <h6 class='m-0 text-start cursor'>" . $row["TenAlbum"] . "</h6>";
                  echo "<p class='textsize text-secondary text-start cursor'>" . $row["TenNgheSi"] . "</p>
                                </div>
                              </div>
                              <div class='col-5 d-flex align-items-center justify-content-end'>
                                
                                <i class='fa-solid fa-ellipsis'></i>
                              </div>
                            </div>";
                }
              } else {
                echo "0 results";
              }
              ?>


            </div>

          </div>
        </div>
        <!-- Kết thúc main content -->
  </main>
    <?php 
  include("footer.php");
  ?>
  <?php 
  include("music_player.php");
  ?>



  <?php
  require_once "config.php";
  $sql = "SELECT IdBaiHat, `TenBaiHat`, HinhBaiHat, `Audio`, n.TenNgheSi
      FROM `baihat` b, nghesi n 
      WHERE b.IdNgheSi = n.IdNgheSi";
  include("music_js.php");
  ?>
  <script src="js/myscript.js"></script>
 <script src="js/music_time.js"></script>
 <script src="js/mode.js"></script>

  <?php 
  include("favorite_js.php");
  include("history_js.php");
  ?>
</body>

</html>