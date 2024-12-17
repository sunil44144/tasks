<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body>

	<div class="container">

		<div class="card bg-light">
			<article class="card-body mx-auto" style="max-width: 400px;">
				<h4 class="card-title mt-3 text-center">Create Account</h4>

				<form action="save_registration.php" method="post" enctype="multipart/form-data" id="registrationForm" onsubmit="return validateForm()">
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
			</article>
		</div>
	</div>
	<script>
        function validateForm() {
            let valid = true;

            const name = document.getElementById("name").value.trim();
            const dob = document.getElementById("dob").value;
            const email = document.getElementById("email").value.trim();
            const mobile = document.getElementById("mobile").value.trim();
            const gender = document.getElementById("gender").value;

            document.getElementById("nameError").innerText = "";
            document.getElementById("dobError").innerText = "";
            document.getElementById("emailError").innerText = "";
            document.getElementById("mobileError").innerText = "";
            document.getElementById("genderError").innerText = "";

            if (name === "") {
                document.getElementById("nameError").innerText = "Name is required.";
                valid = false;
            }

            if (dob === "") {
                document.getElementById("dobError").innerText = "Date of Birth is required.";
                valid = false;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                document.getElementById("emailError").innerText = "Please enter a valid email address.";
                valid = false;
            }

            const mobilePattern = /^[0-9]{10}$/;
            if (!mobilePattern.test(mobile)) {
                document.getElementById("mobileError").innerText = "Please enter a 10-digit mobile number.";
                valid = false;
            }

            if (gender === "") {
                document.getElementById("genderError").innerText = "Please select your gender.";
                valid = false;
            }

            return valid;
        }
    </script>
</body>

</html>