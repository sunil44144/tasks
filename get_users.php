<?php
session_start();
include 'db_connection.php';
$role = $_SESSION['role'];

$search = isset($_POST['search']) ? $_POST['search'] : '';

$sql = "SELECT * FROM users WHERE role = 3 AND (name LIKE ? OR email LIKE ?)";
$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $i=1;
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>' . ($row['mobile']) . '</td>';
        echo '<td>' . date('d-m-Y', strtotime($row['date_of_birth'])). '</td>';
        echo '<td>' . htmlspecialchars($row['gender']) . '</td>';
        echo '<td> <img width="50" height="60" src="' . ($row['profile_picture']) . '"/></td>';
        echo '<td>' . htmlspecialchars($row['address']) . '</td>';
        echo '<td>'; if ($row['status']==1 ){echo 'Approved';}else{echo 'Not Approved';} '</td>';
        echo '<td>' . date('d-m-Y H:i', strtotime($row['created_at'])). '</td>';
        echo '<td>'; 
        if ($row['status']==0 ){
            echo '<button type="button" id="approve" onclick="approveUser('.$row['id'].')">Approve</button>';
        }
        if($role==1) {
             echo '<button type="button" id="edit" value='.$row['id'].'>Edit</button>';
        }if($role==1 || $role==2) {
            echo '<button type="button" id="delete" onclick="deleteUser('.$row['id'].')">Delete</button>';
       }
        '</td>';
        
        echo '</tr>';
        $i++;
    }
} else {
    echo '<tr><td colspan="4">No reocrds found.</td></tr>';
}
?>
