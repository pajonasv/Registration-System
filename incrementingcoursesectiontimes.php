<html>
<head></head>

<body>

    <?php
    include 'global.php';

    $conn = connectToDB();

    $semester = 92;

    $sql = "SELECT coursesection.*
    FROM undergradCourse
    LEFT JOIN coursesection on undergradcourse.courseID = coursesection.courseID
    LEFT JOIN course on course.courseID = coursesection.courseID
    WHERE coursesection.semesterID = $semester";
    $result = mysqli_query($conn, $sql);



    $timeslotIDOffset = 2;

     
    
    //alter CRN
    while($row = $result->fetch_row()){

        
        $timeslotID = $row[4] + $timeslotIDOffset;
        
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

        if($timeslotID > 6){
                
            $timeslotID = $timeslotID- 7;
        }

        
        echo "plus offset is $timeslotID";
        

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

        
        
        
        

        echo $timeslotID;

        
        $sql2 = "UPDATE coursesection SET timeSlotID = $timeslotID WHERE CRN = " . $row[0];
        $result2 = mysqli_query($conn, $sql2);
    if(!$result2){
        echo "something went wrong with: $sql2 <br></br>";
    }
    else {

        echo "Added <br></br>";
    }

    }

    ?>  

</body>

</html>