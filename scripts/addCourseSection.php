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
<title>addSection</title>
</head>

<body>
<?php 
    
    $courseID = "'" . $_POST['CourseID'] . "'";
    $facultyID = $_POST['FacultyID'];
    $roomID = $_POST['RoomID'];
    $semester = 1;
    $day = $_POST['select_day'];
    $timeslotID = $_POST['period'] - 1;

    $totalSeats = $_POST['totalSeats'];

    $startDate = "";
    $endDate = "";

    /*if($semester == 0){
        
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
    else if ($semester == 1){*/
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
    /*}
    else if($semester == 99){
        
        if($day == "mw"){
            $startDate = "'2020-01-26'";
            $endDate = "'2020-05-06'";

        }
        else if($day == "tt"){
            $timeslotID = "1".$timeslotID;
            $startDate = "'2020-01-27'";
            $endDate = "'2020-05-07'";

        }
        else if($day == "f"){
            $timeslotID = "2".$timeslotID;
            $startDate = "'2020-01-30'";
            $endDate = "'2020-05-08'";

        }

    }
    else if ($semester == 98){
        if($day == "mw"){
            $startDate = "'2020-09-07'";
            $endDate = "'2020-12-16'";

        }
        else if($day == "tt"){
            $timeslotID = "1".$timeslotID;
            $startDate = "'2020-09-08'";
            $endDate = "'2020-12-17'";

        }
        else if($day == "f"){
            $timeslotID = "2".$timeslotID;
            $startDate = "'2020-09-11'";
            $endDate = "'2020-12-18'";

        }
    }
    else if($semester == 97){
        
        if($day == "mw"){
            $startDate = "'2019-01-27'";
            $endDate = "'2019-05-08'";

        }
        else if($day == "tt"){
            $timeslotID = "1".$timeslotID;
            $startDate = "'2019-01-28'";
            $endDate = "'2019-05-09'";

        }
        else if($day == "f"){
            $timeslotID = "2".$timeslotID;
            $startDate = "'2019-01-31'";
            $endDate = "'2019-05-10'";

        }

    }
    else if ($semester == 96){
        if($day == "mw"){
            $startDate = "'2019-09-09'";
            $endDate = "'2019-12-18'";

        }
        else if($day == "tt"){
            $timeslotID = "1".$timeslotID;
            $startDate = "'2019-09-10'";
            $endDate = "'2019-12-19'";

        }
        else if($day == "f"){
            $timeslotID = "2".$timeslotID;
            $startDate = "'2019-09-13'";
            $endDate = "'2019-12-20'";

        }
    }
    else if($semester == 95){
        
        if($day == "mw"){
            $startDate = "'2018-01-28'";
            $endDate = "'2018-05-09'";

        }
        else if($day == "tt"){
            $timeslotID = "1".$timeslotID;
            $startDate = "'2018-01-29'";
            $endDate = "'2018-05-10'";

        }
        else if($day == "f"){
            $timeslotID = "2".$timeslotID;
            $startDate = "'2018-02-01'";
            $endDate = "'2018-05-11'";

        }

    }
    else if ($semester == 94){
        if($day == "mw"){
            $startDate = "'2018-09-10'";
            $endDate = "'2018-12-19'";

        }
        else if($day == "tt"){
            $timeslotID = "1".$timeslotID;
            $startDate = "'2018-09-11'";
            $endDate = "'2018-12-20'";

        }
        else if($day == "f"){
            $timeslotID = "2".$timeslotID;
            $startDate = "'2018-09-14'";
            $endDate = "'2018-12-21'";

        }
    }
    else if($semester == 93){
        
        if($day == "mw"){
            $startDate = "'2017-01-29'";
            $endDate = "'2017-05-10'";

        }
        else if($day == "tt"){
            $timeslotID = "1".$timeslotID;
            $startDate = "'2017-01-30'";
            $endDate = "'2017-05-11'";

        }
        else if($day == "f"){
            $timeslotID = "2".$timeslotID;
            $startDate = "'2017-02-02'";
            $endDate = "'2017-05-12'";

        }

    }
    else if ($semester == 92){
        if($day == "mw"){
            $startDate = "'2017-09-11'";
            $endDate = "'2017-12-20'";

        }
        else if($day == "tt"){
            $timeslotID = "1".$timeslotID;
            $startDate = "'2017-09-12'";
            $endDate = "'2017-12-21'";

        }
        else if($day == "f"){
            $timeslotID = "2".$timeslotID;
            $startDate = "'2017-09-15'";
            $endDate = "'2017-12-22'";

        }
    }*/



    $conn = connectToDB();

    //find departmentID
    $sql = "SELECT departmentID FROM course WHERE courseID = $courseID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $depIDplusOne = $row[0] +1;
    $depID = $row[0];
    if (substr($courseID,1, 2) == "CS"){
        $depIDplusOne = $row[0];
    }

    //make sure course exists
    $sql = "SELECT * from course WHERE courseID = $courseID";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
        echo "Course does not exist";
        die();
    }
    

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

    //make sure timeslot exists (technically unnnessecary but i wrote the code already so whoop)
    $sql = "SELECT * FROM timeslot WHERE timeslotID = $timeslotID";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
        echo "Timeslot ". "$timeslotID does not exist";
        die();
    }

    //make sure faculty exists
    $sql = "SELECT * FROM faculty WHERE userID = $facultyID";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
        echo "Faculty ". "$facultyID does not exist";
        die();
    }
    //make sure faculty is in right department
    $sql = "SELECT * FROM departmentfaculty WHERE facultyID = $facultyID && departmentID = $depID";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
        echo "Faculty ". "$facultyID does not belong to department $depID !!";
        die();
    }
    //make sure not going over course load
    $sql = "SELECT facultyType FROM faculty WHERE userID = $facultyID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    if($row[0] == "Full Time"){
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
    WHERE courseSection.facultyID = $facultyID
    && CourseSection.semesterID = $semester";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $currentCourseAmount = $row[0];
    if($currentCourseAmount + 1 > $courseLoad){
        echo "Course Overload: Course Amount is $currentCourseAmount and courseLoad is $courseLoad";
        die();
    }

    //make sure no room and time conflict
    $sql = "SELECT * FROM coursesection WHERE roomID = $roomID && timeslotID = $timeslotID && startDate = $startDate";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        echo "Room-Time conflict";
        die();
    }
    //make sure prof is free that time
    $sql = "SELECT * FROM coursesection WHERE facultyID = $facultyID && timeslotID = $timeslotID && startDate = $startDate";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        echo "Faculty-Time conflict";
        die();
    }

    

    //find section number
    $sql = "SELECT coursesection.sectionNumber, course.departmentID FROM coursesection
     LEFT JOIN course ON course.courseID = coursesection.courseID 
     WHERE coursesection.courseID = $courseID && DATEDIFF(coursesection.startDate, $startDate) < 7  && DATEDIFF(coursesection.startDate, $startDate) > -7";
    $result = mysqli_query($conn, $sql);
    
    $max = 0;
    while($row = $result->fetch_row()){
        
        if ($max < $row[0]){
            $max = $row[0];
        }
    }
    $max++;
    $sectionNumber = "$max";

    $ordedSemester = ord($semester);
    if($semester > 2){
        $ordedSemester = ord($semester-90);
    }

    //make CRN
    $CRN = "'" .  $depIDplusOne . $ordedSemester . substr($courseID,3, strlen($courseID)-4) . $sectionNumber ."'";
    echo $CRN;
    
    //actually adding the thing
    $sql = "INSERT INTO coursesection VALUES(
        $CRN, 
        $courseID, 
        $facultyID,
        $roomID,
        $timeslotID, 
        $startDate, 
        $endDate, 
        $totalSeats, 
        0, 
        $sectionNumber,
        $semester,
        $totalSeats
        )";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Successfully added section with details: CRN: $CRN, FacultyID: $facultyID, RoomID: $roomID
                timeslotID: $timeslotID, Start Date: $startDate, End Date: $endDate";
        
    
    }
    else{
        echo "it didnt work";
    }

die();

    
?>


</body>
</html>