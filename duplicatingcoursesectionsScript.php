<html>
<head></head>

<body>

    <?php
    include 'global.php';

    $conn = connectToDB();

    $sql = "SELECT coursesection.*,course.departmentID
    FROM gradCourse
    LEFT JOIN coursesection on gradcourse.courseID = coursesection.courseID
    LEFT JOIN course on course.courseID = coursesection.courseID
    WHERE coursesection.semesterID = 1";
    $result = mysqli_query($conn, $sql);

    if (!$result){
        echo "Something went wrong 1";
    }
    $semester = 0;


    
     
    
    //alter CRN
    while($row = $result->fetch_row()){
        
    $timeslotID = $row[4];
    echo $timeslotID;
        $day = "f";
        if($row[4] < 10){
            $day = "mw";
        }
        else if ($row[4] < 20){
            $day = "tt";
            
            $timeslotID = $timeslotID- 10;
        }
        else{
            
            $timeslotID = $timeslotID- 20;

        }

        if($semester == 0){
        
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
        else if ($semester == 1){
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
        }

        
        
        
        $depIDplusOne = $row[11] +1;
        $depID = $row[11];
        if (substr($row[1],0, 2) == "CS"){
            $depIDplusOne = $row[11];
        }

        $ordedSemester = ord($semester);
        if($semester > 2){
        $ordedSemester = ord($semester-90);
        }

        
        $CRN = "'" .  $depIDplusOne . $ordedSemester . substr($row[1],2, strlen($row[1])) . $row[9] ."'";

        $sql2 = "INSERT INTO coursesection VALUES($CRN ,'$row[1]', $row[2], $row[3], $timeslotID, $startDate, $endDate,
                                                    $row[7], $row[8], $row[9], $semester)";
    $result2 = mysqli_query($conn, $sql2);
    if(!$result2){
        echo "something went wrong with $CRN : $sql2 <br></br>";
    }
    else {

        echo "Added <br></br>";
    }

    }

    ?>  

</body>

</html>