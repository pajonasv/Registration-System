<!doctype html>
<?php 
    
    include '../../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Researcher"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>Undergraduate Student Search</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="searchUsers.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "ResearcherHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
        </script>
    </head>
    <body>
    <h1>Undergraduate Student Search</h1>
	<form method="post" action="result.php">

    

    <div>
    <p><label><b>Study Year</b></label>
                <select name="studyYear" id="studyYear">
                <option value='any'>Any</option>
                <option value='freshman'>Freshman</option>
                <option value='sophmore'>Sophmore</option>
                <option value='junior'>Junior</option>
                <option value='senior'>Senior</option>
                </select>
    </div>

    <div>
    <p><label><b>Start Year</b></label>
                <select name="startYear" id="startYear">
                <option value='any'>Any</option>
                <option value='2017'>2017</option>
                <option value='2018'>2018</option>
                <option value='2019'>2019</option>
                <option value='2020'>2020</option>
                <option value='2021'>2021</option>
                </select>
    </div>

    <div>
    <p><label><b>Graduation Year</b></label>
                
    <input type="number" class="field" placeholder="Graduation Year" name="graduationYear"  min = "2017" max = "2030"></p>
    </div>
    <div>
    <p><label><b>Status</b></label>
                <select name="undergradStatus" id="undergradStatus">
                <option value='any'>Any</option>
                <option value='Full Time'>Full Time</option>
                <option value='Part Time'>Part Time</option>
                </select>
    </div>

    <div>
        
    <p><label><b>Major</b></label>
    <select name="major" id ="major">
        <option value='any'>Any</option>
    <?php
    $conn = connectToDB();

    $sql = "SELECT majorID, majorName FROM Major";
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_row()){

        echo "<option value='$row[0]'>$row[1]</option>";
    }
	?>
    </select>
    </div>

    <div>
        
    <p><label><b>Minor</b></label>
    <select name="minor" id ="minor">
        <option value='any'>Any</option>
    <?php
    $conn = connectToDB();

    $sql = "SELECT minorID, minorName FROM Minor";
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_row()){

        echo "<option value='$row[0]'>$row[1]</option>";
    }
	?>
    </select>
    </div>

    <div>
    <p><label><b>Minimum GPA</b></label>
    <input type="number" name="minGPA" min="0" max = "4" value="0" step=".01">
    </div>
    <div>
    <p><label><b>Maximum GPA</b></label>
    <input type="number" name="maxGPA" min="0" max="4" value="4" step=".01">
    </div>

    <input type = "hidden" name = "userType" value = "undergradStudent" />


    <p><input type="submit" value="Submit">
    <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>

	</form>

    <form action= "../../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>