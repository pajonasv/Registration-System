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
    Remove Prerequisite
 </title>
</head>

<body>
<?php 


$conn = connectToDB();
    $courseID = "'" . $_POST['courseID'] . "'";
    $prereqID = "'" . $_POST['prereqID'] . "'";

    echo "$courseID <br>$prereqID <br>";

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

    //make sure prereq already exists
    $sql = "SELECT * FROM prerequisite where courseID = $courseID && prerequisiteCourseID = $prereqID";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Something went wrong";
        die();
    }
    if($result->num_rows == 0){
        echo "$prereqID is not a prerequisite for $courseID";
        die();
    }


    $sql = "DELETE FROM prerequisite where courseID = $courseID && prerequisiteCourseID = $prereqID";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Something went wrong with insert into prerequisite";
        die();
    }

    echo "Prerequisite removed.";

    
?>
<form action= "../Admin/adminHomepage.php" method="post" id="redirectForm">
<p><button type="submit">Okay</button>

</form>


</body>
</html>