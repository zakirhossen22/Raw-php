<?php

include('inc/header.php');
include('inc/config.php');



?>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="container">
       <div class="row">
              <div class="col-md-3">
              <?php include('inc/common.php'); ?>

              </div>
              <div class="col-md-9">
              <a class="btn btn-primary my-3" href="add-category.php" role="button">Add category</a>
              <table class="table">
                     <thead>
                     <tr>
                      <th scope="col">Seriol No.</th>
                      <th scope="col">Category Name</th>
                      <th scope="col">Post</th>
                      <th scope="col">Action</th>
                     </tr>
                     </thead>
                     <tbody>
                            <?php
                            $category =  "SELECT * FROM category";
                            $cat_result = mysqli_query($con, $category);
                            $i = 0;
                            while($rows = mysqli_fetch_assoc($cat_result)){
                            $i++;
                            ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $rows['categoryname']; ?></td>
                            <td>
                              <?php
                              $post =  "SELECT * FROM post,category
                              
                              WHERE post.category = category.id";
                              $post_result = mysqli_query($con, $post);
                              

                              if($row = mysqli_num_rows($post_result)){
                              
                               echo $row;
                              }
                              ?>
                              
                              
                            
                            </td>
                            
                            <td class="d-flex">
                                   
                            <a href="" data-toggle="modal" data-target="#<?php echo $rows['categoryname']; ?>" class="btn btn-success mb-3 mr-3">Edit</a>
                            
                            <form action="" method="POST">
                            <input type="hidden" name="adminid" value="<?php echo $rows['id'];?>">
                            <button type="submit" name="deleted" id="delete" class="btn btn-danger mb-3">Delete</button>
                            </form>

                            </td>
                     </tr>
<!-- ---edita-admin-cde-start-- -->
<div class="modal fade" id="<?php echo $rows['categoryname']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
	<div class="mb-3">
	<label for="exampleInputPassword1" class="form-label">Category</label>
	<input type="text" class="form-control" name="category" value="<?php echo $rows['categoryname']; ?>">
  	</div>
	<div class="mb-3">
	<input type="hidden" class="form-control" name="admin_id" value="<?php echo $rows['id']; ?>">
  	</div> 

	<div class="modal-footer">
	<button type="submit" name="save" class="btn btn-success">Save changes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
	</form>
      </div>
      
    </div>
  </div>
</div>

<!-- ---edita-category-cde-end-- -->
<?php
}
?>
</tbody>
</table>


<!-- edit-function-start-here -->
<?php
if(isset($_POST['save'])){

	$admin_id = $_POST['admin_id'];
	$edit = $_POST['category'];

	$update = "UPDATE category SET  categoryname = '$edit' WHERE id = '$admin_id';";

	$up_run = mysqli_query($con, $update);
	
	if($up_run){
	?>
	<script type="text/javascript">
	swal("Updated", "Category Update","success");
	window.open('category.php');

	</script>
	<?php

	}else{
	?>
	<script type="text/javascript">
	swal("Failed", "Category Update Failed","warning");
	window.open('category.php');
	</script>
	<?php
	}
	
}


?>


 <!-- delete-function-code -->
<?php
if(isset($_POST['deleted'])){

	$admin_id = $_POST['adminid'];
	$sql = "DELETE FROM category WHERE id = '$admin_id'";
	$runn = mysqli_query($con,$sql);
	if($runn == true){
	?>
	<script type="text/javascript">
	swal("Deleted", "Category Deleted","success");
	window.open('category.php');

	</script>
	<?php
	}else{
	?>
	<script type="text/javascript">
	swal("Failed", "Ctegory Not Deleted","warning");
	window.open('category.php');

	</script>
	<?php

	}
}
?>
 </div>
 </div>
</div>



<script type="text/javascript"> 
       $(document).on("click", "#delete", function(e){
           e.preventDefault();
           var link = $(this).attr("href");
           swal({
              title: "Are you Want to delete?",
              text: "Once Delete, This will be Permanently Delete!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
           .then((willDelete) => {
              if (willDelete) {
                 window.location.href = link;
             } else {
                swal("Safe Data!");
            }
        });
       });
	</script>





<?php include('inc/footer.php') ?>