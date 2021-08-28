<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Faculty"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="faculty.css">
        <style>
        table, th, td {
        border: 1px solid black;
        }
        </style>
        <script type="text/javascript">
            function sendGoToCourseSectionForm(value){
                var submissionFrom = document.getElementById("gotoCourseSection"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"CRN\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
                }
             
        </script>
    </head>
    <body>
    
    <form method='post' id='gotoCourseSection' action='../displays/displayCourseSection.php'>
        <h1>Current Course Sections You Teach:</h1>
        <?php 

        $userID = $_COOKIE['userID'];
        $conn = connectToDB();
        $sql = "SELECT Course.courseID, 
                Course.courseName, 
                coursesection.CRN, 
                timeslotday.dayOfTheWeek, 
                Period.startTime, 
                Period.endTime, 
                coursesection.startDate,
                coursesection.seatsTaken,
                coursesection.seatsAvailable,
                semester.season,
                semester.semesterYear
                FROM coursesection
                LEFT JOIN course ON coursesection.courseID = course.courseID
                LEFT JOIN timeslotday ON coursesection.timeslotID = timeslotday.timeslotID
                LEFT JOIN timeslotperiod ON coursesection.timeslotID = timeslotperiod.timeslotID
                LEFT JOIN Period ON Period.periodNumber = timeslotperiod.periodNumber
                LEFT JOIN Semester ON coursesection.semesterID = semester.semesterID
                WHERE coursesection.facultyID = $userID && semester.semesterID < 2
                GROUP BY coursesection.CRN";

        
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo "    <b>Something went wrong</b> $userID";
        }
//CourseID, Course Name, CRN, dayOfTheWeek, Start time, endTime, start date ,seats left, seats taken
        echo "
        <table>
        <thead>
        <tr>
        <th>Course ID</th>    
        <th>Course Name</th>  
        <th>CRN</th>  
        <th>Days</th>  
        <th>Start Time</th>  
        <th>End Time</th>  
        <th>Start Date</th>  
        <th>Seats Available</th>  
        <th>Seats Taken</th>
        <th>Semester</th>
        </tr>
        </thead>
        <tbody>  
        ";
        
        while ($row = $result->fetch_row()) {
            echo "
            <tr>
            ";
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            $CRNString = "'" . $row[2] . "'";
            echo "<td><div class='phpHyperText' onclick=\"sendGoToCourseSectionForm($CRNString)\">$row[2]</div></td>";
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
            echo "<td>$row[7]</td>";
            echo "<td>$row[8]</td>";
            echo "<td>$row[9] $row[10]</td>";
            echo "
            </tr>
            ";
          } 
        
        echo "
        </table>
        </tbody>
        ";
        ?>
        <h1>Previous Course Sections You Taught:</h1>
        <?php 

        $userID = $_COOKIE['userID'];
        $conn = connectToDB();
        $sql = "SELECT Course.courseID, 
                Course.courseName, 
                coursesection.CRN, 
                timeslotday.dayOfTheWeek, 
                Period.startTime, 
                Period.endTime, 
                coursesection.startDate,
                coursesection.seatsTaken,
                coursesection.seatsAvailable,
                semester.season,
                semester.semesterYear
                FROM coursesection
                LEFT JOIN course ON coursesection.courseID = course.courseID
                LEFT JOIN timeslotday ON coursesection.timeslotID = timeslotday.timeslotID
                LEFT JOIN timeslotperiod ON coursesection.timeslotID = timeslotperiod.timeslotID
                LEFT JOIN Period ON Period.periodNumber = timeslotperiod.periodNumber
                LEFT JOIN Semester ON coursesection.semesterID = semester.semesterID
                WHERE coursesection.facultyID = $userID && semester.semesterID > 2
                GROUP BY coursesection.CRN";

        
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo "    <b>Something went wrong</b> $userID";
        }
//CourseID, Course Name, CRN, dayOfTheWeek, Start time, endTime, start date ,seats left, seats taken
        echo "
        <table>
        <thead>
        <tr>
        <th>Course ID</th>    
        <th>Course Name</th>  
        <th>CRN</th>  
        <th>Days</th>  
        <th>Start Time</th>  
        <th>End Time</th>  
        <th>Start Date</th>  
        <th>Seats Available</th>  
        <th>Seats Taken</th>
        <th>Semester</th>
        </tr>
        </thead>
        <tbody>  
        ";
        
        while ($row = $result->fetch_row()) {
            echo "
            <tr>
            ";
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            $CRNString = "'" . $row[2] . "'";
            echo "<td><div class='phpHyperText' onclick=\"sendGoToCourseSectionForm($CRNString)\">$row[2]</div></td>";
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
            echo "<td>$row[7]</td>";
            echo "<td>$row[8]</td>";
            echo "<td>$row[9] $row[10]</td>";
            echo "
            </tr>
            ";
          } 
        
        echo "
        </table>
        </tbody>
        ";
        ?>
        
        </form>
    </body>
</html>