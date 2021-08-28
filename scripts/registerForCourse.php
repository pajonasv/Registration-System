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
Register for Section
 </title>
</head>

<body>
<?php

$conn = connectToDB();
    $CRN = $_POST['CRN'];
    
    $date = "'" . date("Y-m-d") . "'";
    
    $errorMessages = array();
    

    if($_COOKIE['userType'] == "Student"){

        $studentID = $_COOKIE['userID'];
    }
    else{
        $studentID = $_POST['studentID'];
        //make sure student exists
        $sql = "SELECT * FROM student WHERE userID = $studentID";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows == 0){
            array_push($errorMessages, "User $studentID is not a student.");
        }
    }
    

    

    //make sure that Course section exists and get semester
    $sql = "SELECT semesterID from coursesection WHERE CRN = $CRN";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
        array_push($errorMessages, "CRN $CRN does not exist.");
        
    }

    for($x = 0;$x < count($errorMessages); $x++){
        echo $errorMessages[$x] . "<br>";

    }
    if(count($errorMessages) > 0){
        die();
    }

    $row = $result->fetch_row();
    $semesterID = $row[0]; 

    //make sure not already added in
    $sql = "SELECT * FROM Enrollment WHERE studentID = $studentID && CRN = $CRN";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        echo "Error: already registered";
        die();
    }



    //get courseID
    $sql = "SELECT courseID from CourseSection WHERE CRN = $CRN";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $courseID = "'". $row[0] . "'";

    
    

    
    //check registration window
    $sql = "SELECT registrationStart, registrationEnd from semester WHERE semesterID = $semesterID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $regStart = $row[0] . " 00:00:00.0";
    $regEnd = $row[1] .  " 00:00:00.0";
    
    if(time() < strtotime($regStart) || time() >  strtotime($regEnd)){
        
        array_push($errorMessages, "Registration for this semester has not begun or has ended");
    }
    //check seats taken
    $sql = "SELECT seatsAvailable from coursesection WHERE CRN = $CRN";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    if ($row[0] == 0){
        array_push($errorMessages, "All seats have been taken");
    }
    
    //make sure undergrad goes with undergrad, grad goes with grad
    $sql = "SELECT studentType from Student WHERE userID = $studentID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $studentType = $row[0];
    $status = "";
    if ($studentType == "Undergraduate"){
        $sql = "SELECT courseID from undergradCourse WHERE courseID = $courseID";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows == 0){
            array_push($errorMessages,"Error: Graduate course when account is Undergrad");
        }
        //get secondary type
        $sql = "SELECT status from undergradstudent WHERE userID = $studentID";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $status = $row[0];
        

    }
    else if ($studentType == "Graduate"){
        $sql = "SELECT courseID from gradCourse WHERE courseID = $courseID";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows == 0){
            array_push($errorMessages, "Error: Undergraduate course when account is grad");
        }
        //get secondary type
        $sql = "SELECT status from gradstudent WHERE userID = $studentID";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $status = $row[0];
        

    }
    if($status == "graduated"){
        array_push($errorMessages, "Error: Already graduated");
       
    }

    //making it so you cant go over courseLoad
    if($studentType == "Undergraduate"){
        $sql = "SELECT courseLoad
        FROM fulltimeundergradStudent
        LIMIT 1";

        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $courseLoad = $row[0];

    }
    else{
        $sql = "SELECT courseLoad
        FROM fulltimegradStudent
        LIMIT 1";
        
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $courseLoad = $row[0];

    }

    $sql = "SELECT count(enrollment.studentID) FROM enrollment 
            LEFT JOIN coursesection ON enrollment.CRN = coursesection.CRN
            WHERE coursesection.semesterid = $semesterID && enrollment.studentID = $studentID";

    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $currentCredits = ($row[0] * 4) + 4; 
    if($currentCredits > $courseLoad){
        array_push($errorMessages, "Error: Course Overload $currentCredits");
    }
    
    //make sure the student has no holds
    $sql = "SELECT * FROM holdStudent
    WHERE studentID = $studentID";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_row()){
            $sql = "SELECT holdType FROM hold
            WHERE holdID = " . $row[0];
            $subResult = mysqli_query($conn, $sql);
            $subRow = $subResult->fetch_row();

            array_push($errorMessages, "There is a $subRow[0] hold on your account.");
        
        }
    }
    

    //make sure the student hasn't passed the course before

    
    $sql = "SELECT *
    FROM studentHistory
    LEFT JOIN CourseSection ON coursesection.CRN = studentHistory.CRN
    WHERE CourseSection.CourseID = $courseID 
    && studentHistory.studentID = $studentID
    && studentHistory.passOrFail = 'S'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        array_push($errorMessages, "Error: Student has already passed $courseID");
        
    }




    //check prerequisites
    $sql = "SELECT prerequisite.prerequisiteCourseID
    FROM prerequisite
    WHERE prerequisite.courseID = $courseID && prerequisite.prerequisiteCourseID NOT IN(
        SELECT coursesection.courseID
        FROM studenthistory
        LEFT JOIN coursesection ON coursesection.CRN = studenthistory.CRN
        WHERE studenthistory.studentID = $studentID && coursesection.semesterID != $semesterID && coursesection.semesterID != 1
        && studenthistory.passorFail != 'U'
    
    )";
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_row()){
        array_push($errorMessages, "Error Missing prerequisite $row[0]");
    }

    

    //check time conflicts
    $sql = "SELECT timeslotID FROM coursesection WHERE coursesection.CRN = $CRN";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $timeslotID = $row[0];

    $sql = "SELECT coursesection.timeslotid FROM enrollment
    LEFT JOIN coursesection ON coursesection.CRN = enrollment.CRN
    WHERE enrollment.studentID = $studentID && coursesection.semesterID = $semesterID";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_row()){
        if ($row[0] == $timeslotID){
            array_push($errorMessages, "Time conflict");
            
        }
    }

    for($x = 0;$x < count($errorMessages); $x++){
        echo $errorMessages[$x] . "<br>";

    }
    if(count($errorMessages) > 0){
        die();
    }

    //add the thing
    $sql = "INSERT INTO enrollment VALUES($studentID, $CRN, NULL, $date)";
    $result = mysqli_query($conn, $sql);
    if(!$result){

        echo "Could not insert into enrollment";
        die();
    }
    $sql = "INSERT INTO studentHistory VALUES( $CRN, $studentID, NULL)";
    $result = mysqli_query($conn, $sql);
    if(!$result){

        echo "Could not insert into student history";
        die();
    }
    
    //change the student to full time if their course load is equal to full time course load
    if($studentType == "Undergraduate" && $status == "Part Time" && $currentCredits > 8){
        $sql = "DELETE FROM parttimeundergradstudent WHERE userID = $studentID";
        $result = mysqli_query($conn, $sql);
        
        $sql = "UPDATE undergradstudent SET status = 'Full Time' WHERE userID = $studentID";
        $result = mysqli_query($conn, $sql);
        
        $sql = "INSERT INTO fulltimeundergradstudent VALUES($studentID, 16)";
        $result = mysqli_query($conn, $sql);
    }
    else if($studentType == "Graduate" && $status == "Part Time"  && $currentCredits > 8){
        $sql = "DELETE FROM parttimegradstudent WHERE userID = $studentID";
        $result = mysqli_query($conn, $sql);

        $sql = "UPDATE gradstudent SET status = 'Full Time' WHERE userID = $studentID";
        $result = mysqli_query($conn, $sql);
        
        $sql = "INSERT INTO fulltimegradstudent VALUES($studentID, 12)";
        $result = mysqli_query($conn, $sql);
    }


    //increase seats taken, reduce seats available
    $sql = "SELECT seatsAvailable, seatsTaken from coursesection WHERE CRN = $CRN";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $seatsAvailable = $row[0] - 1;
    $seatsTaken = $row[1] - 1;
    $sql = "UPDATE coursesection SET seatsAvailable = $seatsAvailable WHERE CRN = $CRN";
    $result = mysqli_query($conn, $sql);
    $sql = "UPDATE coursesection SET seatsTaken = $seatsTaken WHERE CRN = $CRN";
    $result = mysqli_query($conn, $sql);

    

    echo "Successfully added class with CRN $CRN";
?>
<form action= "../Student/addCourseSection.php" method="post" id="redirectForm">
<p><button type="submit">Okay</button>
</form>


</body>
</html>