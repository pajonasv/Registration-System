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
        <title>Edit Minor For Student</title>
    </head>
    <body>
        <?php
            if($_COOKIE['userType'] == "Student"){

                $studentID = $_COOKIE['userID'];
            }
            else{
                $studentID = $_POST['userID'];
            }

            $minorID = $_POST['minorID'];

            $date = "'" . date("Y-m-d") . "'";
            
            $conn = connectToDB();

            $sql = "SELECT * FROM undergradStudent WHERE userID = $studentID";
            $result = mysqli_query($conn, $sql);

            if($result->num_rows == 0){
                echo "Student either does not exist or is not an undergraduate";
                die();
            }


            $sql = "DELETE FROM undergradstudentminor WHERE undergradstudentID = $studentID";
            $result = mysqli_query($conn, $sql);
            if(!$result){

                echo "Something went wrong with delete from undergradstudentminor";
                die();
            }

            if($minorID != -1){
                $sql = "INSERT INTO undergradstudentminor VALUES($studentID, $minorID, $date)";
                $result = mysqli_query($conn, $sql);
                if(!$result){

                    echo "Something went wrong with Insert minor";
                    die();
                }
            }
            
            echo "Minors updated";
            
        ?>
    </body>
</html>