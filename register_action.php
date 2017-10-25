<?php 
session_start();
        include("config.php");
	
		if(isset($_POST['username'])) {
			$uid = uniqid();
			$username = $_POST['username'];
			$password1 = $_POST['password1'];
			$password2 = $_POST['password2'];
			$email = $_POST['email'];
			$gender = $_POST['gender'];
			$bday = $_POST['bday'];

			if($username != null && $password1 != null && $password2 != null && $password1 == $password2 && $email !== null && $gender !== null && $bday !== null) {
					$sql = "Select * from `login` where user_email = '$email'";
					$result = mysqli_query($db, $sql);
					if(@mysqli_num_rows($result) < 1) {
						$password1 = sha1($email . $password1);
						
						$sql = "insert into user (user_id, user_name,user_gender, user_birthday, user_email, user_password) values ('$uid', '$username', '$gender', '$bday', '$email', '$password1')";

						if(mysqli_query($db, $sql)) {
							echo "Register sucess!";
							echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
							} else {
								echo "Register unsucess!";
			echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
							}
			

					} else {
                        echo "Username has already been taken!";
                        echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';

					}
					} else {
						echo "Information incorrect!";
						echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
					}
		} else {
			echo "You don't have permission to access current page!";
		}
		
        ?>

