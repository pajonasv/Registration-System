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
Update Section
</title>
</head>

<body>
<?php 
    $CRN = $_POST['CRN'];//MAKE SURE TO GET THE CRN
    $facultyID = $_POST['facultyID'];
    $roomID = $_POST['RoomID'];
    $semester = $_POST['Semester'];
    $day = $_POST['select_day'];
    $timeslotID = $_POST['period']-1;

    $totalSeats = $_POST['totalSeats'];

    $startDate = "";
    $endDate = "";

    if(strcmp($semester,"Spring 2021") == 0){
        
        if($day == "mw"){
            $startDate = "'2021-01-25'";
            $endDate = "'2021-05-05'";

        }
        else if($day == "tt"){
            $timeslotID = "1".$timeslotID;
            $startDate = "'2021-01-26'";
            $endDate = "'2021-05-06'";

        }
        else if($day == "f"){
            $timeslotID = "2".$timeslotID;
            $startDate = "'2021-01-29'";
            $endDate = "'2021-05-07'";

        }

    }
    else{
        if($day == "mw"){
            $startDate = "'2021-09-06'";
            $endDate = "'2021-12-15'";

        }
        else if($day == "tt"){
            $timeslotID = "1".$timeslotID;
            $startDate = "'2021-09-07'";
            $endDate = "'2021-12-16'";

        }
        else if($day == "f"){
            $timeslotID = "2".$timeslotID;
            $startDate = "'2021-09-10'";
            $endDate = "'2021-12-17'";

        }
    }



    $conn = connectToDB();

    //make sure room exists
    $sql = "SELECT * FROM Room WHERE roomID = $roomID";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
        echo "Room ". "$roomID does not exist";
        die();
    }
    //make sure room is not office
    $sql = "SELECT * FROM OfficeRoom WHERE roomID = $roomID";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        echo "Room ". "$roomID is an office room";
        die();
    }


    //make sure faculty exists
    $sql = "SELECT * FROM faculty WHERE userID = $facultyID";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
        echo "Faculty ". "$facultyID does not exist";
        die();
    }

    //make sure seatsLeft is less than equal to seats seats
    $sql = "SELECT seatsAvailable, seatsTaken FROM coursesection WHERE CRN = $CRN";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $seatsTaken = $row[1];
    if($totalSeats < $seatsTaken){
        echo "Total seats cannot be lower than the seats already taken.";
        die();
    }
    else{
        $seatsAvailable = $totalSeats - $seatsTaken;
    }


    //make sure not going over course load if different prof
    $sql = "SELECT * FROM coursesection
     WHERE CRN = $CRN && facultyID = $facultyID";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
        $sql = "SELECT facultyType FROM faculty WHERE userID = $facultyID";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        if($row[0] == "Full time"){
            $sql ="SELECT courseLoad from fulltimefaculty LIMIT 1";
        }
        else{
            $sql ="SELECT courseLoad from parttimefaculty LIMIT 1";
        }
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $courseLoad = $row[0];

        $sql = "SELECT COUNT(CourseSection.CRN)
        FROM Faculty
        LEFT JOIN CourseSection ON CourseSection.facultyID = Faculty.userID
        WHERE facultyID = $facultyID";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $currentCourseAmount = $row[0];
        if($currentCourseAmount + 1 > $courseLoad){
            echo "Course Overload";
            die();
        }

    }

    

    //make sure no room and time conflict MAKE SURE TO ADD AN EXCEPTION FOR THE CRN BEING CHANGED
    $sql = "SELECT * FROM coursesection WHERE roomID = $roomID && timeslotID = $timeslotID && startDate = $startDate && CRN != $CRN";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        echo "Room-Time conflict";
        die();
    }
    //make sure prof is free that time MAKE SURE TO ADD AN EXCEPTION FOR THE CRN BEING CHANGED
    $sql = "SELECT * FROM coursesection WHERE facultyID = $facultyID && timeslotID = $timeslotID && startDate = $startDate && CRN != $CRN";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        echo "Faculty-Time conflict";
        die();
    }

    //actually updating the thing
    $sql = "UPDATE coursesection SET
    facultyID = $facultyID,
    roomID = $roomID,
    startDate = $startDate,
    endDate = $endDate,
    timeslotID = $timeslotID,
    totalSeats = $totalSeats,
    seatsAvailable = $seatsAvailable

    WHERE CRN=$CRN";
    $result = mysqli_query($conn, $sql);

    //make sure to change the courseLoad if the course is this semester 
    
    echo "updated " . $CRN;
    
?>
<form action= "../Admin/updateCourseSectionSelectSection.php" method="post" id="redirectForm">
<p><button type="submit">Okay</button>

<?php
    $sql = "SELECT courseID
    FROM coursesection
    WHERE CRN=$CRN";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    echo "<input type = 'hidden' name = 'CourseID' value = $row[0] />"
    
?>
</form>


</body>
</html>