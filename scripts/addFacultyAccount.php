<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user'])){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">

<head>
<title>
 addFaculty
 </title>
</head>

<body>
<?php 
	$FName = "'" . $_POST['FName'] . "'";
	$MName = "'" . $_POST['MName'] . "'";
	$LName = "'" . $_POST['LName'] . "'";
	$gender = "'" . $_POST['gender'] . "'";
	$street = "'" . $_POST['street'] . "'";
	$city = "'" . $_POST['city'] . "'";
	$state = "'" . $_POST['state'] . "'";
	$zipCode = $_POST['zipcode'];
	$phoneNumberOld = $_POST['phoneNumber'] . "";
	$phoneNumber = substr($phoneNumberOld,0,3) . substr($phoneNumberOld,4,3) . substr($phoneNumberOld,8,4);
    

	
    $conn = connectToDB();

	//generate userID
	$sql = "SELECT userID FROM User ORDER BY userID DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_row();
	$userID = $row[0] + 1;

	//pWord
	$password = "";
	for($x = 0; $x < 10; $x++){
		$password = $password . chr(rand(97,122));
	}
	$password = "'" . $password . "'";

	//get email
	$email = substr($FName,1,1) . substr($LName,1,strlen($LName) - 2) ."@nhu.edu";
	
	$sql = "SELECT email FROM loginInfo WHERE email = '$email'";
	$emailCounter = 0;
	$result = mysqli_query($conn, $sql);
	while($result->num_rows > 0){
		$emailCounter = $emailCounter + 1;	
		$email = substr($FName,1,1) . substr($LName,1,strlen($LName) - 2) . $emailCounter ."@nhu.edu";
		
		$sql = "SELECT email FROM loginInfo WHERE email = $email";
		$result = mysqli_query($conn, $sql);
	}
	$email = "'" . $email . "'";

	
	//faculty type
	$facultyType = "'Part Time'";
	if ($_POST['facultyType'] == "fullTime"){
		$facultyType = "'Full Time'";
	}
	else{

	}

	//get Rank
	$sql = 'SELECT departmentID FROM department';
	$result = mysqli_query($conn, $sql);
	$i = 0;
	$facultyRank = "'Associate Professor'";
	while($row = $result->fetch_row()){
		
		$department[$i][0] = $row[0];
		$department[$i][1] = $_POST["department$row[0]"];
		if($department[$i][1] != "Associate Professor" && $department[$i][1] != "Unrelated"){
			
			$facultyRank = "'Professor'";
		}
		
		echo "<p>" .$department[$i][0] . "  ". $department[$i][1] . "</p>";

		$i++;
	}
	//get salary
	$salary = 30000;
	for($x = 0; $x < count($department); $x++){
		if($department[$x][1] ==  "Professor" && $salary < 40000){
			$salary = 40000;
		}
		else if($department[$x][1] ==  "Manager" && $salary < 50000){
			$salary = 50000;
		}
		else if($department[$x][1] ==  "Head" && $salary < 60000){
			$salary = 60000;
		}
	}

	//making office
	$sql = "SELECT roomID, roomNumber FROM Room ORDER BY roomID DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_row();
	$officeNum = $row[0] + 1;
	$roomNumber = $row[1]+1;

	$sql = "INSERT INTO Room VALUES($officeNum,0, $roomNumber, 'Office')";
	$result = mysqli_query($conn, $sql);

	$sql = "INSERT INTO officeRoom VALUES($officeNum, 10)";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "SOMETHING WENT WRONG WITH INSERT INTO officeRoom";
		echo $result->error;
		die();
	}

	//adding the thing
	$sql = "INSERT INTO User VALUES($userID, $FName, $MName, $LName, $gender, $street, $city, $state, $zipCode, $phoneNumber, 'Faculty')";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "SOMETHING WENT WRONG WITH INSERT INTO User";
		echo $result->error;
		die();
	}
	$sql = "INSERT INTO logininfo VALUES($email,$password, $userID, 'Faculty', NULL)";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "SOMETHING WENT WRONG WITH INSERT INTO loginInfo";
		echo $result->error;
		die();
	}
	
	$sql = "INSERT INTO Faculty VALUES($userID, $officeNum, $facultyType, $facultyRank)";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "SOMETHING WENT WRONG WITH INSERT INTO Faculty";
		echo $result->error;
		die();
	}

	if($facultyType == "'Full Time'"){
		
		$sql = "INSERT INTO FulltimeFaculty VALUES($userID,$salary,3)";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "SOMETHING WENT WRONG WITH INSERT INTO fulltimefaculty";
			mysqli_error($conn);
			die();
		}
		
	}
	else{
		$sql = "INSERT INTO ParttimeFaculty VALUES($userID,$salary,1,1)";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "SOMETHING WENT WRONG WITH INSERT INTO parttimefaculty";
			mysqli_error($conn);
			die();
		}
		
	}
	//add them to the department(s)
	
	for($x = 0; $x < count($department); $x++){

		if($department[$x][1] != "Unrelated"){
			$departmentID = $department[$x][0];
			$sql = "INSERT INTO departmentFaculty VALUES($departmentID,$userID,1.0)";
			$result = mysqli_query($conn, $sql);
			if(!$result){
				echo "SOMETHING WENT WRONG WITH INSERT INTO departmentFaculty";
				mysqli_error($conn);
				die();
			}
			if($department[$x][1] == "Manager"){
				$sql = "SELECT managerID FROM department WHERE departmentID = $departmentID";
				$result = mysqli_query($conn, $sql);
				$row = $result->fetch_row();
				$sql = "UPDATE faculty SET facultyRank = 'Professor' WHERE userID = $row[0]";
				$result = mysqli_query($conn, $sql);
				if(!$result){
					echo "Something went wrong with updating changed department Manager";
					die();
				}

				$sql = "UPDATE department set managerID = $userID WHERE departmentID = $departmentID";
				$result = mysqli_query($conn, $sql);
				if(!$result){
					echo "SOMETHING WENT WRONG WITH UPDATE department SET managerID";
					mysqli_error($conn);
					die();
				}
			}
			if($department[$x][1] == "Head"){

				$sql = "SELECT headID FROM department WHERE departmentID = $departmentID";
				$result = mysqli_query($conn, $sql);
				$row = $result->fetch_row();
				$sql = "UPDATE faculty SET facultyRank = 'Professor' WHERE userID = $row[0]";
				$result = mysqli_query($conn, $sql);
				if(!$result){
					echo "Something went wrong with updating changed department Head";
					die();
				}

				$sql = "UPDATE department set headID = $userID WHERE departmentID = $departmentID";
				$result = mysqli_query($conn, $sql);
				if(!$result){
					echo "SOMETHING WENT WRONG WITH UPDATE department SET headID";
					mysqli_error($conn);
					die();
				}
			}
		}
	}
	echo "Added Faculty account with details: UsedId: $userID, First Name: $FName, 
			Middle Name: $MName, Last Name: $LName, Gender: $gender, Street: $street, 
				City: $city, State: $state, Zip: $zipCode, phone: $phoneNumber";

	die();
?>


</body>
</html>