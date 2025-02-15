<?php
    $flag_heart = false;
    if ($login_session != "") {
        $sql2 = "SELECT `IdYeuThich`, `IdUser`, y.`IdBaiHat`, `created_at` FROM `yeuthich` y, baihat b
    WHERE y.IdBaiHat = b.IdBaiHat AND y.IdUser = $login_session";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        // output data of each row
        while ($row2 = mysqli_fetch_assoc($result2)) {
            if ($id == $row2["IdBaiHat"]) {
                $flag_heart = true;
            } 
        }  
    }
    }  
    if ($flag_heart) {
        echo "heart-fill";
      } else {
        echo "heart-empty";
      }
?>