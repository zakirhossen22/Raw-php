<?php
include('inc/header.php');
include('inc/config.php');
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<div class="container">
<?php
if(isset($_POST['submit'])) {
       session_start();
       $_SESSION['username'];


$img_name = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];
move_uploaded_file($tmp_name, "images/".$img_name);


$title = $_POST['title'];
$description = $_POST['description'];
$excerpt = $_POST['excerpt'];
$category = $_POST['category'];
$date = date('d M,Y');
$author = $_SESSION['username'];


$post_insert = "INSERT INTO post (title, excerpt, description, category,image,author, date) VALUES ('$title', '$excerpt', '$description', '$category','$img_name','$author','$date')";

$post_result = mysqli_query($con, $post_insert);
if($post_result){
?>
<script type="text/javascript">
swal("Added", "Post Added Successfully","success");
window.open('dashboard.php');

</script>
<?php
}else{
 ?>
<script type="text/javascript">
swal("Failed", "Post Addition Failed","warning");
window.open('dashboard.php');

</script>
<?php
}
}
?>

       <div class="row">
         <div class="col-md-3">
         <?php include('inc/common.php'); ?>
         </div>     
       <div class="col-md-9 mt-3">

       <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];  ?>" enctype="multipart/form-data" >
              <div class="form-group">
              <label>Post Title</label>
              <input type="text" class="form-control" name="title" >
              </div>

              <div class="form-group">
              <label>Description</label>
              <textarea class="form-control"  name="description" ></textarea>
              </div>
              
              <div class="form-group">
              <label>Excerpt</label>
              <textarea class="form-control"  name="excerpt"></textarea>
              </div>

              <div class="form-group">
              <label>Post Thumbnail</label>
              <input type="file" class="form-control" name="image">
              </div>


              <div class="form-group">
              <select class="form-control" name="category">
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
       
              <button type="submit" class="btn btn-primary" name="submit" >Add</button>
       </form>

       
</div>
 </div>
</div>

<?php include('inc/footer.php'); ?>