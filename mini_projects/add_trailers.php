<?php

include 'components/connect.php';

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:promotion.php');
}
if(isset($_POST['submit'])){

if($user_id != ''){

   $id = create_unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $video = $_POST['video'];
   $video = filter_var($video, FILTER_SANITIZE_STRING);
   $cast = $_POST['cast'];
   $cast = filter_var($cast, FILTER_SANITIZE_STRING);
   $date = $_POST['date'];
   $date = filter_var($date, FILTER_SANITIZE_STRING);


   $verify_review = $conn->prepare("SELECT * FROM `trailers` WHERE id = ? AND user_id = ?");
   $verify_review->execute([$get_id, $user_id]);
   $success_msg[] = 'Movie added!';

   $add_review = $conn->prepare("INSERT INTO `trailers`(id, title, user_id, date, cast, video) VALUES(?,?,?,?,?,?)");
   $add_review->execute([$id, $title, $user_id, $date, $cast, $video]);
   $success_msg[] = 'Movie Trailer added!';

}else{
   $warning_msg[] = 'Please login first!';
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>add trailer</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<!-- add review section starts  -->

<section class="account-form">

   <form action="" method="post">
      <h3>Add New Movie Trailer</h3>
      <p class="placeholder">Movie Title <span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="Enter a valid title" class="box">
      <p class="placeholder">Cast <span>*</span></p>
      <input type="text" name="cast" required maxlength="100" placeholder="Enter cast names" class="box">
      <p class="placeholder">Select Release date <span>*</span></p>
      <input type="date" id="date" name="date" class = "box">
      <p class="placeholder">Upload video <span>*</span></p>
      <input type="file" id="video" name="video" accept="video/*" class = "box" ><br><br>
      <input type="submit" value="submit Movie" name="submit" class="btn" >
      <a href="all_posts.php?get_id=<?= $get_id; ?>" class="option-btn">go back</a>
   </form>

</section>

<!-- add review section ends -->
