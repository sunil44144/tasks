<?php 

 $role = $_SESSION['role'];
?>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px;"> 
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link active" aria-current="page">
                Dashboard
            </a>
        </li>
        <?php if ($role == 1 || $role == 2): ?>
            <li>
                <a href="userlist.php" class="nav-link link-dark">
                    Users
                </a>
            </li>
        <?php endif;?>
        <li>
            <a href="profile.php" class="nav-link link-dark">
                Profile
            </a>
        </li>
        <li>
            <a href="logout.php" class="nav-link link-dark">
                Log Out
            </a>
        </li>
    </ul>
    <hr>
</div>