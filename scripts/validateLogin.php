
<html>
<body>

<?php 

	include '../global.php';
    $username = "'" . $_POST['email'] . "'";
    $password = "'" . $_POST['password'] . "'";

    $conn = connectToDB();

    //check if the account has a hashed password.
    $sql = "SELECT * FROM LoginInfo WHERE email = $username AND hashedPWord IS NULL ";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
        $sql = "SELECT hashedPWord FROM LoginInfo WHERE email = $username";
        $result = mysqli_query($conn, $sql);

        if($result->num_rows == 1){
            $row = $result->fetch_row();
            $hashedPWord = $row[0];
        }
        if(password_verify($password, $hashedPWord)) //verify that input password matches the hashed version of it in logininfo.
            $sql = "SELECT * FROM LoginInfo WHERE email = $username AND hashedPWord = '$hashedPWord' ";
        else{
            echo "Invalid credentials.";
            die();
        }
    }
    else{//user does not have a hashed pWord.
        $sql = "SELECT * FROM LoginInfo WHERE email = " . $username . " && pWord = " . $password;
    }

    $result = mysqli_query($conn, $sql);
	if ($result->num_rows == 1 ) {

        $row = $result->fetch_row();
                
        setcookie("userID", $row[2], time() + (86400/24), "/");
	
		setcookie("user", $username, time() + (86400 /24), "/"); // 86400 = 1 day

        setcookie("userType", $row[3], time() + (86400 /24), "/");

        if(strcmp($row[3], "Student") == 0){
            header("Location:  $baseURL/Student/studentHomepage.php");
        }
        else if(strcmp($row[3], "Admin") == 0){
            header("Location:  $baseURL/Admin/adminHomepage.php");
        }
        else if(strcmp($row[3], "Faculty") == 0){
            header("Location:  $baseURL/Faculty/facultyHomepage.php");
        }
        else if(strcmp($row[3], "Researcher") == 0){
            header("Location:  $baseURL/Researcher/researcherHomepage.php");
        }
        else{
          echo "Invalid user: ". $row[3];
          session_abort();
        }
  	}
    else if($result->num_rows == 0){
        echo "Invalid credentials.";
    }
    else{
        echo "DUPLICATE ENTRY $result->num_rows";
    }

	mysqli_close($conn);
	die();
?>
</body>
</html>