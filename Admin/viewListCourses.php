<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Admin"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>Course Search</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="admin.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "adminHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
        </script>
    </head>
    <body>
    <h1>Course Search</h1>
	<form method="post" action="viewListCoursesResult.php">
	<div>
    <label for="department"><b>Department: </b></label>
    	<select name="department" id="department">
		<option value = '-1'>All</option>
		<?php

        $conn = connectToDB();
        $sql = "SELECT departmentName, departmentID
                FROM Department";
        $result = mysqli_query($conn, $sql);
		
		while($row = $result->fetch_row()){
			echo "<option value = '$row[1]'>$row[0]</option>";
		}

		?>
   		</select>
	</div>
    <br></br>

    <p><label for="courseType"><b>Course Type</b></label>
            <select name="courseType" id="courseType">
                <option value='any'>Any</option>
                <option value='undergraduate'>Undergraduate</option>
                <option value='graduate'>Graduate</option>
            </select>
    <br></br>

    <div>
    <label for="courseID"><b>Course ID: </b></label>
    <input type="text" pattern="([a-zA-Z0-9\s]){1,10}"  title="Please enter 1-10 alphanumeric characters" id="courseID" name="courseID">
    </div>
    <br></br>

	<div>
    <label for="courseName"><b>Course Name: </b></label>
    <input type="text" id="courseName" pattern="([a-zA-Z0-9\s]){1,100}"  title="Please enter 1-100 alphanumeric characters" name="courseName">
    </div>
    <br></br>


	

    <div>
    	<input type="submit" value="Class Search">
      	<input type ="reset" value="Reset">
    </div>
	</form>
    </body>
</html>