<?php 
    include 'db_connection.php';

    if(isset($_POST['submit'])) {   
        $name=$_POST['name'];
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $password=md5($_POST['password']);
        $address=$_POST['address'];
        $gender=$_POST['gender'];
        $dateOfBirth=$_POST['date_of_birth'];
        $role=3;
        $uploadFilePath = null;

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
        // echo $fileTmpName.'=';
        // echo $uploadFilePath;
        // exit;
        $query="INSERT INTO `users`(`name`, `mobile`, `email`, `password`, `address`, `gender`, `date_of_birth`, `role`, `profile_picture`) 
        VALUES ('$name', '$mobile', '$email', '$password', '$address', '$gender', '$dateOfBirth', $role, '$uploadFilePath')";
           
           
        if (mysqli_query($conn, $query)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

    }
?>