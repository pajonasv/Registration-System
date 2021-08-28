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
        <title>View Course-Section Student List</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="faculty.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "facultyHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
        </script>
    </head>
    <body>
        <h1>View Course-Section Student List</h1>
        <form method="post" class="form" action="viewCourseSectionStudentListDetails.php">
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
                coursesection.seatsAvailable,
                semester.season,
                semester.semesterYear
                FROM coursesection
                LEFT JOIN course ON coursesection.courseID = course.courseID
                LEFT JOIN timeslotday ON coursesection.timeslotID = timeslotday.timeslotID
                LEFT JOIN timeslotperiod ON coursesection.timeslotID = timeslotperiod.timeslotID
                LEFT JOIN Period ON Period.periodNumber = timeslotperiod.periodNumber
                LEFT JOIN Semester ON coursesection.semesterID = semester.semesterID
                WHERE coursesection.facultyID = $userID
                GROUP BY coursesection.CRN
                ORDER BY semester.startDate DESC";

        
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo "    <b>Something went wrong</b> $userID";
        }
//CourseID, Course Name, CRN, dayOfTheWeek, Start time, endTime, start date ,seats left, seats taken
        echo "
        <table>
        <thead>
        <tr>
        <th>Course</th>  
        <th>CRN</th>  
        <th>Days</th>  
        <th>Time</th>   
        <th>Start Date</th>   
        <th>Seats Available</th>
        <th>Semester</th>
        <th>Select</th>
        </tr>
        </thead>
        <tbody>  
        ";
        
        while ($row = $result->fetch_row()) {
            if($row[3] == "Monday"){
                $row[3] = "MW";
            }
            else if($row[3] == "Tuesday"){
                $row[3] = "TT";
            }
            else{
                $row[3] = "F";
            }

            echo "
            <tr>
            ";
            echo "<td>$row[0] - $row[1]</td>";
            $CRNString = "'" . $row[2] . "'";
            echo "<td>$row[2]</td>";
            echo "<td>$row[3]</td>";
            echo "<td>$row[4] - $row[5]</td>";
            echo "<td>$row[6]</td>";
            echo "<td>$row[7]</td>";
            echo "<td>$row[8] $row[9]</td>";
            echo "<td width='11%' class='pldefault'>
                    <input type='radio' name='CRN' value='$row[2]' id='CRN' required>
                </td>";
            echo "
            </tr>
            ";
          } 
        
        echo "
        </table>
        </tbody>
        ";
        ?>
        <p><input type="submit" value="Submit" onclick="confAddClassSubmit(this.form)">
        </form>
        
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>