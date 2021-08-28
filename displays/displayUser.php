<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || ($_COOKIE['userType'] != "Admin")){
      header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
<head>

<meta charset="utf-8">
<link rel="stylesheet" href="display.css">
<script type="text/javascript">
    function sendGoToCourseForm(value){
                

                var submissionFrom = document.getElementById("gotoCourse"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"courseID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
                }
    function sendStudentGoToUserForm(value){
                

                var submissionFrom = document.getElementById("studentUserForm"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"userID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
                }
    function sendFacultyGoToUserForm(value){
                

                var submissionFrom = document.getElementById("FacultyUserForm"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"userID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
                }
             
</script>
<?php

$userID = $_POST['userID'];
$conn = connectToDB();
$sql = "SELECT user.* , LoginInfo.email
FROM user 
LEFT JOIN LoginInfo ON LoginInfo.userID = user.userID
WHERE user.userID = $userID";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_row();

$fullName = "$row[1] $row[2] $row[3]";
$gender = $row[4];
$address = "$row[5], $row[6], $row[7], $row[8]";
$phoneNum = $row[9];
$userType = $row[10];
$email = $row[11];

if($userType == "Admin"){
  $conn = connectToDB();
  $sql = "SELECT admin.*
  FROM admin 
  WHERE admin.userID = $userID";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_row();

  $salary = $row[1];
  $privilegeLevel = $row[2];

}
else if($userType == "Faculty"){
  $conn = connectToDB();
  $sql = "SELECT faculty.*
  FROM faculty 
  WHERE faculty.userID = $userID";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_row();

  $officeID = $row[1];
  $facultyType = $row[2];
  $facultyRank = $row[3];

  



  if($facultyType== "Full Time"){
    $sql = "SELECT fulltimefaculty.*
    FROM fulltimefaculty 
    WHERE fulltimefaculty.userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $salary = $row[1];
    $maxCourseLoad = $row[2];

  }
  else{
    $sql = "SELECT parttimefaculty.*
    FROM parttimefaculty 
    WHERE parttimefaculty.userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $wages = $row[1];
    $maxCourseLoad = $row[2];
    $maxTeachingAssistantLoad = $row[3];

  }

}

else if($userType == "Student"){
  $sql = "SELECT *
  FROM Student 
  WHERE userID = $userID";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_row();

  $numOfCredits = $row[1];
  $expectedGraduationDate = $row[2];
  $startYear = $row[3];
  $studentType = $row[4];

  if($studentType == "Undergraduate"){
    $sql = "SELECT *
      FROM undergradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $GPA = $row[1];
    $GPARequirement = $row[2];
    $creditsToGraduate = $row[3];
    $status = $row[4];

    if($status== "Full Time"){
      $sql = "SELECT *
      FROM fulltimeundergradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $maxCourseLoad = $row[1];
    }
    else{
      $sql = "SELECT *
      FROM parttimeundergradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $maxCourseLoad = $row[1];
    }
  }
  else{
    $sql = "SELECT *
      FROM gradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $GPA = $row[1];
    $GPARequirement = $row[2];
    $gradProgram = $row[3];
    $bachelorsDegree = $row[4];
    $creditsToGraduate = $row[5];
    $status = $row[6];

    if($status== "Full Time"){
      $sql = "SELECT *
      FROM fulltimegradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $maxCourseLoad = $row[1];
    }
    else{
      $sql = "SELECT *
      FROM parttimegradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $maxCourseLoad = $row[1];
    }
    
  


  }
}

?>

</head>
<body>

<?php
echo "<h1>$userType</h1>";

echo "
        <label for='userID'><b>User ID:</b> $userID </label>
        <br></br>
        <label for='fullName'><b>Full Name:</b> $fullName </label>
        <br></br>
        <label for='gender'><b>Gender:</b> $gender</label>
        <br></br>
        <label for='address'><b>Address:</b> $address </label>
        <br></br>
        <label for='phoneNumber'><b>Phone Number:</b> $phoneNum </label>
        <br></br>
        <label for='email'><b>Email Address:</b> $email </label>
        <br></br>
        ";
if($userType == "Admin"){
  echo "
        <label for='salary'><b>Salary:</b> $salary </label>
        <br></br>
        
        <label for='privilegeLevel'><b>Privilege Level:</b> $privilegeLevel </label>
        <br></br>
        ";

}
if($userType == "Faculty"){
  echo "
        <label for='officeID'><b>Office ID:</b> $officeID </label>
        <br></br>
        
        <label for='facultyType'><b>Faculty Type:</b> $facultyType </label>
        <br></br>

        <label for='facultyRank'><b>Faculty Rank:</b> $facultyRank </label>
        <br></br>
        ";
        if($facultyType == "Full Time"){
          echo "
            <label for='salary'><b>Salary:</b> $salary </label>
            <br></br>
        
            <label for='maxCourseLoad'><b>Max Course Load:</b> $maxCourseLoad </label>
            <br></br>
          ";

        }
        else{
          echo "
            <label for='wages'><b>Wages:</b> $wages </label>
            <br></br>
        
            <label for='maxCourseLoad'><b>Max Course Load:</b> $maxCourseLoad </label>
            <br></br>

            <label for='maxTeachingAssistantLoad'><b>Max Assistant Course Load:</b> $maxTeachingAssistantLoad </label>
            <br></br>
          ";

        }
        //departments
        $conn = connectToDB();
        $sql = "SELECT department.departmentName, departmentfaculty.percentageTime 
            FROM departmentfaculty
            LEFT JOIN department ON departmentfaculty.departmentID = department.departmentID 
            WHERE facultyID = $userID";
        $result = mysqli_query($conn, $sql);

        echo "
        <h3>Belongs To Departments</h3>
        <table>
        <thead>
        <tr>
        <th>Department Name</th>
        <th>Percentage Time</th>
        </tr>
        </thead>
        <tbody>  
        ";
        
        while($row = $result->fetch_row()){
          echo "<tr>";
          echo "<td>$row[0]</td>";
          echo "<td>$row[1]</td>";
          echo "</tr>";
        }
        echo "
          </tbody>
          </table>
          ";
        //advisees
        $conn = connectToDB();
        $sql = "SELECT user.userID, user.FName, user.LName,advises.dateAssigned 
          FROM advises
          LEFT JOIN User ON user.userID = advises.studentID 
          WHERE facultyID =$userID";
        $result = mysqli_query($conn, $sql);

        echo "
        
        <form method='post' id='FacultyUserForm' action='displayUser.php'>
        <h3>Advisees</h3>
        <table>
        <thead>
        <tr>
        <th>User ID</th>
        <th>Student Name</th>
        <th>Date Assigned</th>
        </tr>
        </thead>
        <tbody>  
        ";
        
        while($row = $result->fetch_row()){
          echo "<tr>";
          $studentIDString = "'" . $row[0] . "'";
          echo "<td><div class='phpHyperText' onclick=\"sendFacultyGoToUserForm($studentIDString)\">$row[0]</div></td>";
          echo "<td>$row[1] $row[2]</td>";
          echo "<td>$row[3]</td>";
          echo "</tr>";
        }
        echo "
          </tbody>
          </table>
          </form>
          ";
          //course sections
          $sql = "SELECT  coursesection.CRN, coursesection.courseID, coursesection.sectionNumber, timeslotday.dayOfTheWeek,timeslotperiod.periodNumber, Room.buildingID, Room.roomNumber
                  FROM coursesection
                  LEFT JOIN Room ON coursesection.roomID = room.roomID
                  LEFT JOIN timeslotday
                  ON timeslotday.timeslotID = coursesection.timeslotID
                  LEFT JOIN timeslotperiod
                  ON timeslotperiod.timeslotID = coursesection.timeslotID
                  WHERE coursesection.facultyID= $userID &&  coursesection.semesterID = 0
                  GROUP BY sectionNumber";
                  echo "
                  <form method='post' id='gotoCourse' action='../displays/displayCourse.php'>
                  <h4>Current Course Sections</h4>
                  <table>
                  <thead>
                  <tr>
                  <th>CRN</th>
                  <th>Course ID </th>
                  <th>Section Number</th>
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
                    $courseIDString = "'" . $row[1] . "'";
                    echo "<td><div class='phpHyperText' onclick=\"sendGoToCourseForm($courseIDString)\">$row[1]</div></td>";
                    echo "<td>$row[2]</td>";
                    if($row[3] == "Monday" || $row[3] == "Wednesday"){
                      echo "<td>Monday/Wednesday</td>";
                      }  
                    else if($row[3] == "Tuesday" || $row[3] == "Thursday"){
                      echo "<td>Tuesday/Thursday</td>";
                    }
                    else
                      echo "<td>Friday</td>";
                    echo "<td>$row[4]</td>";
                    echo "<td>$row[5]</td>";
                    echo "<td>$row[6]</td>";
              } 
              echo "
                </tbody>
                </table>
                </form>
                ";
}
if($userType == "Student"){
  echo "
        <label for='numOfCredits'><b>Number of Credits:</b> $numOfCredits </label>
        <br></br>
        
        <label for='expectedGraduationDate'><b>Expected Graduation Date:</b> $expectedGraduationDate </label>
        <br></br>

        <label for='startDate'><b>Start Year:</b> $startYear </label>
        <br></br>
        
        <label for='studentType'><b>Student Type:</b> $studentType </label>
        <br></br>

        
        <label for='maxCourseLoad'><b>Maximum Course Load:</b> $maxCourseLoad </label>
        <br></br>
        ";
        if($studentType == "Undergraduate"){
        echo "
          <label for='GPA'><b>GPA:</b> $GPA </label>
          <br></br>
        
          <label for='GPARequirement'><b>GPA Requirement:</b> $GPARequirement </label>
          <br></br>
          
          <label for='creditsToGraduate'><b>Credits to Graduate:</b> $creditsToGraduate </label>
          <br></br>
          
          <label for='status'><b>Status:</b> $status </label>
          <br></br>
          ";
        }
        else{
          echo "
            <label for='GPA'><b>GPA:</b> $GPA </label>
            <br></br>
          
            <label for='GPARequirement'><b>GPA Requirement:</b> $GPARequirement </label>
            <br></br>
            
            <label for='gradProgram'><b>Graduate Program:</b> $gradProgram </label>
            <br></br>
            
            <label for='bachelorsDegree'><b>Bachelor's Degree:</b> $bachelorsDegree </label>
            <br></br>
            

            <label for='creditsToGraduate'><b>Credits to Graduate:</b> $creditsToGraduate </label>
            <br></br>
            
            <label for='status'><b>Status:</b> $status </label>
            <br></br>
            ";
          }
          //current course load
        $sql = "SELECT * from enrollment
        LEFT JOIN coursesection ON coursesection.CRN = enrollment.CRN
        where coursesection.semesterID = 1 &&
        enrollment.studentID = $userID";
      $result = mysqli_query($conn, $sql);
      echo "<label for='status'><b>Current Course Load:</b> $result->num_rows </label>
      <br></br>";

          //advisors
        $sql = "SELECT user.userID, user.FName, user.LName,advises.dateAssigned 
          FROM advises
          LEFT JOIN User ON user.userID = advises.facultyID 
          WHERE studentID =$userID";
        $result = mysqli_query($conn, $sql);

        echo "
        <form method='post' id='studentUserForm' action='displayUser.php'>
        <h3>Advisors</h3>
        <table>
        <thead>
        <tr>
        <th>Faculty ID</th>
        <th>Faculty Name</th>
        <th>Date Assigned</th>
        </tr>
        </thead>
        <tbody>  
        ";
        
        while($row = $result->fetch_row()){
          echo "<tr>";
          $userIDString = "'" . $row[0] . "'";
          echo "<td><div class='phpHyperText' onclick=\"sendStudentGoToUserForm($userIDString)\">$row[0]</div></td>";
          echo "<td>$row[1] $row[2]</td>";
          echo "<td>$row[3]</td>";
          echo "</tr>";
        }
        echo "
          </tbody>
          </table>

          </form>
          ";
        
       

}

?>


</body>
</html>