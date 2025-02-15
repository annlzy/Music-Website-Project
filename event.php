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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .list-music
            {
                display:grid;
                grid-template-columns:repeat(2,50%);
            }
            .event
            {
                text-align: center;
                border: 1px solid #e3e3e3;
                margin-bottom: 30px;
                margin-top: 40px;
                border: 10px 20px;
                
                border-radius: 20px;
                overflow: hidden;
            }



        </style>

</head>

<body class="container-fluid px-0">
  <main class="row">
        <?php
        include('sidebar_user.php');
        ?>
    <script>
		var element = document.getElementById("event");
		element.classList.add("active");
		element.classList.remove("link-body-emphasis");
	</script>
    <div class="col-md-9 col-lg-10 col-sm bg-music">
      <?php 
      include('header.php');
      ?>
        <!--Xu ly PHP-->
            <?php
            require_once 'config.php';
            $limit = 4;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($current_page - 1) * $limit;
            $sql = "SELECT * FROM tintuc";
            $result = mysqli_query($conn, $sql);
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
            ?>

        <!--Hiển thị tin tức-->
        <div>
            <?php 
            echo "<div class='list-music'>";
                while ($row = mysqli_fetch_assoc($result)){ ?>

                        <div class = "event py-3">
                        
                            <img src ="<?php echo $row['HinhAnh'];?>" width='500' height='300px'><br>
                            <b><?php echo $row['TieuDe'];?></b><br>
                           
                            <i><?php echo "Location: ".$row['DiaDiem'];?></i>
                            
                        </div>
                        
                <?php 
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
                    <a class='page-link' href='event.php?page=".($current_page - 1)."'>Previous</a>
                </li>";
                for ($i=1; $i <= $total_page; $i++) {
                    if ($i == $current_page){
                        echo "<li class='page-item active' aria-current='page'>
                                <span class='page-link'>".$i."</span>
                            </li>";
                    }
                    else{
                        echo "<li class='page-item'><a class='page-link' href='event.php?page=".$i."'>".$i."</a></li>";
                    }
                }
                echo "<li class='page-item ";
                if ($current_page == $total_page){
                    echo "disabled";
                }
                echo "'>
                    <a class='page-link' href='event.php?page=".($current_page + 1)."'>Next</a>
                </li>";
                ?>
            </ul>
        </nav>
        
    </div>
  </main>

  <?php
  include("footer.php");
  ?>
  <script src="js/mode.js"></script>
</body>

</html>