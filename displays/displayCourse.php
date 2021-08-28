<!doctype html>
<?php 
    
    include '../global.php';
?>
<html lang="en">
<head>

<meta charset="utf-8">
<link rel="stylesheet" href="display.css">
<script type="text/javascript">
  function sendRedirectForm(value){
                

    var submissionFrom = document.getElementById("redirectForm"); 

    submissionFrom.innerHTML = "<input type = \"hidden\" name = \"courseID\" value = "+ value +" />" +
    "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";

    submissionFrom.submit();
    }
    function sendGoToCourseForm(value){
                

                var submissionFrom = document.getElementById("gotoCourse"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"courseID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
      }
      function sendGoToUserForm(value){
                

                var submissionFrom = document.getElementById("gotoUserForm"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"userID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
                }
             
</script>

</head>
<body>
<p><button type="submit" onclick="history.back()">Back</button>

<?php 
    $courseID = "'" . $_POST['courseID'] . "'";

    $conn = connectToDB();
    $sql = "SELECT course.courseName, course.credits, department.departmentName 
    FROM Course
    LEFT JOIN Department ON department.departmentID = course.departmentID
    WHERE course.courseID = $courseID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $courseName = $row[0];
    $credits = $row[1];
    $departmentName = $row[2];

    $sql = "SELECT minimumpassinggrade
    FROM undergradcourse
    WHERE undergradcourse.courseID = $courseID";

    $result = mysqli_query($conn, $sql);

    $courseType = "Undergraduate Course";
    if($result->num_rows > 0){   
        $row = $result->fetch_row();
        $minimumPassingGrade = $row[0];
    }
    else{
        
        $courseType = "Graduate Course";

        $sql = "SELECT minimumpassinggrade, major.majorName, minor.minorName
        FROM gradcourse
        LEFT JOIN majorrequirement ON majorrequirement.courseID = gradcourse.courseID
        LEFT JOIN major ON majorrequirement.majorID = major.majorID
        LEFT JOIN minorrequirement ON minorrequirement.courseID = gradcourse.courseID
        LEFT JOIN minor ON minorrequirement.minorID = minor.minorID
        WHERE gradcourse.courseID = $courseID";
        $result = mysqli_query($conn, $sql);
        
        $row = $result->fetch_row();
        $minimumPassingGrade = $row[0];
        $majorRequirementName = $row[1];
        $minorRequirementName = $row[2];

        if (isset($row[1])){
            $majorRequirement = "None";
        }
        
        if ($minorRequirement == null){
            $minorRequirement = "None";
        }

    }

    echo "
        <h2>" . $_POST['courseID'] . " - $courseName</h2>
        <label for='course type'><b>Course Type:</b> $courseType </label>
        <br></br>
        <label for='credits'><b>Credit Amount:</b> $credits</label>
        <br></br>
        <label for='departmentName'><b>Department:</b> $departmentName </label>
        <br></br>
        <label for='minimumPassingGrade'><b>Minimum Passing Grade:</b> $minimumPassingGrade </label>
        <br></br>
        ";
        if($courseType == "Graduate Course"){
            echo "<label for='majorRequirement'><b>Major Requirement:</b> $majorRequirementName </label>
                  <br></br>
                  <label for='minorRequirement'><b>Minor Requirement:</b> $minorRequirementName </label>
                  <br></br>";
        }

        $sql = "SELECT prerequisite.prerequisiteCourseID, prerequisite.gradeRequirement, prerequisite.creditRequirement
                FROM prerequisite
                WHERE courseID = $courseID";
        
        
    
        echo "
        
    <form method='post' id='gotoCourse' action='../displays/displayCourse.php'>
    <hr>
    <h3>Prerequisites</h3>
    <table>
    <thead>
    <tr>
    <th>Prerequisite ID</th>
    <th>Grade Requirement</th>
    <th>CreditRequirement</th>
    </tr>
    </thead>
    <tbody>  
    ";
    $result = mysqli_query($conn, $sql);
        while ($row = $result->fetch_row()) {
            echo "<tr>";
            $courseIDString = "'" . $row[0] . "'";
            echo "<td><div class='phpHyperText' onclick=\"sendGoToCourseForm($courseIDString)\">$row[0]</div></td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
          } 
          echo "
          </tbody>
          </table>
          ";
    echo "</form>";

    echo "
    <hr>
    <h3>Course Sections</h3>";
    
$sql = "SELECT  coursesection.CRN, coursesection.sectionNumber, user.FName, user.LName, timeslotday.dayOfTheWeek,timeslotperiod.periodNumber, Room.buildingID, Room.roomNumber, user.userID
FROM coursesection
LEFT JOIN Room ON coursesection.roomID = room.roomID
LEFT JOIN timeslotday
ON timeslotday.timeslotID = coursesection.timeslotID
LEFT JOIN timeslotperiod
ON timeslotperiod.timeslotID = coursesection.timeslotID
LEFT JOIN User ON user.userID = coursesection.facultyID
WHERE coursesection.courseID = $courseID &&  coursesection.semesterID = 1
GROUP BY sectionNumber";
  
  

  echo "
  <h4>Fall 2021</h4>
<table>
<thead>
<tr>
<th>CRN</th>
<th>Section Number</th>
<th>Professor Name</th>
<th>Days</th>
<th>Period</th>
<th>Building</th>
<th>Room</th>
</tr>
</thead>
<tbody>  
";
$result = mysqli_query($conn, $sql);
  while ($row = $result->fetch_row()) {
      echo "<tr>";
      echo "<td>$row[0]</td>";
      echo "<td>$row[1]</td>";
      echo "<td> 
      <form method='post' id='gotoUserForm' action='displayUser.php'>
      <div class='phpHyperText' onclick=\"sendGoToUserForm($row[8])\">
      $row[2] $row[3] 
      </div>
      </form>
      </td>";
      if($row[4] == "Monday" || $row[4] == "Wednesday"){
        echo "<td>Monday/Wednesday</td>";
        }  
      else if($row[4] == "Tuesday" || $row[4] == "Thursday"){
        echo "<td>Tuesday/Thursday</td>";
      }
      else
        echo "<td>Friday</td>";
      echo "<td>$row[5]</td>";
      echo "<td>$row[6]</td>";
      echo "<td>$row[7]</td>";
    } 
    echo "
    </tbody>
    </table>
    ";


    $sql = "SELECT  coursesection.CRN, coursesection.sectionNumber, user.FName, user.LName, timeslotday.dayOfTheWeek,timeslotperiod.periodNumber, Room.buildingID, Room.roomNumber, user.userID
FROM coursesection
LEFT JOIN Room ON coursesection.roomID = room.roomID
LEFT JOIN timeslotday
ON timeslotday.timeslotID = coursesection.timeslotID
LEFT JOIN timeslotperiod
ON timeslotperiod.timeslotID = coursesection.timeslotID
LEFT JOIN User ON user.userID = coursesection.facultyID
WHERE coursesection.courseID = $courseID &&  coursesection.semesterID = 0
GROUP BY sectionNumber";
  
  

  echo "
  <h4>Spring 2021</h4>
<table>
<thead>
<tr>
<th>CRN</th>
<th>Section Number</th>
<th>Professor Name</th>
<th>Day</th>
<th>Period</th>
<th>Building</th>
<th>Room</th>
</tr>
</thead>
<tbody>  
";
$result = mysqli_query($conn, $sql);
  while ($row = $result->fetch_row()) {
      echo "<tr>";
      echo "<td>$row[0]</td>";
      echo "<td>$row[1]</td>";
      echo "<td> 
      <form method='post' id='gotoUserForm' action='displayUser.php'>
      <div class='phpHyperText' onclick=\"sendGoToUserForm($row[8])\">
      $row[2] $row[3] 
      </div>
      </form>
      </td>";
      if($row[4] == "Monday" || $row[4] == "Wednesday"){
        echo "<td>Monday/Wednesday</td>";
        }  
      else if($row[4] == "Tuesday" || $row[4] == "Thursday"){
        echo "<td>Tuesday/Thursday</td>";
      }
      else
        echo "<td>Friday</td>";
      echo "<td>$row[5]</td>";
      echo "<td>$row[6]</td>";
      echo "<td>$row[7]</td>";
    } 
    echo "
    </tbody>
    </table>
    ";

    
        


?>
</body>
</html>