<header class="header">

   <section class="flex">

      <a href="all_posts.php" class="logo">Online Movie Review System</a>

      <nav class="navbar">
         <a href="all_posts.php" class="far fa-eye"></a>
         <a href="login.php" class="fas fa-arrow-right-to-bracket"></a>
         <a href="register.php" class="far fa-registered"></a>
         <?php
            if($user_id != ''){
         ?>
         <div id="user-btn" class="far fa-user"></div>
         <?php }; ?>
      </nav>

      <?php
         if($user_id != ''){
      ?>
      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <?php if($fetch_profile['image'] != ''){ ?>
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="" class="image">
         <?php }; ?>   
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update.php" class="btn">update profile</a>
         <a href="components/logout.php" class="delete-btn" onclick="return confirm('logout from this website?');">logout</a>
         <?php }else{ ?>
            <div class="flex-btn">
               <p>please login or register!</p>
               <a href="login.php" class="inline-option-btn">login</a>
               <a href="register.php" class="inline-option-btn">register</a>
            </div>
         <?php }; ?>
      </div>
      <?php }; ?>

   </section>

</header>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Review Website</title>
    <style>
        /* Footer Styles */
        footer {
            background-color: var(--black);
            color: var(--orange);
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            footer {
                position: static;
            }
        }

        .footer-content .bcgrnd {
         color: "white";

        }
    </style>
</head>
<body>
    <!-- Your website content goes here -->

    <footer>

    <div class="footer-content">
        <p>&copy; 2024 MovieReviewSystem. All rights reserved.</p>
        <div class = "bcgrnd">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Movies</a>
        <a href="#">Contact</a>
        <a href="https://www.facebook.com/profile.php?id=61559304553900" target="_blank"><i class="fab fa-facebook-f fa-3x  "></i></a>
            <a href="https://www.instagram.com/YourMovieReviewSystem" target="_blank"><i class="fab fa-instagram fa-3x"></i></a>
      </div>
      <div class="social-links">
            
        </div>
    </div>
</footer>


</body>
</html>
