<?php

 include 'db_connection.php';
//  session_start();
// $user_id = $_SESSION['userId'];
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // Sanitize input
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found.");
    }
} else {
    die("Invalid request.");
}

if(isset($_POST['update_profile'])){

    $update_name = mysqli_real_escape_string($conn, $_POST['name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['email']);
    $update_mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $update_dob = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $update_address = mysqli_real_escape_string($conn, $_POST['address']);

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $uploadDir = 'profile_img/'; 
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileName = $_FILES['profile_picture']['name'];
        $fileTmpName = $_FILES['profile_picture']['tmp_name'];
        $fileSize = $_FILES['profile_picture']['size'];
        $fileType = $_FILES['profile_picture']['type'];
        $uniqueFileName = uniqid() . '_' . basename($fileName);
        if (!in_array($fileType, $allowedTypes)) {
            echo "Only JPEG, PNG, and GIF images are allowed.";
            exit;
        }

        if ($fileSize > 5000000) { 
            echo "File size should not exceed 5MB.";
            exit;
        }
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $uploadFilePath = $uploadDir . $uniqueFileName;
        if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
        } else {
            echo "There was an error uploading the file.";
        }
    }
    mysqli_query($conn, "UPDATE `users` SET name = '$update_name', email = '$update_email', mobile = '$update_mobile', date_of_birth = '$update_dob', address = '$update_address' , profile_picture = '$uploadFilePath' WHERE id = '$user_id'") or die('query failed');  
    header('location:userlist.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      
      <div class="flex">
         <div class="inputBox">
            <span>User Name :</span>
            <input type="text" name="name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>Email :</span>
            <input type="email" name="email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>Mobile :</span>
            <input type="mobile" name="mobile" value="<?php echo $fetch['mobile']; ?>" class="box">
            <span>DOB :</span>
            <input type="date" name="date_of_birth" value="<?php echo $fetch['date_of_birth']; ?>" class="box">
            <span>Address :</span>
            <input type="text" name="address" value="<?php echo $fetch['address']; ?>" class="box">
            <span>Image:</span>
            <input type="file" id="profile_image" name="profile_picture" accept="image/jpg, image/jpeg, image/png" value="<?php echo $fetch['profile_picture']; ?>" class="box">
         </div>
         <div>
            <img id="preview" src="profile_img/<?php echo $fetch['profile_picture']; ?>" alt="" srcset="">
         </div>
         
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a href="userlist.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
<script>
    document.getElementById('profile_image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result; 
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
</script>
</html>