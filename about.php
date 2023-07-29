<?php 

include_once('inc/header.php');
include_once('admin/inc/config.php');




?>
<?php
      $user =  "SELECT * FROM users";
      $user_result = mysqli_query($con, $user);
      $rows = mysqli_fetch_assoc($user_result)
      ?>
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="mb-4">About Me</h2>
        <img src="admin/images/<?php echo $rows['user_img']; ?>" alt="author" class="img-fluid w-100 mb-4">
        <h3 class="font-weight-light">Hello, I’m <span class="font-weight-bold"><?php echo $rows['username']; ?></span></h3>
        <p><?php echo $rows['about']; ?>
        </p>
      </div>
    </div>
  </div>
</section>


<!-- instagram -->
<section>
  <div class="container-fluid px-0">
    <div class="row no-gutters instagram-slider" id="instafeed" data-userId="4044026246"
      data-accessToken="4044026246.1677ed0.8896752506ed4402a0519d23b8f50a17"></div>
  </div>
</section>
<!-- /instagram -->

<?php include_once('inc/footer.php'); ?>