<?php

include 'db_connection.php';
session_start();

if(isset($_POST['submit'])){

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, md5($_POST['password']));
  
  $query="SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
  $select = mysqli_query($conn, $query );

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
        if($row['status']==0){
            $_SESSION['errorMessage']='Your Account Is not Approved';
            header('location: login.php');
            exit;
        }
        //echo "login success";
      $_SESSION['userId'] = $row['id'];
      $_SESSION['userName'] = $row['name'];
      $_SESSION['userEmail'] = $row['email'];
      $_SESSION['role'] = $row['role'];
        // print_r( $_SESSION['userId']);
        // exit;
      header('location:dashboard.php');
    }else{
      $message[] = 'incorrect email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="stylesheet" href="css/style.css">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"/>
    <link  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"/>
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css"
    rel="stylesheet" />

</head>
<body>

<div class="form-container mt-5">
    <div class="container" style="max-width: 350px;">
        <?php
            if (isset($_SESSION['errorMessage'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['errorMessage'] . '</div>';
                unset($_SESSION['errorMessage']);
            }
        ?>
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form action="" method="post" enctype="multipart/form-data">
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" name="email"  class="form-control" />
                    <label class="form-label" for="loginName" require>Email</label>
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="password"  class="form-control" />
                    <label class="form-label" for="loginPassword">Password</label>
                </div>
                <button type="submit" name="submit"  class="btn btn-primary btn-block mb-4">Sign in</button>
                <div class="text-center">
                    <p>Not a member? <a href="registration.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.umd.min.js"></script>
</html>