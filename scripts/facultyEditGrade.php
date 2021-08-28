<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user'])){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>Edit Course Grade For Student</title>
    </head>
    <body>
        <?php
            $studentID = $_POST['StudentID'];
            $CRN = $_POST['CRN'];
            $courseGrade = $_POST['CourseGrade'];
            
            $faculyID = $_COOKIE['userID'];
            $userType = $_COOKIE['userType'];
            $date = date("Y-m-d");
            $conn = connectToDB();

            //check if the student ID provided exists:
            $sql = "SELECT * FROM Student WHERE Student.userID = $studentID";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Student $studentID does NOT exist.";
                die();
            }

            //check if the CRN exists:
            $sql = "SELECT * FROM Coursesection WHERE CRN = $CRN";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Section with CRN $CRN does NOT exist.";
                die();
            }

            //check if student is taking class with CRN provided:
            $sql = "SELECT * FROM Enrollment WHERE Enrollment.studentID = $studentID AND Enrollment.CRN = $CRN";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows ==0){
                echo "Student $studentID is NOT currently registered to class with CRN $CRN.";
                die();
            }

            if($userType == "Faculty"){

                //check if the faculty is teaching the class with CRN provided:
                $sql = "SELECT * FROM Coursesection WHERE facultyID = $faculyID AND CRN = $CRN";
                $result = mysqli_query($conn, $sql);
                if($result->num_rows ==0){
                    echo "You cannot change provided student's grade since you do NOT teach the class with CRN $CRN.";
                    die();
                }

                //check if the update grade window is open:
                $sql = "SELECT Semester.gradeSubmissionWindowStart, Semester.gradeSubmissionWindowEnd FROM Semester
                        INNER JOIN Coursesection ON Semester.semesterID = Coursesection.semesterID
                        WHERE Coursesection.CRN = $CRN";
                $result = mysqli_query($conn, $sql);
                $row = $result->fetch_row();
                $windowStart = $row[0];
                $windowEnd = $row[1];
                
                if(time() < strtotime($windowStart) || time() >= strtotime($windowEnd)){
                    echo "Could not update Grade of student $studentID because the update grade window is not open yet or has ended. Window Start
                            Date is: $windowStart and Window End Date is: $windowEnd. Today's date is: $date.";
                    die();
                }
            }
            //if user is admin, check if the section is in fall 2021, if so, cannot change grade:
            if($userType == "Admin"){
                $sql = "SELECT enrollDate FROM Enrollment WHERE studentID = $studentID AND CRN = $CRN";
                $result = mysqli_query($conn, $sql);
                $row = $result->fetch_row();
                if($row[0] > $date){
                    echo "Cannot change grade for student: $studentID for class with CRN: $CRN because the class has not yet started. 
                    <br></br>
                    The class starts on $row[0], today's date is: $date";
                    die();
                }
            }
            //see if wether grade is null
            $sql = "SELECT grade
                    FROM Enrollment
                    WHERE Enrollment.studentID = $studentID AND Enrollment.CRN = $CRN";
            $result = mysqli_query($conn, $sql);
            $row = $result->fetch_row();
            
            $isNull = false;
            if($row[0] == ""){
                $isNull = true;
            }


            //Update the course grade of provided student:
            $sql = "UPDATE Enrollment
                    SET grade = '$courseGrade'
                    WHERE Enrollment.studentID = $studentID AND Enrollment.CRN = $CRN";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "Could Not set the grade $courseGrade for Student $studentID for class with CRN $CRN.";
            }
            else{
                echo "Updated course grade of student $studentID to $courseGrade for class with CRN $CRN successfully!";
            }


            //update credit amount
            if($courseGrade != "F" && $courseGrade != "D" && $isNull == true){
            $sql = "SELECT course.credits FROM coursesection
                    LEFT JOIN course ON course.courseID = coursesection.courseID
                    WHERE coursesection.CRN = $CRN";
            $result = mysqli_query($conn, $sql);
            $row = $result->fetch_row();

            $sql = "UPDATE Student
                    SET numOfCredits = numOfCredits + " . $row[0] . "
                    WHERE userID = $studentID";
            $result = mysqli_query($conn, $sql);

            }
            setGPA($conn, $studentID);
            die();
        ?>
    </body>
</html>