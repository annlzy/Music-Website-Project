<?php
    include('session2.php');
    if(isset($_POST['id']))
    {
        $id_baihat = $_POST['id'];
        $id_user = $login_session;
        require_once "config.php";
        $sql = "select * from yeuthich where IdBaiHat = $id_baihat and IdUser = $id_user";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0)
        {
            $sql = "delete from yeuthich where IdBaiHat = $id_baihat and IdUser = $id_user";
            if(mysqli_query($conn,$sql)>0)
                echo "1";
            else 
                echo "0";
        }
        else
        {
            $sql = "INSERT INTO `yeuthich`(`IdUser`, `IdBaiHat`, `created_at`) VALUES($id_user,$id_baihat,now())";
            if(mysqli_query($conn,$sql)>0)
                echo "1";
            else 
                echo "0";
        }
        
    }
    
?>