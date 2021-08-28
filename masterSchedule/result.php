
<html>
<head>

<meta charset="utf-8">
<link rel="stylesheet" href="masterSchedule.css">
<script type="text/javascript">
            function sendRedirectForm(value){
                

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"courseID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";

                submissionFrom.submit();
            }

           

                  
        </script>
</head>
<body>

<h1>Results</h1>


<form method="post" id="redirectForm" action="../displays/displayCourse.php">
<?php 

$departmentWhere = "Course.departmentID != -1";
    if($_POST['department'] != '-1'){
    $departmentWhere = "Course.departmentID = " . $_POST['department'];
    }
    
    $courseIDWhere = "Course.courseID != ''";
       if($_POST['courseID'] != ''){
        $courseIDWhere = "Course.courseID LIKE '%". $_POST['courseID'] . "%'";
    }
    
    $courseNameWhere = "Course.courseName != ''";
    if($_POST['courseName'] != ''){
        $courseNameWhere = "Course.courseName LIKE '%". $_POST['courseName'] . "%'";
    }
    $LNameWhere = "User.LName != ''";
    if($_POST['LName'] != ''){
        $LNameWhere = "User.LName LIKE '". $_POST['LName'] . "%'";
    }
    $periodWhere = "Period.periodNumber != -1";
    if($_POST['period'] != '-1'){
        $periodWhere = "Period.periodNumber = ". $_POST['period'];
    }
    $dayWhere = "Day.dayOfTheWeek != ''";
    if($_POST['days'] != 'any'){
        $dayWhere = "Day.dayOfTheWeek = '". $_POST['days'] . "'";
    }
    $semesterWhere = "courseSection.semesterID = ". $_POST['semester'];
    

	include '../global.php';

    $conn = connectToDB();
    
    $sql = "SELECT 
    CourseSection.CRN, 
    Course.courseName, 
    CourseSection.SectionNumber,
    Day.dayOfTheWeek,
    Period.startTime, 
    Period.endTime, 
    User.LName, 
    Room.buildingID, 
    Room.roomNumber,
    Course.CourseID,
    Coursesection.seatsAvailable
    FROM CourseSection
    LEFT JOIN Course ON CourseSection.courseID = Course.courseID
    LEFT JOIN Timeslotday ON Timeslotday.timeslotID = CourseSection.timeslotID
    LEFT JOIN Day ON Timeslotday.dayOfTheWeek = Day.dayOfTheWeek
    LEFT JOIN Timeslotperiod ON Timeslotperiod.timeslotID = CourseSection.timeslotID
    LEFT JOIN Period ON Timeslotperiod.periodNumber = Period.periodNumber
    LEFT JOIN User ON CourseSection.facultyID = User.userID
    LEFT JOIN Room ON CourseSection.roomID = Room.roomID
    WHERE $departmentWhere && $courseIDWhere && $courseNameWhere && $LNameWhere && $periodWhere && $dayWhere && $semesterWhere
    GROUP BY CourseSection.CRN
    ORDER BY CourseSection.timeslotID";

    echo $_POST['courseID'];
    
    

    echo "
<table>
<thead>
<tr>
<th>CRN</th>
<th>Course Name</th>
            <th>Section Number</th>
            <th>Days</th>
            <th>Time</th>
            <th>Instructor Name</th>
            <th>Building Number</th>
            <th>Room Number</th>
            <th>Course ID</th>
            <th>Seats Available</th>
            
</tr>
</thead>
<tbody>  
";
$result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_row()) {
        echo "<tr>";
        echo "<td>$row[0]</td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        if($row[3] == "Monday"){
            $dayOfTheWeek = "MW";
        }
        else if($row[3] == "Tuesday"){
            
            $dayOfTheWeek = "TT";
        }
        else{

            $dayOfTheWeek = "F";
        }
        echo "<td>$dayOfTheWeek</td>";
        echo "<td>$row[4] - $row[5]</td>";
        echo "<td>$row[6]</td>";
        echo "<td>$row[7]</td>";
        echo "<td>$row[8]</td>";
        $courseIDString = "\"$row[9]\"";
        echo "<td><div class='phpHyperText' onclick='sendRedirectForm($courseIDString)'>$row[9]</td>";
        
        echo "<td>$row[10]</td>";
        echo "</tr>";
      } 
      echo "
      </tbody>
      </table>
      ";
    
?>
    </form>
</body>
</html>