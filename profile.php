<?php

include 'db_connection.php';
session_start();
$user_id = $_SESSION['userId'];
// echo "$user_id <br>";
// exit;
$query = "SELECT * FROM users WHERE id = $user_id";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $profile = $result->fetch_assoc();
} else {
     die("User not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #ddd;
        }
        .profile-details {
            text-align: left;
            margin: 0 auto;
            max-width: 400px;
        }
        .profile-details h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .profile-details p {
            margin: 10px 0;
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }
        .profile-details strong {
            display: inline-block;
            width: 120px;
        }
    </style>
</head>
<body>
    <?php include 'user_header.php'; ?>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include 'user_sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <h1>Wel Come to <?php echo $_SESSION['userName'];?></h1>
            <div class="profile-container">
        <?php if($profile['profile_picture'] == ''){
            echo '<img width="100" src="profile_img/default-avatar.png">';
         }else{
            echo '<img src="profile_img/'.$profile['profile_picture'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         } ?>
        <div class="profile-details">
            <h2>Profile Details</h2>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($profile['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($profile['email']); ?></p>
            <p><strong>Mobile:</strong> <?php echo htmlspecialchars($profile['mobile']); ?></p>
            <p><strong>DOB:</strong> <?php echo htmlspecialchars($profile['date_of_birth']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($profile['address']); ?></p>
        </div>
    </div>
            
        </div>
    </div>
</div>
    
</body>
</html>


