<?php

include 'components/connect.php';

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:all_posts.php');
}
if(isset($_POST['submit'])){

if($user_id != ''){

   $id = create_unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $image = $_POST['image'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);



   $verify_review = $conn->prepare("SELECT * FROM `posts` WHERE id = ? AND user_id = ?");
   $verify_review->execute([$get_id, $user_id]);
   $success_msg[] = 'Movie added!';

   if($verify_review->rowCount() > 0){
      $warning_msg[] = 'Your Movie is already added!';
   }else{
      $add_review = $conn->prepare("INSERT INTO `posts`(id, title, user_id, image) VALUES(?,?,?,?)");
      $add_review->execute([$id, $title, $user_id, $image]);
      $success_msg[] = 'Movie added!';
   }

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
   <title>add review</title>

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
      <h3>Add New Movies</h3>
      <p class="placeholder">Movie Name <span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="enter movie name" class="box">
      <p class="placeholder">Upload Image <span>*</span></p>
      <input type="file" name="image" class="box" accept="image/*"><br><br>
      <input type="submit" value="submit Movie" name="submit" class="btn">
      <a href="all_posts.php?get_id=<?= $get_id; ?>" class="option-btn">go back</a>
   </form>

</section>

<!-- add review section ends -->
