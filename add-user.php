
<?php include('inc/header.php'); ?>
<?php include('inc/config.php'); ?>


<?php
       if(isset($_POST['submit'])){

              $user_img = $_FILES['user_img']['name'];
              $tmp_name = $_FILES['user_img']['tmp_name'];
              move_uploaded_file($tmp_name, "images/".$user_img);
              
              $fullname = $_POST['fullname'];
              $username = $_POST['username'];
              $email = $_POST['email'];
              $about = $_POST['about'];
              $password = md5($_POST['password']);
              $role = $_POST['role'];

              $user_check = "SELECT username,email FROM users WHERE username = '$username' OR email = '$email'";

              $user_query = mysqli_query($con, $user_check);
              $user_count = mysqli_num_rows($user_query);
              if($user_count > 0){
                     $error = 'User already exsistis';
              }else{
              $user_insert = "INSERT INTO users (fullname, username, email, about, user_img, password, role) VALUES ( '$fullname', '$username', '$email', '$about', '$user_img', '$password','$role')";
              $user_result = mysqli_query($con, $user_insert);
              if($user_result){
                     echo 'Data insert successfully';

              }

              }
              
       }
       ?>
<div class="container">
       <div class="row">
         <div class="col-md-3">
         <?php include('inc/common.php'); ?>
         </div>     
       <div class="col-md-9 mt-3">
       <?php if(isset($error)) {echo $error;} ?>
       <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];  ?>" enctype="multipart/form-data">
              <div class="form-group">
              <label>Full Name</label>
              <input type="text" class="form-control" name="fullname" >
              </div>

              <div class="form-group">
              <label>User Name</label>
              <input type="text" class="form-control" name="username" >
              </div>

              
              <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email">
              </div>

              <div class="form-group">
              <label>About User</label>
              <textarea class="form-control"  name="about" ></textarea>
              </div>

              <div class="form-group">
              <label>User Image</label>
              <input type="file" class="form-control" name="user_img">
              </div>

              <div class="form-group">
              <label>Passwoord</label>
              <input type="password" class="form-control" name="password">
              </div>

              <div class="form-group">
              <label >Roll</label>
              <select class="form-control" name="role">
              <option value="0">Admin</option>
              <option value="1">Modarator</option>
              </select>
              </div>
       
              <button type="submit" class="btn btn-primary"name="submit" >Add</button>
       </form>

       
</div>
 </div>
</div>
     
<?php include('inc/footer.php'); ?>