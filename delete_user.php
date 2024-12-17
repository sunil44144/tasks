<?php
include 'db_connection.php';

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $query = "DELETE FROM users WHERE id = $id";
   // $stmt = $conn->prepare($query);
    if ($conn->query($query) === TRUE){
        echo "User deleted successfully!";
    } else {
        echo "Failed to delete user.";
    }
    
} else {
    echo "Invalid request.";
}

?>
