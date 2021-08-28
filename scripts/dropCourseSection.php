<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user'])){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">


<body>
<?php 
    $section =  $_POST['section'];
    $userID = $_COOKIE['userID'];
    $conn = connectToDB();

    //check if exists
    $sql = "SELECT CRN FROM coursesection WHERE CRN = " . $section;
    $result = mysqli_query($conn, $sql);
    if($result->num_rows <= 0){
        echo "Course Section $section does not exist.<br>";
        die();
    }

    $sql = "SELECT CRN FROM enrollment WHERE studentID = $userID && CRN = " . $section;
    $result = mysqli_query($conn, $sql);

    if($result->num_rows <= 0){
        echo "Not taking course $section<br>";
        die();
    }

    //check registration window
    $sql = "SELECT semesterID from coursesection WHERE CRN = $section";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
        echo "Invalid CRN";
        die();
    }
    $row = $result->fetch_row();
    $semesterID = $row[0]; 
    $sql = "SELECT registrationStart, registrationEnd from semester WHERE semesterID = $semesterID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $regStart = $row[0] . " 00:00:00.0";
    $regEnd = $row[1] .  " 00:00:00.0";
    
    if(time() < strtotime($regStart) || time() >  strtotime($regEnd)){
        echo "Registration for this semester has not begun or has ended";
        die();
    }

    $sql = "DELETE FROM enrollment WHERE studentID = ". $userID ." && CRN = " . $section;
    $result = mysqli_query($conn, $sql);

    if($result){
        $sql = "UPDATE coursesection set seatsAvailable = seatsAvailable + 1 WHERE CRN = " . $section;
        $result = mysqli_query($conn, $sql);
        if(!$result){echo "something went wrong with seatsAvailable += 1 <br>";die();}
        $sql = "UPDATE coursesection set seatsTaken = seatsTaken -1 WHERE CRN = " . $section;
        $result = mysqli_query($conn, $sql);
        if(!$result){echo "something went wrong with seatsTaken -= 1 <br>";die();}
    }
    else{
        echo "Something went wrong with delete from enrollment";
        die();
    }


    $sql = "SELECT studentType from Student WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $studentType = $row[0];
    $status = "";
    if ($studentType == "Undergraduate"){
        //get secondary type
        $sql = "SELECT status from undergradstudent WHERE userID = $userID";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $status = $row[0];
        

    }
    else{
        //get secondary type
        $sql = "SELECT status from gradstudent WHERE userID = $userID";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $status = $row[0];
        

    }

    $sql = "SELECT count(enrollment.studentID) FROM enrollment 
            LEFT JOIN coursesection ON enrollment.CRN = coursesection.CRN
            WHERE coursesection.semesterid = 0 && enrollment.studentID = $userID";

    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $currentCredits = $row[0] * 4;


    //set to part time if < 8
    if($studentType == "Undergraduate" && $status == "Full Time" && $currentCredits <= 8){
        
        $sql = "DELETE FROM fulltimeundergradstudent WHERE userID = $userID";
        $result = mysqli_query($conn, $sql);
        
        $sql = "UPDATE undergradstudent SET status = 'Part Time' WHERE userID = $userID";
        $result = mysqli_query($conn, $sql);
        
        $sql = "INSERT INTO parttimeundergradstudent VALUES($userID, 8)";
        $result = mysqli_query($conn, $sql);
    }
    else if($studentType == "Graduate" && $status == "Full Time"  && $currentCredits <= 8){
        $sql = "DELETE FROM fulltimegradstudent WHERE userID = $userID";
        $result = mysqli_query($conn, $sql);

        $sql = "UPDATE gradstudent SET status = 'Part Time' WHERE userID = $userID";
        $result = mysqli_query($conn, $sql);
        
        $sql = "INSERT INTO parttimegradstudent VALUES($userID, 8)";
        $result = mysqli_query($conn, $sql);
    }
    echo "Successfully Dropped section with CRN: $section";
?>

</body>
</html>