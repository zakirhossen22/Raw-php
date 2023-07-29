<?php

include_once('inc/header.php');
include_once('admin/inc/config.php');

?>

<?php
    $post =  "SELECT * FROM post 
    LEFT JOIN category ON post.category = category.id
    ";
    $post_result = mysqli_query($con, $post);
    
    $rows = mysqli_fetch_assoc($post_result);
  ?>

<!-- page-title -->
<section class="section bg-secondary">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h4><?php echo $rows['title'];  ?></h4>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- blog single -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <ul class="list-inline d-flex justify-content-between py-3">
          <li class="list-inline-item"><i class="ti-user mr-2"></i>Post by <?php echo $rows['author']; ?></li>
          <li class="list-inline-item"><i class="ti-calendar mr-2"></i><?php echo $rows['date'];?></li>
        </ul>
        <img src="admin/images/<?php echo $rows['image'] ?>" alt="post-thumb" class="w-80 img-fluid mb-4">
        <div class="content">
          <p><?php echo $rows['description'];?></p>

          <blockquote><?php echo $rows['excerpt'];?>
          </blockquote>

          <img src="admin/images/<?php echo $rows['image'];?>" alt="image" class="img-fluid">
          <p><?php echo $rows['description'];?></p>
        </div>
      </div>
      <div class="col-lg-4">
        

        <div class="widget search-box">
        <form action="" method="POST">
          <input type="search" name="search" id="search-post" class="form-control border-0 pl-5" 
            placeholder="Search">
            <i class="ti-search"></i>
            </form>
        </div>
       
        <div class="widget">
          <h6 class="mb-4">LATEST POST</h6>
          <?php
            $post =  "SELECT * FROM post 
            LEFT JOIN category ON post.category = category.id
            LIMIT 5";
            $post_result = mysqli_query($con, $post);

            while($rows = mysqli_fetch_assoc($post_result)){
            ?>
            <div class="media mb-4">
            <div class="post-thumb-sm mr-3">
              <img class="img-fluid" src="admin/images/<?php echo $rows['image']; ?>" alt="post-thumb">
            </div>
            <div class="media-body">
              <ul class="list-inline mb-2">
                <li class="list-inline-item">Post By <?php echo $rows['author']; ?></li>
                <li class="list-inline-item"><?php echo $rows['date']; ?></li>
              </ul>
              <h6><a class="text-dark" href="blog-single.html"><?php echo $rows['title']; ?></a></h6>
            </div>
          </div>
            <?php
            } 
          
          ?>
          
        </div>
        <div class="widget">
          <h6 class="mb-4">TAG</h6>
          <ul class="list-inline tag-list">
            <li class="list-inline-item m-1"><a href="blog-single.html">ui ux</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">developmetns</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">travel</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">article</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">travel</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">ui ux</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">article</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">developmetns</a></li>
          </ul>
        </div>
        <div class="widget">
          <h6 class="mb-4">CATEGORIES</h6>
          <ul class="list-inline tag-list">
            <li class="list-inline-item m-1"><a href="blog-single.html">ui ux</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">developmetns</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">travel</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">article</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">travel</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">ui ux</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">article</a></li>
            <li class="list-inline-item m-1"><a href="blog-single.html">developmetns</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /blog single -->

<?php include_once('inc/footer.php'); ?>