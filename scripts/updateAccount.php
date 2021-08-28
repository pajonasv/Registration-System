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
        <title>Update Account</title>
    </head>
    <body>
        <?php
            $userID = $_POST['userID'];
            $FName = $_POST['FName'];
            $MName = $_POST['MName'];
            $LName = $_POST['LName'];
            $gender = $_POST['gender'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zipCode = $_POST['zipCode'];
            $phoneNumber = $_POST['phoneNumber'];
            


            $salary = $_POST['salary'];
            $wages = $_POST['wages'];
            $facultyRank = $_POST['facultyRank'];
            $privilegeLevel = $_POST['privilegeLevel'];
            $startYear = $_POST['startYear'];
            $officeID = $_POST['officeID'];
            
            
            $sql = "SELECT userType FROM user where userID = $userID";
            $conn = connectToDB();
            $result = mysqli_query($conn, $sql);
            $row = $result->fetch_row();

            $userType = $row[0];

            
            $sql = "UPDATE user SET
                FName = \"$FName\",
                MName = \"$MName\",
                LName = \"$LName\",
                gender = \"$gender\",
                street = \"$street\",
                city = \"$city\",
                state = \"$state\",
                zipCode = $zipCode,
                phoneNumber = $phoneNumber
                WHERE userID = $userID";

            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "Something went wrong!!";
                die();
            }

            if($userType == "Student"){
                $sql = "UPDATE student SET
                startYear = '$startYear'
                WHERE userID = $userID";
            }
            else if($userType == "Faculty"){
                //check if office exists
                $sql = "SELECT * FROM officeroom WHERE roomID = $officeID";
                
                $result = mysqli_query($conn, $sql);
                if($result->num_rows == 0){
                    echo "Office room does not exist";
                    die();
                }
                //check if office is free
                $sql = "SELECT * FROM faculty WHERE userID != $userID && officeID = $officeID";
                
                $result = mysqli_query($conn, $sql);
                if($result->num_rows > 0){
                    echo "Office is taken";
                    die();
                }

                $sql = "UPDATE faculty SET
                officeID = $officeID
                WHERE userID = $userID";
                
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    echo "Something went wrong with setting a new office!!";
                    die();
                }
                $sql = "UPDATE faculty SET
                facultyRank = '$facultyRank'
                WHERE userID = $userID";
                
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    echo "Something went wrong with updating faculty rank";
                    die();
                }

                $sql = "UPDATE parttimefaculty SET
                wageAmount = $wages
                WHERE userID = $userID";
                
                $result = mysqli_query($conn, $sql);

                $sql = "UPDATE fulltimefaculty SET
                salary = $salary
                WHERE userID = $userID";
                
                $result = mysqli_query($conn, $sql);
            }
            else if($userType == "Admin"){
                $sql = "UPDATE Admin SET
                salary = $salary,
                privelageLevel = $privilegeLevel
                WHERE userID = $userID";
                
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    echo "Something went wrong with insert into admin";
                    die();
                }
            }
            else if($userType == "Researcher"){
                $sql = "UPDATE Researcher SET
                salary = $salary
                WHERE userID = $userID";
                
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    echo "Something went wrong with insert into Researcher";
                    die();
                }
            }
            else{
                echo "Invalid user type";
                die();
            }
            
            echo "Succesfully updated";

           
            die();
        ?>
    </body>
</html>