<?php 
include("session2.php");
?>
<!DOCTYPE html>
<html class='container-fluid'>

<head>
  <meta charset='utf-8' />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Music</title>
  <link rel="shortcut icon" type="image/png" href="img/4472584.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="css/mystyle.css" />
  <link rel="stylesheet" href="css/musicplayer.css">
  <link rel="stylesheet" href="css/colormode.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<main class="row">
  <?php 
    include("sidebar_user.php");
    ?>
    <script>
		var element = document.getElementById("favorite");
		element.classList.add("active");
		element.classList.remove("link-body-emphasis");
	</script>
    <!-- kết thúc side bar -->
    <div class="col-md-9 col-lg-10 col-sm">
      <?php 
      include("header.php");
      ?>
      
      <!-- end music player -->
      <div class='m-3'>
        <h4 class='text-uppercase'>Danh sách yêu thích</h4>
      </div>
      <div class="container mt-4">
        <?php
        require_once "config.php";
        $limit = 10;
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($current_page - 1) * $limit;
        $sql = "SELECT b.`IdBaiHat`, `TenBaiHat`, `HinhBaiHat`, `IdAlbum`, `IdTheLoai`, `IdPlaylist`, `IdChuDe`, n.`IdNgheSi`, `LuotNghe`, `YeuThich`, `NgayPhatHanh`, `Audio` , TenNgheSi, y.created_at
        FROM `baihat` b, yeuthich y, nghesi n
        WHERE b.IdBaiHat = y.IdBaiHat AND y.IdUser = '$login_session' AND b.IdNgheSi = n.IdNgheSi ORDER BY y.created_at DESC";
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
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          $i = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["IdBaiHat"];
            $Aud = $row["Audio"];
            echo " <div class='row pb-2 '>
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
              <hr class='m-0 pb-3'>
              <?php
              $i++;
          }
        } else {
          echo "Bạn chưa thích bài hát nào!";
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
                    <a class='page-link' href='favorite.php?page=".($current_page - 1)."'>Previous</a>
                </li>";
                for ($i=1; $i <= $total_page; $i++) {
                    if ($i == $current_page){
                        echo "<li class='page-item active'>
                                <span class='page-link'>".$i."</span>
                            </li>";
                    }
                    else{
                        echo "<li class='page-item'><a class='page-link' href='favorite.php?page=".$i."'>".$i."</a></li>";
                    }
                }
                echo "<li class='page-item ";
                if ($current_page == $total_page){
                    echo "disabled";
                }
                echo "'>
                    <a class='page-link' href='favorite.php?page=".($current_page + 1)."'>Next</a>
                </li>";
                ?>
            </ul>
        </nav>
    </div>
    <?php 
    $sql = "SELECT b.`IdBaiHat`, `TenBaiHat`, `HinhBaiHat`, `IdAlbum`, `IdTheLoai`, `IdPlaylist`, `IdChuDe`, n.`IdNgheSi`, `LuotNghe`, `YeuThich`, `NgayPhatHanh`, `Audio` , TenNgheSi, y.created_at
    FROM `baihat` b, yeuthich y, nghesi n
    WHERE b.IdBaiHat = y.IdBaiHat AND y.IdUser = '$login_session' AND b.IdNgheSi = n.IdNgheSi ORDER BY y.created_at DESC";
    include("music_player.php");
    ?>
  </main>
  <?php 
  include("footer.php");
  ?>

  <?php
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