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
        <title>Edit Grad Program For Student</title>
    </head>
    <body>
        <?php
            if($_COOKIE['userType'] == "Student"){

                $studentID = $_COOKIE['userID'];
            }
            else{
                $studentID = $_POST['userID'];
            }

            $gradProgram = $_POST['gradProgram'];
            
            $conn = connectToDB();

            if($gradProgram == "Mathematics, PhD" || $gradProgram == "M.S. in Data Science" || $gradProgram == "Adolescence Education: Mathematics (7-12), M.A.T."){
                $bachelorsToCheck = "Mathematics BS";
            }
            else if($gradProgram == "Biomedical Sciences, PhD" || $gradProgram == "Adolescence Education: Biology (7-12), M.A.T."){
                $bachelorsToCheck = "Biological Sciences BS";
            }
            else if($gradProgram == "Adolescence Education: English Language Arts (7-12), M.A.T."){
                $bachelorsToCheck = "English BA";
            }
            else if($gradProgram == "Mental Health Counseling, M.S."){
                $bachelorsToCheck = "Psychology BA";
            }

            $sql = "SELECT * FROM gradStudent WHERE userID = $studentID && bachelorsDegree = '$bachelorsToCheck'";
            $result = mysqli_query($conn, $sql);

            if($result->num_rows == 0){
                echo "Student does not meet the Major Requirement<br>";
                die();
            }

            $sql = "UPDATE gradStudent SET gradProgram='$gradProgram' WHERE userID = $studentID";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "Something went wrong with update gradstudent<br>";
                echo $sql;
                die();
            }

            echo "Graduate Program Updated";
            
        ?>
    </body>
</html>