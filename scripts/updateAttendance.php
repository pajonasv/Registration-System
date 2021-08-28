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
        <title>Edit Attendance For Student</title>
    </head>
    <body>
        <?php
            $studentID = $_POST['StudentID'];
            $CRN = $_POST['CRN'];
            $sessionDate = $_POST['SessionDate'];
            $presence = $_POST['Presence'];            
            $conn = connectToDB();

            //Update presence for current sessionDate:
            $sql = "UPDATE Attendance
                    SET presence = '$presence'
                    WHERE studentID = $studentID AND CRN = $CRN AND sessionDate = '$sessionDate'";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "Could Not update attendance of Student $studentID to $presence for class with CRN $CRN for session date: $sessionDate.";
            }
            else{
                echo "Updated attendance of student $studentID to $presence for class with CRN $CRN for session date: $sessionDate successfully!";
            }
            die();
        ?>
    </body>
</html>