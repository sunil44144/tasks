<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: login.php");
        exit();
    }
    include 'user_header.php';
    include 'db_connection.php';
    
$limit = 10;

$page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM users LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$totalQuery = "SELECT COUNT(*) AS total FROM users";
$totalResult = $conn->query($totalQuery);
$totalRecords = $totalResult->fetch_assoc()['total'];

$totalPages = ceil($totalRecords / $limit);

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?php include 'user_sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <div class="mt-4">
                <h2>User List</h2>
                <div class="mb-3">
                    <input type="text" id="search" class="form-control" placeholder="Search by username or email">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</button>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Photo</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userList">
                    </tbody>
                </table>
                </div>
                    <ul class="pagination">
                        <?php if ($page > 1): ?>
                            <li><a href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li>
                                <a href="?page=<?php echo $i; ?>" class="<?php echo $page == $i ? 'active' : ''; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li><a href="?page=<?php echo $page + 1; ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body with Form -->
                    <div class="modal-body">
                    <form action="save_registration.php"  method="post" enctype="multipart/form-data" id="registrationForm" onsubmit="return validateForm()">
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-user"></i> </span>
						</div>
						<input name="name" id="name" class="form-control" placeholder="Full name" type="text" required>
						<div class="error" id="nameError"></div>
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
						</div>
						<input name="email" id="email" class="form-control" placeholder="Email address" type="email" required>
						<div class="error" id="emailError"></div>
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
						</div>
						<!-- <select class="custom-select" style="max-width: 30px;">
							<option selected="">+91</option>
						</select> -->
						<input name="mobile" id="mobile" class="form-control" placeholder="Phone number" type="text" required>
						<div class="error" id="mobileError"></div>
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-building"></i> </span>
						</div>
						<select class="form-control" name="gender" id="gender" required>
							<option selected="">Gender</option>
							<option>Male</option>
							<option>Female</option>
						</select>
						<div class="error" id="genderError"></div>
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
						</div>
						<input name="address" class="form-control" placeholder="Address" type="text">
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
						</div>
						<input type="date" name="date_of_birth" class="form-control" placeholder="Date of Birth">
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
						</div>
						<input name="profile_picture" class="form-control" placeholder="Profile Picture" type="file">
					</div>
					

					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
						</div>
						<input name="password" class="form-control" placeholder="Password" type="password">
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-block"> Create Account </button>
					</div>
					<p class="text-center">Have an account? <a href="login.php">Log In</a> </p>
				</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
        $(document).ready(function() {
            
            fetchUsers(); 
            $('#search').keyup(function() {
                var searchTerm = $(this).val();
                fetchUsers(searchTerm); 
            });
            $(document).on("click","#edit", function () {
               //alert ($(this).val());
                let editprofileid = $(this).val();
                window.location.href="edit_profile.php?id="+editprofileid;                
                
            });
            
        });
        function fetchUsers(searchTerm = '') {
            $.ajax({
                url: 'get_users.php',
                method: 'POST',
                data: { search: searchTerm },
                success: function(response) {
                    $('#userList').html(response);
                }
            });
        }
        function approveUser(userId) {
            $.ajax({
                url: "approve_user.php", 
                type: "POST",
                data: { id: userId },
                success: function(response) {
                    alert(response); 
                    fetchUsers(); 
                },
                error: function() {
                    alert("Failed to approve user.");
                }
            });
        }
        function deleteUser(userId) {
            $.ajax({
                url: "delete_user.php", 
                type: "POST",
                data: { id: userId },
                success: function(response) {
                    alert(response); 
                    fetchUsers();
                },
                error: function() {
                    alert("Failed to approve user.");
                }
            });
        }
        
        $(document).on("click", ".page-link", function() {
                    let page = $(this).data("page"); 
                    loadUsers(page);
        });
    </script>
