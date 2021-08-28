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
        <title>Delete Course</title>
    </head>
    <body>
        <?php
            $courseID = $_POST['courseID'];

            
            $conn = connectToDB();
            $sql = "SELECT courseID FROM course where courseID = '$courseID'";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Course does not exist";
                die();
            }

            //check if it has sections
            $sql = "SELECT * FROM coursesection where courseID = '$courseID'";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows > 0){
                echo "Cannot delete course with sections";
                die();
            }


            //check to see if prerequisite
            $sql = "SELECT * FROM prerequisite where courseID = '$courseID'";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows > 0){
                echo "Cannot delete course that has prerequisites";
                die();
            }


            $sql = "DELETE FROM course WHERE courseID = '$courseID'";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "Something went wrong with delete course";
                die();
            }
            

            echo "Delete successfully";
            die();
        ?>
    </body>
</html>