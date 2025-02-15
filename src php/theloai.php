<?php
include('session2.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8' />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Music</title>
  <link rel="shortcut icon" type="image/png" href="img/4472584.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="css/mystyle.css" />
  <link rel="stylesheet" href="css/musicplayer.css">
  <link rel="stylesheet" href="css/colormode.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="container-fluid">
  <main class=" row">
    <?php
    include("sidebar_user.php");
    ?>
    <script>
		var element = document.getElementById("theloai");
		element.classList.add("active");
		element.classList.remove("link-body-emphasis");
	</script>
    <div class="col-md-9 col-lg-10 col-sm bg-music">
      <?php
      include("header.php");
      $group = 'Dance/Electronic';
        if (isset($_GET['group'])) {
          $group = $_GET['group'];
        }
      ?>
      <div class="col-6">
        <!-- Tiêu đề trang -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link <?php if ($group=='Dance/Electronic') echo "active";?>" href="theloai.php?group=Dance/Electronic">Dance/Electronic</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($group=='pop') echo "active";?>" href="theloai.php?group=pop">POP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($group=='rb') echo "active";?>" href="theloai.php?group=rb">R&B</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($group=='nhacphim') echo "active";?>" href="theloai.php?group=nhacphim">Nhạc Phim</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($group=='ballad') echo "active";?>"  href="theloai.php?group=ballad">Ballad</a>
          </li>
        </ul>
      </div>
      <!-- Tab panes -->
      <div class="tab-content">
        <!--Dance/ Electronic-->
        <?php
        if ($group == 'Dance/Electronic') {
        
        require_once "config.php";
        $limit = 10;
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($current_page - 1) * $limit;
        $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi, b.IdTheLoai, t.IdTheLoai
        FROM `baihat` b, nghesi n,  theloai t WHERE b.IdNgheSi = n.IdNgheSi AND t.IdTheLoai = b.IdTheLoai
        AND b.IdTheLoai = '1'";
        $result = mysqli_query($conn, $sql);
        $total_records = mysqli_num_rows($result);
        if ($total_records > 0) {
            $total_page = ceil($total_records / $limit);
          } else $total_page = 1;
        if ($current_page >= $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        $sql = $sql . " LIMIT $start,$limit";
        $i = $start;
        $result = mysqli_query($conn, $sql);
        echo
        "<div id='dance' class='container'><br>";

        if (mysqli_num_rows($result) > 0) {
          // output data of each row

          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["IdBaiHat"];
            echo " <div class='row pb-3 '>
            <div id='".$row['IdBaiHat']."' onclick='getInfo(\"$id\")' class='history col-7 d-flex flex-row align-items-center justify-content-start'>
            <div class='col-1'><div class='fs-5 stt'>" . ++$i . "</div></div>
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
                      <hr class='m-0 pb-3'>
              <?php
              
          }
        } else {
          echo "0 results";
        }
        echo "</div>";
        }
        
        ?>
        <!--POP-->
        <?php
        if ($group == 'pop') {
        
          $limit = 10;
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($current_page - 1) * $limit;
          $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi, b.IdTheLoai, t.IdTheLoai
            FROM `baihat` b, nghesi n,  theloai t WHERE b.IdNgheSi = n.IdNgheSi AND t.IdTheLoai = b.IdTheLoai 
            AND b.IdTheLoai = '2'";
       $result = mysqli_query($conn, $sql);
       $total_records = mysqli_num_rows($result);
       if ($total_records > 0) {
           $total_page = ceil($total_records / $limit);
         } else $total_page = 1;
       if ($current_page >= $total_page){
           $current_page = $total_page;
       }
       else if ($current_page < 1){
           $current_page = 1;
       }
       $sql = $sql . " LIMIT $start,$limit";
       $i = $start;
       $result = mysqli_query($conn, $sql);

        echo "<div id='pop' class='container'><br>";
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["IdBaiHat"];
            echo " <div class='row pb-3 '>
            <div id='".$row['IdBaiHat']."' onclick='getInfo(\"$id\")' class='history col-7 d-flex flex-row align-items-center justify-content-start'>
            <div class='col-1'><div class='fs-5 stt'>" . ++$i . "</div></div>
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
                      <hr class='m-0 pb-3'>
              <?php
              
          }
        } else {
          echo "0 results";
        }
        }
        
        ?>
        <!-- R&B -->
        <?php
        if ($group == "rb") {
          
          $limit = 10;
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($current_page - 1) * $limit;
          $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi, b.IdTheLoai, t.IdTheLoai
            FROM `baihat` b, nghesi n,  theloai t WHERE b.IdNgheSi = n.IdNgheSi AND t.IdTheLoai = b.IdTheLoai 
            AND b.IdTheLoai = '3'";
        $result = mysqli_query($conn, $sql);
        $total_records = mysqli_num_rows($result);
        if ($total_records > 0) {
            $total_page = ceil($total_records / $limit);
          } else $total_page = 1;
        if ($current_page >= $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        $sql = $sql . " LIMIT $start,$limit";
        $i = $start;
        $result = mysqli_query($conn, $sql);

        echo "<div id='r&b' class='container'><br>";
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["IdBaiHat"];
            echo " <div class='row pb-3 '>
            <div id='".$row['IdBaiHat']."' onclick='getInfo(\"$id\")' class='history col-7 d-flex flex-row align-items-center justify-content-start'>
            <div class='col-1'><div class='fs-5 stt'>" . ++$i . "</div></div>
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
                      <hr class='m-0 pb-3'>
              <?php
              
          }
        } else {
          echo "0 results";
        }
        echo "</div>";
        }
        
        ?>
        <!--Nhạc phim-->
        <?php
        if ($group == "nhacphim") {
          
          $limit = 10;
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($current_page - 1) * $limit;
          $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi, b.IdTheLoai, t.IdTheLoai
          FROM `baihat` b, nghesi n,  theloai t WHERE b.IdNgheSi = n.IdNgheSi AND t.IdTheLoai = b.IdTheLoai 
          AND b.IdTheLoai = '4'";
         $result = mysqli_query($conn, $sql);
         $total_records = mysqli_num_rows($result);
         if ($total_records > 0) {
             $total_page = ceil($total_records / $limit);
           } else $total_page = 1;
         if ($current_page >= $total_page){
             $current_page = $total_page;
         }
         else if ($current_page < 1){
             $current_page = 1;
         }
         $sql = $sql . " LIMIT $start,$limit";
         $i = $start;
         $result = mysqli_query($conn, $sql);
          echo
          "<div id='nhacphim' class='container tab-pane active'><br>";
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
  
            while ($row = mysqli_fetch_assoc($result)) {
              $id = $row["IdBaiHat"];
              echo " <div class='row pb-3 '>
              <div id='".$row['IdBaiHat']."' onclick='getInfo(\"$id\")' class='history col-7 d-flex flex-row align-items-center justify-content-start'>
              <div class='col-1'><div class='fs-5 stt'>" . ++$i . "</div></div>
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
                        <hr class='m-0 pb-3'>
                <?php
            }
          } else {
            echo "0 results";
          }
          echo "</div>";
        }
       
        ?>
        <!--Ballad-->
        <?php
        if ($group == 'ballad') {
          
          $limit = 10;
          $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
          $start = ($current_page - 1) * $limit;
          $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi, b.IdTheLoai, t.IdTheLoai
        FROM `baihat` b, nghesi n,  theloai t WHERE b.IdNgheSi = n.IdNgheSi AND t.IdTheLoai = b.IdTheLoai 
        AND b.IdTheLoai = '5'";
       $result = mysqli_query($conn, $sql);
       $total_records = mysqli_num_rows($result);
       if ($total_records > 0) {
           $total_page = ceil($total_records / $limit);
         } else $total_page = 1;
       if ($current_page >= $total_page){
           $current_page = $total_page;
       }
       else if ($current_page < 1){
           $current_page = 1;
       }
       $sql = $sql . " LIMIT $start,$limit";
       $i = $start;
       $result = mysqli_query($conn, $sql);
        echo "<div id='ballad' class='container tab-pane active'><br>";
        if (mysqli_num_rows($result) > 0) {
          // output data of each row

          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["IdBaiHat"];
            echo " <div class='row pb-3 '>
            <div id='".$row['IdBaiHat']."' onclick='getInfo(\"$id\")' class='history col-7 d-flex flex-row align-items-center justify-content-start'>
            <div class='col-1'><div class='fs-5 stt'>" . ++$i . "</div></div>
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
                      <hr class='m-0 pb-3'>
              <?php
          }
        } else {
          echo "0 results";
        }
        echo "</div>";
        }
        
        ?>


      </div>
      <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <?php
               echo "<li class='page-item ";
                if ($current_page == 1){
                    echo "disabled";
                }
                echo "'>
                    <a class='page-link' href='theloai.php?group=".$group."&page=".($current_page - 1)."'>Previous</a>
                </li>";
                for ($i=1; $i <= $total_page; $i++) {
                    if ($i == $current_page){
                        echo "<li class='page-item active' aria-current='page'>
                                <span class='page-link'>".$i."</span>
                            </li>";
                    }
                    else{
                        echo "<li class='page-item'><a class='page-link' href='theloai.php?group=".$group."&page=".$i."'>".$i."</a></li>";
                    }
                }
                echo "<li class='page-item ";
                if ($current_page == $total_page){
                    echo "disabled";
                }
                echo "'>
                    <a class='page-link' href='theloai.php?group=".$group."&page=".($current_page + 1)."'>Next</a>
                </li>";
                ?>
            </ul>
        </nav>
    </div>
  </main>
  <?php
  include("music_player.php");
  include("footer.php");
  ?>
  <?php
  if ($group == "Dance/Electronic") {
    $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi, b.IdTheLoai, t.IdTheLoai
        FROM `baihat` b, nghesi n,  theloai t WHERE b.IdNgheSi = n.IdNgheSi AND t.IdTheLoai = b.IdTheLoai
        AND b.IdTheLoai = '1'";
  }

  if ($group == "pop") {
    $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi, b.IdTheLoai, t.IdTheLoai
    FROM `baihat` b, nghesi n,  theloai t WHERE b.IdNgheSi = n.IdNgheSi AND t.IdTheLoai = b.IdTheLoai 
    AND b.IdTheLoai = '2'";
  }

  if ($group == "nhacphim") {
    $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi, b.IdTheLoai, t.IdTheLoai
    FROM `baihat` b, nghesi n,  theloai t WHERE b.IdNgheSi = n.IdNgheSi AND t.IdTheLoai = b.IdTheLoai 
    AND b.IdTheLoai = '4'";
  }

  if ($group == "rb") {
    $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi, b.IdTheLoai, t.IdTheLoai
    FROM `baihat` b, nghesi n,  theloai t WHERE b.IdNgheSi = n.IdNgheSi AND t.IdTheLoai = b.IdTheLoai 
    AND b.IdTheLoai = '3'";
  }
  if ($group == "ballad") {
     $sql = "SELECT IdBaiHat, `TenBaiHat`, `HinhBaiHat`, `Audio`, n.TenNgheSi, b.IdTheLoai, t.IdTheLoai
            FROM `baihat` b, nghesi n,  theloai t WHERE b.IdNgheSi = n.IdNgheSi AND t.IdTheLoai = b.IdTheLoai 
            AND b.IdTheLoai = '2'";
  }
  include("music_js.php");
  ?>
  <script src="js/music_time.js"></script>
  <script src="js/mode.js"></script>
  <?php
  include("favorite_js.php");
  include("history_js.php");
  ?>
</body>

</html>