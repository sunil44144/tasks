<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: login.php");
        exit();
    }
    include 'user_header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include 'user_sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <h1>Wel Come to <?php echo $_SESSION['userName'];?></h1>
            
            
        </div>
    </div>
</div>