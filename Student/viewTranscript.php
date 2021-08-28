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
        <title>View Transcript</title>
        <style>
            table,tr,th,td{
                border:3px solid black;
                background-color:orange;
                color:black;
            }
        </style>
    </head>
    <body>
    <h1>Transcript</h1>
        <?php
            $userID = $_COOKIE['userID'];

            $conn = connectToDB();


            
            $sql = "SELECT numOfCredits FROM student WHERE userID = $userID";

                
            $result = mysqli_query($conn, $sql);
            $row = $result->fetch_row();
            echo "Total Credits: $row[0]";

            $sql = "SELECT  Coursesection.courseID, Course.courseName, Enrollment.CRN, Enrollment.Grade, Enrollment.enrollDate
                    FROM Enrollment
                    INNER JOIN Coursesection ON Coursesection.CRN = Enrollment.CRN
                    INNER JOIN Course ON Course.courseID = Coursesection.courseID
                    INNER JOIN Semester ON Semester.semesterID = Coursesection.semesterID 
                    WHERE Enrollment.studentID = $userID && semester.semesterID = 1
                    ";

                
            $result = mysqli_query($conn, $sql);
            if($result->num_rows > 0){

            echo "
                <h2>Fall 2021</h2>
                <table>
                <thead>
                <tr>
                    
                    <th>Course</th>
                    <th>CRN</th>
                    <th>Grade</th>
                    <th>Enroll Date</th>
                </tr>
                </thead>
                <tbody>
                ";
                while ($row = $result->fetch_row()) {
                    echo "<tr>";
                    
                   echo "<td>$row[0] - $row[1]</td>";
                    echo "<td>$row[2]</td>";
                    echo "<td>$row[3]</td>";
                    echo "<td>$row[4]</td>";
                    echo "</tr>";
                } 
                echo "
                </tbody>
                </table>
                ";
            }
            $sql = "SELECT    Coursesection.courseID, Course.courseName, Enrollment.CRN, Enrollment.Grade, Enrollment.enrollDate
                    FROM Enrollment
                    INNER JOIN Coursesection ON Coursesection.CRN = Enrollment.CRN
                    INNER JOIN Course ON Course.courseID = Coursesection.courseID
                    INNER JOIN Semester ON Semester.semesterID = Coursesection.semesterID 
                    WHERE Enrollment.studentID = $userID && semester.semesterID = 0
                    ";

                
            $result = mysqli_query($conn, $sql);
            if($result->num_rows > 0){

            echo "
                <h2>Spring 2021</h2>
                <table>
                <thead>
                <tr>
                    
                    <th>Course</th>
                    <th>CRN</th>
                    <th>Grade</th>
                    <th>Enroll Date</th>
                </tr>
                </thead>
                <tbody>
                ";
                while ($row = $result->fetch_row()) {
                    echo "<tr>";
                    
                   echo "<td>$row[0] - $row[1]</td>";
                    echo "<td>$row[2]</td>";
                    echo "<td>$row[3]</td>";
                    echo "<td>$row[4]</td>";
                    echo "</tr>";
                } 
                echo "
                </tbody>
                </table>
                ";
            }
            $sql = "SELECT    Coursesection.courseID, Course.courseName, Enrollment.CRN, Enrollment.Grade, Enrollment.enrollDate
                    FROM Enrollment
                    INNER JOIN Coursesection ON Coursesection.CRN = Enrollment.CRN
                    INNER JOIN Course ON Course.courseID = Coursesection.courseID
                    INNER JOIN Semester ON Semester.semesterID = Coursesection.semesterID 
                    WHERE Enrollment.studentID = $userID && semester.semesterID = 98
                    ";

                
            $result = mysqli_query($conn, $sql);
            if($result->num_rows > 0){

            echo "
                <h2>Fall 2020</h2>
                <table>
                <thead>
                <tr>
                    
                <th>Course</th>
                <th>CRN</th>
                <th>Grade</th>
                <th>Enroll Date</th>
            </tr>
            </thead>
            <tbody>
            ";
            while ($row = $result->fetch_row()) {
                echo "<tr>";
                
               echo "<td>$row[0] - $row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td>$row[4]</td>";
                echo "</tr>";
            } 
                echo "
                </tbody>
                </table>
                ";
            }
            $sql = "SELECT    Coursesection.courseID, Course.courseName, Enrollment.CRN, Enrollment.Grade, Enrollment.enrollDate
                    FROM Enrollment
                    INNER JOIN Coursesection ON Coursesection.CRN = Enrollment.CRN
                    INNER JOIN Course ON Course.courseID = Coursesection.courseID
                    INNER JOIN Semester ON Semester.semesterID = Coursesection.semesterID 
                    WHERE Enrollment.studentID = $userID && semester.semesterID = 99
                    ";

                
            $result = mysqli_query($conn, $sql);
            if($result->num_rows > 0){

            echo "
                <h2>Spring 2020</h2>
                <table>
                <thead>
                <tr>
                    
                <th>Course</th>
                <th>CRN</th>
                <th>Grade</th>
                <th>Enroll Date</th>
            </tr>
            </thead>
            <tbody>
            ";
            while ($row = $result->fetch_row()) {
                echo "<tr>";
                
               echo "<td>$row[0] - $row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td>$row[4]</td>";
                echo "</tr>";
            } 
                echo "
                </tbody>
                </table>
                ";
            }
            $sql = "SELECT    Coursesection.courseID, Course.courseName, Enrollment.CRN, Enrollment.Grade, Enrollment.enrollDate
                    FROM Enrollment
                    INNER JOIN Coursesection ON Coursesection.CRN = Enrollment.CRN
                    INNER JOIN Course ON Course.courseID = Coursesection.courseID
                    INNER JOIN Semester ON Semester.semesterID = Coursesection.semesterID 
                    WHERE Enrollment.studentID = $userID && semester.semesterID = 96
                    ";

                
            $result = mysqli_query($conn, $sql);
            if($result->num_rows > 0){

            echo "
                <h2>Fall 2019</h2>
                <table>
                <thead>
                <tr>
                    
                <th>Course</th>
                <th>CRN</th>
                <th>Grade</th>
                <th>Enroll Date</th>
            </tr>
            </thead>
            <tbody>
            ";
            while ($row = $result->fetch_row()) {
                echo "<tr>";
                
               echo "<td>$row[0] - $row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td>$row[4]</td>";
                echo "</tr>";
            } 
                echo "
                </tbody>
                </table>
                ";
            }
            $sql = "SELECT    Coursesection.courseID, Course.courseName, Enrollment.CRN, Enrollment.Grade, Enrollment.enrollDate
                    FROM Enrollment
                    INNER JOIN Coursesection ON Coursesection.CRN = Enrollment.CRN
                    INNER JOIN Course ON Course.courseID = Coursesection.courseID
                    INNER JOIN Semester ON Semester.semesterID = Coursesection.semesterID 
                    WHERE Enrollment.studentID = $userID && semester.semesterID = 97
                    ";

                
            $result = mysqli_query($conn, $sql);
            if($result->num_rows > 0){

            echo "
                <h2>Spring 2019</h2>
                <table>
                <thead>
                <tr>
                    
                <th>Course</th>
                <th>CRN</th>
                <th>Grade</th>
                <th>Enroll Date</th>
            </tr>
            </thead>
            <tbody>
            ";
            while ($row = $result->fetch_row()) {
                echo "<tr>";
                
               echo "<td>$row[0] - $row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td>$row[4]</td>";
                echo "</tr>";
            } 
                echo "
                </tbody>
                </table>
                ";
            }
            $sql = "SELECT    Coursesection.courseID, Course.courseName, Enrollment.CRN, Enrollment.Grade, Enrollment.enrollDate
            FROM Enrollment
            INNER JOIN Coursesection ON Coursesection.CRN = Enrollment.CRN
            INNER JOIN Course ON Course.courseID = Coursesection.courseID
            INNER JOIN Semester ON Semester.semesterID = Coursesection.semesterID 
            WHERE Enrollment.studentID = $userID && semester.semesterID = 94
            ";

        
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){

    echo "
        <h2>Fall 2018</h2>
        <table>
        <thead>
        <tr>
            
        <th>Course</th>
        <th>CRN</th>
        <th>Grade</th>
        <th>Enroll Date</th>
    </tr>
    </thead>
    <tbody>
    ";
    while ($row = $result->fetch_row()) {
        echo "<tr>";
        
       echo "<td>$row[0] - $row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "<td>$row[4]</td>";
        echo "</tr>";
    } 
        echo "
        </tbody>
        </table>
        ";
    }
    $sql = "SELECT    Coursesection.courseID, Course.courseName, Enrollment.CRN, Enrollment.Grade, Enrollment.enrollDate
            FROM Enrollment
            INNER JOIN Coursesection ON Coursesection.CRN = Enrollment.CRN
            INNER JOIN Course ON Course.courseID = Coursesection.courseID
            INNER JOIN Semester ON Semester.semesterID = Coursesection.semesterID 
            WHERE Enrollment.studentID = $userID && semester.semesterID = 95
            ";

        
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){

    echo "
        <h2>Spring 2018</h2>
        <table>
        <thead>
        <tr>
            
        <th>Course</th>
        <th>CRN</th>
        <th>Grade</th>
        <th>Enroll Date</th>
    </tr>
    </thead>
    <tbody>
    ";
    while ($row = $result->fetch_row()) {
        echo "<tr>";
        
       echo "<td>$row[0] - $row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "<td>$row[4]</td>";
        echo "</tr>";
    } 
        echo "
        </tbody>
        </table>
        ";
    }
    $sql = "SELECT    Coursesection.courseID, Course.courseName, Enrollment.CRN, Enrollment.Grade, Enrollment.enrollDate
            FROM Enrollment
            INNER JOIN Coursesection ON Coursesection.CRN = Enrollment.CRN
            INNER JOIN Course ON Course.courseID = Coursesection.courseID
            INNER JOIN Semester ON Semester.semesterID = Coursesection.semesterID 
            WHERE Enrollment.studentID = $userID && semester.semesterID = 92
            ";

        
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){

    echo "
        <h2>Fall 2017</h2>
        <table>
        <thead>
        <tr>
            
        <th>Course</th>
        <th>CRN</th>
        <th>Grade</th>
        <th>Enroll Date</th>
    </tr>
    </thead>
    <tbody>
    ";
    while ($row = $result->fetch_row()) {
        echo "<tr>";
        
       echo "<td>$row[0] - $row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "<td>$row[4]</td>";
        echo "</tr>";
    } 
        echo "
        </tbody>
        </table>
        ";
    }
    $sql = "SELECT    Coursesection.courseID, Course.courseName, Enrollment.CRN, Enrollment.Grade, Enrollment.enrollDate
            FROM Enrollment
            INNER JOIN Coursesection ON Coursesection.CRN = Enrollment.CRN
            INNER JOIN Course ON Course.courseID = Coursesection.courseID
            INNER JOIN Semester ON Semester.semesterID = Coursesection.semesterID 
            WHERE Enrollment.studentID = $userID && semester.semesterID = 93
            ";

        
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){

    echo "
        <h2>Spring 2017</h2>
        <table>
        <thead>
        <tr>
            
        <th>Course</th>
        <th>CRN</th>
        <th>Grade</th>
        <th>Enroll Date</th>
    </tr>
    </thead>
    <tbody>
    ";
    while ($row = $result->fetch_row()) {
        echo "<tr>";
        
       echo "<td>$row[0] - $row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "<td>$row[4]</td>";
        echo "</tr>";
    } 
        echo "
        </tbody>
        </table>
        ";
    }
            
            die();
        ?>

    </body>
</html>