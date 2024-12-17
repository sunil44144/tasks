<?php
include 'db_connection.php';

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $query = "UPDATE users SET status = 1 WHERE id = $id";
   
    if ($conn->query($query) === TRUE){
        echo "User approved successfully!";
    } else {
        echo "Failed to approve user.";
    }
    
} else {
    echo "Invalid request.";
}

?>
