<?php

include 'components/connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>promotion post</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
  .all-posts {
   background-image: url('uploaded_files/cinema.jpg');

  .map {
    width: 310px;
    height: 110px;
    background-color: lightblue  ;
    border: px solid #333;
    background-image: url('uploaded_files/sun.jpg');
    border-radius: 10px;
    padding: 10px;
    margin: 0px;
  }

  /* CSS for text inside the box */
  .map p {
    font-size: 20px;
    color: #333;
  }
</style>
</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<!-- view all posts section starts  -->

<section class="all-posts">

   
   <div class="heading"><h1>Movie Trailer</h1> <a href="add_trailers.php?get_id=<?= $get_id; ?>" class="inline-btn" style="margin-top: 0;">Add Trailer</a></div>
   <div class="box-container">

   <?php
      $select_posts = $conn->prepare("SELECT * FROM `trailers`");
      $select_posts->execute();
      if($select_posts->rowCount() > 0){
         while($fetch_post = $select_posts->fetch(PDO::FETCH_ASSOC)){

         $post_id = $fetch_post['id'];

         $count_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
         $count_reviews->execute([$post_id]);
         $total_reviews = $count_reviews->rowCount();
   
   ?>
  
   <div class="box">
      <!--<img src="uploaded_files/<?= $fetch_post['video']; ?>" alt="" class="video">-->
      <video width = "100%" length = "100%" controls > 
         <source src="uploaded_files/<?= $fetch_post['video']; ?>" id = "video" alt="" class="video" type ="video/mp4"> </video><br><br>
         <h3 class="title"> *<?= $fetch_post['title']; ?>*</h3><br>
         <div class = "map">
      
      <h2 >Cast: <?= $fetch_post['cast']; ?> </h2><br>
      <h2 >Release Date: <?= $fetch_post['date']; ?> </h2>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no posts added yet!</p>';
   }
   ?>

   </div>

</section>

<!-- view all posts section ends -->



<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>

