
<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Admin Pannel</title>
       <link rel="stylesheet" href="../assets/css/style.css">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php
include_once('inc/config.php');
if(isset($_POST['login'])){

  $email = $_POST['email'];
  $pass = $_POST['pass'];

  $sql = "SELECT * FROM users WHERE email= '$email' AND password = '$pass'";
  $run = mysqli_query($con, $sql);
  $check = mysqli_num_rows($run);
  if( $check == 0){
    ?>
    <script type="text/javascript">alert('E-mail or password is wrong');</script>
	  <?php
	}else{

    $result  = mysqli_fetch_assoc($run);
    $user_email = $result['email'];
    $user_name = $result['username'];
    session_start();
		$_SESSION['email'] = $user_email;
		$_SESSION['username'] = $user_name;



		header('location:dashboard.php');

    
	}

}

?>
<div class="container">
  <div class="row">
    <div class="col-md-12">

    <form action="" method="POST">
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" name="email"  placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" name="pass" id="" placeholder="Password">
    </div>
    <button type="submit" name="login" class="btn btn-primary">Submit</button>
  </form>
    </div>
  </div>

</div>


<script src="..assets/js/script.js" ></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" ></script>

</body>
</html>