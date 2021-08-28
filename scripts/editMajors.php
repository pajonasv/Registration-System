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
        <title>Edit Majors For Student</title>
    </head>
    <body>
        <?php
            if($_COOKIE['userType'] == "Student"){

                $studentID = $_COOKIE['userID'];
            }
            else{
                $studentID = $_POST['userID'];
            }

            $majorIDA = $_POST['majorA'];
            $majorIDB = $_POST['majorB'];

            $date = "'" . date("Y-m-d") . "'";
            
            $conn = connectToDB();

            $sql = "SELECT * FROM undergradStudent WHERE userID = $studentID";
            $result = mysqli_query($conn, $sql);

            if($result->num_rows == 0){
                echo "Student either does not exist or is not an undergraduate";
                die();
            }


            $sql = "DELETE FROM undergradstudentmajor WHERE undergradstudentID = $studentID";
            $result = mysqli_query($conn, $sql);
            if(!$result){

                echo "Something went wrong with delete from undergradstudentmajor";
                die();
            }

            if($majorIDA != -1){
                $sql = "INSERT INTO undergradstudentmajor VALUES($studentID, $majorIDA, $date)";
                $result = mysqli_query($conn, $sql);
                if(!$result){

                    echo "Something went wrong with Insert major A";
                    die();
                }
            }
            if($majorIDB != -1){
                $sql = "INSERT INTO undergradstudentmajor VALUES($studentID, $majorIDB, $date)";
                $result = mysqli_query($conn, $sql);
                if(!$result){

                    echo "Something went wrong with Insert major B";
                    die();
                }
            }

            echo "Majors updated";
            
        ?>
    </body>
</html>