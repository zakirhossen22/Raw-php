<?php

include('inc/header.php');
include('inc/config.php');



?>

<div class="container">
       <div class="row">
         <div class="col-md-3">
         <?php include('inc/common.php'); ?>
         </div>     
       <div class="col-md-9 mt-3">
       <?php
       if(isset($_POST['submit'])){
              
              $categoryname = $_POST['categoryname'];
              $cat_insert = "INSERT INTO category (categoryname) VALUES ( '$categoryname')";
              $cat_result = mysqli_query($con, $cat_insert);
              if($cat_result){
                     echo 'Data insert successfully';

              }      
       }
       ?>
       <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];  ?>">
              <div class="form-group mt-3">
              <label>Ctegory Name</label>
              <input type="text" class="form-control" name="categoryname" >
              </div>

              <button type="submit" class="btn btn-primary"name="submit" >Add</button>
       </form>

       
</div>
 </div>
</div>

<?php include('inc/footer.php'); ?>