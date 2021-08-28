<!DOCTYPE html>
<?php 
        include '../global.php';

    ?>
<html>
<head>
<title>NHU Master Schedule</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

</style>
</head>

<body>
	<h1>Master Schedule Search</h1>
	<form method="post" action="result.php">
	<div>
	<form  method="post" class="form" action="result.php">
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

    <div>
    <label for="courseID"><b>Course ID: </b></label>
    <input type="text" id="courseID" pattern="([a-zA-Z0-9\s]){1,10}"  title="Please enter 1-10 alphanumeric characters" name="courseID">
    </div>
    <br></br>

	<div>
    <label for="courseName"><b>Course Name: </b></label>
    <input type="text" id="courseName" pattern="([a-zA-Z0-9\s]){1,100}"  title="Please enter 1-100 alphanumeric characters" name="courseName">
    </div>
    <br></br>

    <div>
    <label for="Instructor Last Name"><b>Instructor Last Name: </b></label>
    <input type="text" id="LName" pattern="[A-Za-z]{1,25}"  title="Please enter 1-25 alphabetical characters" name="LName">
    </div>
    <br></br>

    <div>
	<form>
    <label for="Period"><b>Period: </b></label>
    	<select name="period" id="period">
		<option value = '-1'>All</option>
		<?php

        $conn = connectToDB();
        $sql = "SELECT * FROM period";
        $result = mysqli_query($conn, $sql);
		
		while($row = $result->fetch_row()){
			echo "<option value = '$row[0]'>$row[1] - $row[2]</option>";
		}

		?>
   		</select>
	</div>
	<br>
    
    
    <table>
        <tr>
            <p for="Days"><b>Days: </b></p>

			<td width="11%" class="pldefault">
            <input type="radio" name="days" value="any" id="any" checked>
            <abbr title="any">Any</abbr>
            </td>

            <td width="11%" class="pldefault">
            <input type="radio" name="days" value="Monday" id="monwed">
            <abbr title="MonWed">Mon/Wed</abbr>
            </td>

            <td width="11%" class="pldefault">
            <input type="radio" name="days" value="Tuesday" id="tuethur">
            <abbr title="TueThur">Tue/Thur</abbr>
            </td>

            <td width="11%" class="pldefault">
            <input type="radio" name="days" value="Friday" id="fri">
            <abbr title="Fri">Fri</abbr>
            </td>

        </tr>
    </table>
    <br></br>

	<p><label for="semester"><b>Semester</b></label>
            <select name="semester" id="semester">
                <option value='0'>Spring 2021</option>
                <option value='1'>Fall 2021</option>
                <option value='99'>Spring 2020</option>
                <option value='98'>Fall 2020</option>
                <option value='97'>Spring 2019</option>
                <option value='96'>Fall 2019</option>
                <option value='95'>Spring 2018</option>
                <option value='94'>Fall 2018</option>
                <option value='93'>Spring 2017</option>
                <option value='92'>Fall 2017</option>
            </select>

    <div>
    	<input type="submit" value="Class Search">
      	<input type ="reset" value="Reset">
    </div>
	</form>
    



</body>
</html>
