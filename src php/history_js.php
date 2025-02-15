<script>
        $(document).ready(function(){
            $(".history").click(function(){
                var current = $(this);
                var id = $(this).attr("id"); // =1 ;Lấy giá trị thuộc tính id.

                $.ajax({
                    type:"POST",
                    dataType:"html",
                    url: "update_history.php",
                    data:"id="+id,
                    error: function (xhr,status,error){
                    },
                    complete: function(xhr,status){

                    }
                }); 

               
                
            });
        });
    </script>