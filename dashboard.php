
<?php
session_start();
if(isset($_SESSION['email'])){

}
else{

  header('location:index.php');
}
?>


<?php

include('inc/header.php');
include('inc/config.php');
?>

<div class="container">
       <div class="row">
              <div class="col-md-3">
              <?php include('inc/common.php'); ?>

              </div>
              <div class="col-md-9">
              <table class="table">
                     <thead>
                     <tr>
                      <th scope="col">Total Post</th>
                      <th scope="col">Total Category</th>
                      <th scope="col">Total User</th>
                     </tr>
                     </thead>
                     <tbody>
                     <tr>
                     <td class="bg-primary text-white text-center py-5" style="font-size:20px;">
                     <?php
                     $post = "SELECT * FROM post";

                     $post_run = mysqli_query($con,$post);
                     if($post_count = mysqli_num_rows($post_run)){
                            
                            echo $post_count;
                     }
                     ?>    
                     </td>
                     <td class="bg-secondary text-white text-center py-5" style="font-size:20px">

                     <?php
                     $cats = "SELECT * FROM category";

                     $cat_run = mysqli_query($con,$cats);
                     if($cat_count = mysqli_num_rows($cat_run)){
                            
                            echo $cat_count;
                     }
                     ?>    
                     </td>   

                     <td class="bg-primary text-white text-center py-5" style="font-size:20px" > 

                     <?php
                     $users = "SELECT * FROM users";

                     $user_run = mysqli_query($con,$users);
                     if($user_count = mysqli_num_rows($user_run)){
                            
                            echo $user_count;
                     }
                     ?>    


                     </td>
                     </tr>
<!-- ---edita-admin-cde-start-- -->

</tbody>
</table>




 </div>
 </div>
</div>








<?php include('inc/footer.php') ?>