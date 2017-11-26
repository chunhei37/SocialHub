<?php 
session_start();
        include("config.php");
	
		if(isset($_POST['email'])) {
			$uid = uniqid();
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$password1 = $_POST['password1'];
			$password2 = $_POST['password2'];
			$email = $_POST['email'];
			$gender = $_POST['gender'];
			$bday = $_POST['bday'];

			if($lname != null && $fname != null && $password1 != null && $password2 != null && $password1 == $password2 && $email !== null && $gender !== null && $bday !== null) {
					$sql = "Select * from `login` where email = '$email'";
					$result = mysqli_query($db, $sql);
					if(@mysqli_num_rows($result) < 1) {
						$password1 = sha1($email . $password1);
						
						$sql = "insert into user (userID, firstName, lastName, gender, birthday, email, password) values ('$uid', '$fname', '$lname', '$gender', '$bday', '$email', '$password1')";

						if(mysqli_query($db, $sql)) {
							$sql = "insert into aboutme (userID) values ('$uid')";
                            if(mysqli_query($db, $sql)) {
                                echo "Register sucess!";
                                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
                            }
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
            header('Location: ./index.php');
		}
		
        ?>

