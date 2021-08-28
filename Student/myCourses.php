<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Student"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>My Courses</title>
        <style>
            table,tr,th,td{
                border:3px solid black;
                background-color:orange;
                color:black;
            }
        </style>
    </head>
    <body>
        <?php
            $userID = $_COOKIE['userID'];

            $conn = connectToDB();

            $sql = "SELECT Course.CourseID, 
            Course.coursename, 
            Coursesection.CRN,
            Day.dayoftheweek,
            Period.startTime,
            Period.endTime,
            User.FName,
            User.LName,
            Enrollment.grade,
            Course.credits
            FROM enrollment
            LEFT JOIN coursesection ON coursesection.CRN = Enrollment.CRN
            LEFT JOIN timeslotday ON timeslotday.timeslotID = coursesection.timeslotID
            LEFT JOIN day on timeslotday.dayoftheweek = day.dayoftheweek
            LEFT JOIN timeslotperiod ON timeslotperiod.timeslotID = coursesection.timeslotID
            LEFT JOIN period ON timeslotperiod.periodNumber = period.periodNumber 
            LEFT JOIN course ON course.CourseID = coursesection.CourseID
            LEFT JOIN user ON user.userID = coursesection.facultyID
            WHERE coursesection.semesterID = 0 && enrollment.studentID = $userID
            GROUP BY CRN";

            echo "
                <h1>Spring 2021</h1>
                <table>
                <thead>
                <tr>
                    <th>Course</th>
                    <th>CRN</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Professor</th>
                    <th>Grade</th>
                    <th>Credits</th>
                </tr>
                </thead>
                <tbody>
                ";
                $result = mysqli_query($conn, $sql);
                while ($row = $result->fetch_row()) {
                    echo "<tr>";
                    echo "<td>$row[0] - $row[1]</td>";
                    echo "<td>$row[2]</td>";
                    if($row[3] == "Monday"){$row[3] = "MW";}
                    else if($row[3] == "Tuesday"){$row[3] = "TT";}
                    else{
                        $row[3] = "F";
                    }
                    echo "<td>$row[3]</td>";
                    echo "<td>$row[4] - $row[5]</td>";
                    echo "<td>$row[6] $row[7]</td>";
                    if($row[8] == ""){$row[8] = "-";}
                    echo "<td>$row[8]</td>";
                    echo "<td>$row[9]</td>";
                    echo "</tr>";
                } 
                echo "
                </tbody>
                </table>
                ";

                
            $sql = "SELECT Course.CourseID, 
            Course.coursename, 
            Coursesection.CRN,
            Day.dayoftheweek,
            Period.startTime,
            Period.endTime,
            User.FName,
            User.LName,
            Course.credits
            FROM enrollment
            LEFT JOIN coursesection ON coursesection.CRN = Enrollment.CRN
            LEFT JOIN timeslotday ON timeslotday.timeslotID = coursesection.timeslotID
            LEFT JOIN day on timeslotday.dayoftheweek = day.dayoftheweek
            LEFT JOIN timeslotperiod ON timeslotperiod.timeslotID = coursesection.timeslotID
            LEFT JOIN period ON timeslotperiod.periodNumber = period.periodNumber 
            LEFT JOIN course ON course.CourseID = coursesection.CourseID
            LEFT JOIN user ON user.userID = coursesection.facultyID
            WHERE coursesection.semesterID = 1 && enrollment.studentID = $userID
            GROUP BY CRN";

                echo "
                <h1>Fall 2021</h1>
                <table>
                <thead>
                <tr>
                    <th>Course</th>
                    <th>CRN</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Professor</th>
                    <th>Credits</th>
                </tr>
                </thead>
                <tbody>
                ";
                $result = mysqli_query($conn, $sql);
                while ($row = $result->fetch_row()) {
                    echo "<tr>";
                    echo "<td>$row[0] - $row[1]</td>";
                    echo "<td>$row[2]</td>";
                    if($row[3] == "Monday"){$row[3] = "MW";}
                    else if($row[3] == "Tuesday"){$row[3] = "TT";}
                    else{
                        $row[3] = "F";
                    }
                    echo "<td>$row[3]</td>";
                    echo "<td>$row[4] - $row[5]</td>";
                    echo "<td>$row[6] $row[7]</td>";
                    echo "<td>$row[8]</td>";
                    echo "</tr>";
                } 
                echo "
                </tbody>
                </table>
                ";
            die();
        ?>

    </body>
</html>