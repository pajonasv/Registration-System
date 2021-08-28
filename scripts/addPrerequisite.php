<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Admin"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">

<head>
<title>
    Add Prerequisite
 </title>
</head>

<body>
<?php 


$conn = connectToDB();
    $courseID = "'" . $_POST['courseID'] . "'";
    $prereqID = "'" . $_POST['prereqID'] . "'";
    $gradeReq = "'" . $_POST['gradeRequirement'] . "'";
    $creditReq = $_POST['creditRequirement'];
    
    $date = date("Y-m-d");

    //make sure courses exist
    $sql = "SELECT * FROM course where courseID = $courseID";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Something went wrong";
        die();
    }
    if($result->num_rows == 0){
        echo "Course Does not exist";
        die();
    }
    $sql = "SELECT * FROM course where courseID = $prereqID";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Something went wrong";
        die();
    }
    if($result->num_rows == 0){
        echo "Prereq does not exist";
        die();
    }

    //make sure prereq does not already exist
    $sql = "SELECT * FROM prerequisite where courseID = $courseID && prerequisiteCourseID = $prereqID";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Something went wrong";
        die();
    }
    if($result->num_rows > 0){
        echo "$prereqID is already a prerequisite for $courseID";
        die();
    }

    //make sure inverse is not true
    $sql = "SELECT * FROM prerequisite where courseID = $prereqID && prerequisiteCourseID = $courseID";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Something went wrong";
        die();
    }
    if($result->num_rows > 0){
        echo "$courseID is a prerequisite for $prereqID. Both cannot be prerequisites of each other.";
        die();
    }

    
    if(substr($courseID, 0, 2) == substr($prereqID, 0, 2)){

        $courseIDsub = substr($courseID, 3,4);
        $prereqIDsub = substr($prereqID, 3,4);


        $courseIDValue = (int)$courseIDsub;
        $prereqIDValue = (int)$prereqIDsub;


        if($courseIDValue < $prereqIDValue){
            echo "ERROR: $prereqID is greater than $courseID";
            die();
        }
    }


    $sql = "INSERT INTO prerequisite VALUES ($courseID, $prereqID, $gradeReq, '$date', $creditReq)";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Something went wrong with insert into prerequisite";
        die();
    }

    echo "Prerequisite added";

    
?>
<form action= "../Admin/adminHomepage.php" method="post" id="redirectForm">
<p><button type="submit">Okay</button>

</form>


</body>
</html>