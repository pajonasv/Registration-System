
<html>
<body>

<?php 

	include '../global.php';

    setcookie("user", "", time() - 3600, "/");// 86400 = 1 day
	header("Location:  $baseURL/homepage/homepage.php"); 
  	
	die();
?>
</body>
</html>