
<?php include('inc/header.php');
include('inc/config.php'); 
 ?>
 
 

 
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<section class="admin">
<div class="container">
<div class="row">
<div class="col-md-3">
<?php include('inc/common.php'); ?>
</div>
<div class="col-md-9 pt-3">
<a class="btn btn-primary mb-3" href="add-user.php" role="button">Add User</a>
<table class="table table-secondary">
<thead>
<tr>
<th scope="col">Seriol No.</th>
<th scope="col">Full Name</th>
<th scope="col">User Name</th>
<th scope="col">Email</th>
<th scope="col">Role</th>
<th scope="col">Action</th>
</tr>
</thead>

<tbody>
<?php
$users = "SELECT * FROM users";
$result = mysqli_query($con, $users);
$i = 0;
while($row = mysqli_fetch_assoc($result)){
$i++;
?>
<tr>
<th scope="row"><?php echo $i; ?></th>
<td><?php echo $row['fullname']; ?></td>
<td><?php echo $row['username']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php if($row['role'] == 0){echo 'Admin';}else{echo 'Modarator';} ?></td> 

<td class="d-flex" >
<a class="btn btn-success mb-3 mr-3" href="" data-toggle="modal" data-target="#<?php echo $row['username']; ?>" role="button">Edit</a>

<form action="" method="POST">
       <input type="hidden" name="adminid" value="<?php echo $row['user_id'];?>">
       <button type="submit" name="deleted" id="delete" class="btn btn-danger mb-3">Delete</button>
</form>


<!-- ---edita-admin-cde-start-- -->
<div class="modal fade" id="<?php echo $row['username']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
	<div class="mb-3">
	<label for="exampleInputPassword1" class="form-label"> Full Name</label>
	<input type="text" class="form-control" name="fullname" value="<?php echo $row['fullname']; ?>">
  	</div>

         <div class="mb-3">
	<label for="exampleInputPassword1" class="form-label">User Name</label>
	<input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>">
  	</div>

         <div class="mb-3">
	<label for="exampleInputPassword1" class="form-label">Email</label>
	<input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
  	</div>


	<div class="mb-3">
	<input type="hidden" class="form-control" name="admin_id" value="<?php echo $row['user_id']; ?>">
  	</div> 

       <div class="form-group">
       <label >Roll</label>
       <select class="form-control" name="role">
       <option value="0">Admin</option>
       <option value="1">Modarator</option>
       </select>
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

<!-- ---edita-admin-cde-end-- -->


<?php
}
?>

<!-- edit-function-start-here -->
<?php
if(isset($_POST['save'])){

$admin_id = $_POST['admin_id'];
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$role = $_POST['role'];

$update = "UPDATE users SET  fullname = '$fullname', username = '$username', email = '$email', role = '$role' WHERE user_id = '$admin_id';";

$up_run = mysqli_query($con, $update);

if($up_run){
?>
<script type="text/javascript">
swal("Updated", "User Information Update","success");
window.open('dashboard.php');

</script>
<?php

}else{
?>
<script type="text/javascript">
swal("Failed", "User Information Update Failed","warning");
window.open('dashboard.php');
</script>
<?php
}
}
?>

<?php
if(isset($_POST['deleted'])){

	$admin_id = $_POST['adminid'];
	$sql = "DELETE FROM users WHERE user_id = '$admin_id'";
	$runn = mysqli_query($con,$sql);
	if($runn == true){
	?>
	<script type="text/javascript">
	swal("Deleted", "User Deleted","success");
	window.open('dashboard.php');

	</script>
	<?php
	}else{
	?>
	<script type="text/javascript">
	swal("Failed", "User Not Deleted","warning");
	window.open('dashboard.php');

	</script>
	<?php

	}
}
?>
</tbody>
</table>
</div>
</div>
</div>
</section>

<!-- Delete-function-javascript-code -->
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

<?php include('inc/footer.php');?>