<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id']=$row['id'];
      header('location:index.html');
   }
   else{
    $message[] = 'incorrect username or password'; 
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Registeration</title>
</head>
<body>
    <div class="form-container" >

    <img src="./assest/login" alt="" class="image">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Login Now</h3>
            <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
    
    <input type="email"  placeholder="Enter Email" class="box" name="email" required>
    <input type="password"  placeholder="Enter Password" class="box" name="password" required>
    <input type="password"  placeholder="Enter  Confirm Password" class="box" name="cpassword" required>
    <input type="submit" name="submit" value="login now" class="btn">
    <p>don't have an account? <a href="register.php">register now</a></p>
       </form>
    </div>
</body>
</html>
