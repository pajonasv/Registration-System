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
        <title>Remove Faculty Advisor of a Student</title>
    </head>
    <body>
        <?php
            $facultyID = $_POST['FacultyID'];
            $studentID = $_POST['StudentID'];

            $conn = connectToDB();

            //check if faculty ID exits:
            $sql = "SELECT * FROM Faculty WHERE Faculty.userID = $facultyID";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows==0){
                echo "Faculty $facultyID does NOT exist.";
                die();
            }

            //check if student ID exists:
            $sql = "SELECT * FROM Student WHERE Student.userID = $studentID";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows==0){
                echo "Student $studentID does NOT exist.";
                die();
            }

            //remove given faculty as advisor of given student:
            $sql = "DELETE FROM Advises WHERE Advises.studentID = $studentID AND Advises.facultyID = $facultyID";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "Failed to remove faculty $facultyID as advisor of student $studentID.";
                die();
            }
            else{
                echo "Faculty $facultyID was removed as advisor of student $studentID successfully!";
            }
            die();
        ?>
    </body>
</html>