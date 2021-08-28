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
        <title>Delete Hold for Student</title>
    </head>
    <body>
        <?php
            $studentID = $_POST['StudentID'];
            $holdID = $_POST['select_hold_type'];
            
            $conn = connectToDB();

            if($holdID == 1)
                $holdType = "Financial";
            if($holdID == 2)
                $holdType = "Disciplinary";

            //check if the student ID provided exists:
            $sql = "SELECT * FROM Student WHERE Student.userID = $studentID";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Student $studentID does not exist";
                die();
            }

            //check if the hold ID provided exists:
            $sql = "SELECT * FROM Hold WHERE Hold.holdID = $holdID";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Hold $holdID does not exist";
                die();
             }

            //check if the student has holds:
            $sql = "SELECT * FROM holdstudent WHERE holdstudent.studentID = $studentID AND holdstudent.holdID = $holdID";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows ==0){
                echo "Student $studentID does not have a $holdType hold";
                die();
            }

            //removing the hold to the provided student:
            $sql = "DELETE FROM holdstudent WHERE holdstudent.holdID = $holdID AND holdstudent.studentID = $studentID";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "Could not delete hold $holdID from student $studentID.";
            }
            else{
                echo "Hold $holdID deleted for student $studentID";
            }
            die();
        ?>
    </body>
</html>