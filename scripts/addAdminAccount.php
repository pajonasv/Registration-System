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
 addAdmin
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
	$privelageLevel = $_POST['privelageLevel'];
    

	
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




	$sql = "INSERT INTO User VALUES($userID, $FName, $MName, $LName, $gender, $street, $city, $state, $zipCode, $phoneNumber, 'Admin')";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "SOMETHING WENT WRONG WITH INSERT INTO User";
		echo $result->error;
		die();
	}
	$sql = "INSERT INTO logininfo VALUES($email,$password, $userID, 'Admin', NULL)";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "SOMETHING WENT WRONG WITH INSERT INTO loginInfo";
		echo $result->error;
		die();
	}
	
	$sql = "INSERT INTO Admin VALUES($userID,40000,$privelageLevel)";
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo "SOMETHING WENT WRONG WITH INSERT INTO Admin";
		echo $result->error;
		die();
	}

	echo "Added Admin account with details: UsedId: $userID, First Name: $FName, 
			Middle Name: $MName, Last Name: $LName, Gender: $gender, Street: $street, 
				City: $city, State: $state, Zip: $zipCode, phone: $phoneNumber";


    die();
?>


</body>
</html>