$(document).ready(function(){
    $(".wishlist").click(function(){
      <?php 
        if($login_session == "") {
          echo "
              alert('Bạn cần đăng nhập để thực hiện chức năng này!');
              ";
        }
        ?>
        var current = $(this);
        var id = $(this).attr("id"); // =1 ;Lấy giá trị thuộc tính id.

        $.ajax({
            type:"POST",
            dataType:"html",
            url: "update_wishlist.php",
            data:"id="+id,
            success:function(result){
                if(result=="1")
                {
                    if(current.hasClass("heart-empty"))
                    {
                        current.attr("class","heart-fill wishlist pe-3");
                    }
                    else
                    {
                        current.attr("class","heart-empty wishlist pe-3");
                    }
                }
                
            },
            error: function (xhr,status,error){
            },
            complete: function(xhr,status){

            }
        }); 

       
        
    });
});
</script>