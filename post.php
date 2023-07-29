
<?php

include('inc/header.php');
include_once('inc/config.php');

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
$sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.id";

$post_result = mysqli_query($con, $sql);



?>

<div class="container">
       <div class="row">
         <div class="col-md-2">
         <?php include('inc/common.php'); ?>
         </div>     
       <div class="col-md-10 mt-3">

       <a class="btn btn-primary mb-3" href="add-post.php" role="button">Add Post</a>
       <table class="table">
  <thead>
    <tr>
      <th scope="col">Serial No.</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Category</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i =0;
    while($run = mysqli_fetch_assoc($post_result)){
      $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $run['title']; ?></td>
      <td><?php echo $run['author']; ?></td>
      <td><?php echo $run['categoryname']; ?></td>
      <td><?php echo $run['date']; ?></td>
      <td class="d-flex ">
		<!-- <a href="" data-toggle="modal" data-target="#<?php echo $run['categoryname']; ?>" class="btn btn-sm btn-info mr-3">View</a> -->
		<!-- editform-code-- -->
		<a href="" data-toggle="modal" data-target="#<?php echo $run['categoryname']; ?>" class="btn btn-sm btn-success mr-3">Edit</a>

		<!-- delete-frm -->
		<form action="" method="POST">
		<input type="hidden" name="adminid" value="<?php echo $run['category'];?>">
		<button type="submit" name="submit" id="delete"  class="btn btn-sm btn-danger cursor-pointer">Delete</button>
		</form>
		
		</td>
    </tr>

<!--Delete-post-function-code -->
<?php
if(isset($_POST['submit'])){

	$admin_id = $_POST['adminid'];
	$sql = "DELETE FROM post WHERE category = '$admin_id'";
	$runn = mysqli_query($con,$sql);
	if($runn == true){
	?>
	<script type="text/javascript">
	swal("Deleted", "Post Deleted","success");
	window.open('all_admin.php');

	</script>
	<?php
	}else{
		?>
	<script type="text/javascript">
	swal("Failed", "Post Not Deleted","warning");
	window.open('all_admin.php');

	</script>
	<?php

	}
}

?>
<!-- ---view-code-start-- -->
<!-- <div class="modal fade" id="<?php echo $run['categoryname']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Post Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <h5>Title:</h5><?php echo $run['title']; ?>
        <h5>Excerpt:</h5><?php echo $run['excerpt']; ?>
        <h5>Description:</h5><?php echo $run['description']; ?>
        <h5>Thumbnail:</h5><img src="images/<?php echo $run['image']; ?>"> 
        <h5>Category:</h5><?php echo $run['categoryname']; ?>
        <h5>Date:</h5><?php echo $run['date']; ?>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
      
    </div>
  </div>
</div> -->

<!-- ---edita-category-cde-end-- -->

<!-- ---Edit-post-start-- -->
<div class="modal fade" id="<?php echo $run['categoryname']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
      <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Title</label>
      <input type="text" class="form-control" name="title" value="<?php echo $run['title']; ?>">
        </div>

        <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Excerpt:</label>
      <input type="textarea" class="form-control" name="excerpt" value="<?php echo $run['excerpt']; ?>">
        </div>

        <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Description:</label>
      <input type="textarea" class="form-control" name="desc" value="<?php echo $run['description']; ?>">
        </div>

        <div class="mb-3">
      <label for="" class="form-label">Post Thumbnail:</label>
      <input type="file" class="form-control" name="post_thumb" value="<?php echo $run['image']; ?>" required>
        </div>

        <div class="form-group">
              <select class="form-control" name="category" required>
              <option selected disabled value="">Category</option>
              <?php
              $category =  "SELECT * FROM category";
              $cat_result = mysqli_query($con, $category);
              while($rows = mysqli_fetch_assoc($cat_result)){
              ?>
              <option value="<?php echo $rows['id'] ?>" ><?php echo $rows['categoryname'] ?></option>
              <?php

              }
              ?>
              </select>
              </div>

      <div class="mb-3">
      <input type="hidden" class="form-control" name="admin_id" value="<?php echo $run['post_id']; ?>">
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

<!-- ---edit-post-cde-end-- -->

<!-- edit-function-start-here -->
<?php
if(isset($_POST['save'])){

	$admin_id = $_POST['admin_id'];
	$title = $_POST['title'];
	$desc = $_POST['desc'];
	$excerpt = $_POST['excerpt'];
	$post_thumb = $_POST['post_thumb'];
	$category = $_POST['category'];

	$update = "UPDATE post SET title = '$title', description = '$desc', excerpt = '$excerpt', image = '$post_thumb',category = '$category' WHERE post_id = '$admin_id'";

	$up_run = mysqli_query($con, $update);
	
	if($up_run){
	?>
	<script type="text/javascript">
	swal("Updated", "Category Update","success");
	window.open('post.php');

	</script>
	<?php

	}else{
	?>
	<script type="text/javascript">
	swal("Failed", "Category Update Failed","warning");
	window.open('post.php');
	</script>
	<?php
	}
	
}
?>
<?php
}

?>
</tbody>
</table>

 </div>
</div>
 
<!-- delete-script-code -->
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


<?php include_once('inc/footer.php'); ?>