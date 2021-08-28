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
<title>
    Remove Account
 </title>
</head>

<body>
<?php 
    $userID = $_POST['userID'];

    //getting courseID to resubmit
    $conn = connectToDB();
    $sql = "SELECT userType FROM loginInfo
    WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Something went wrong";
        die();
    }
    if($result->num_rows != 1){
        echo "Non-existant User ID";

        die();
    }
    $row = $result->fetch_row();
    $userType = $row[0];

    if($userType == "Faculty"){

        //make sure not teaching any courses
        $sql = "SELECT CRN FROM coursesection WHERE (semesterID = 0 || semesterID = 1) && facultyID = $userID";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
        echo "Cannot delete faculty who is currently teaching course section";
        die();
        }
    }
    if($userType == "Student"){

        //make sure not in any course sections
        $sql = "SELECT coursesection.CRN FROM Enrollment
        LEFT JOIN Coursesection ON Enrollment.CRN = Coursesection.CRN WHERE (semesterID = 0 || semesterID = 1) && studentID = $userID";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
            echo "Cannot delete student who is currently enrolled in a course";
            die();
        }
    }

     


    $sql = "DELETE FROM logininfo where userID = $userID";

    
    if($result = mysqli_query($conn, $sql)){

        echo "$userID has been removed.";
        //make sure to reduce the courseLoad for the professor if their course is ongoing
    }
    else{
        echo "Could not delete properly, CRN: $CRN";
    }
    
    die();   
?>
<form action= "../Admin/removeCourseSectionWithDetails.php" method="post" id="redirectForm">
<p><button type="submit">Okay</button>
<?php
    echo "<input type = 'hidden' name = 'CourseID' value = $courseID />"
?>
</form>


</body>
</html>