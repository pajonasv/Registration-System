<html>
<head>
<?php 
    
    include 'global.php';
    set_time_limit(0);
?>
</head>
<?php

function incDate($date, $times){
        $date->modify('+'. $times . 'days');
    return $date;
}
function getPresence(){
    $randomNum = rand(1,100);
    if($randomNum > 97){
        return "Absent";
    }
    else if($randomNum > 93){
        return "Late";
    }
    return "Present";
}

$conn = connectToDB();
$sql = "select enrollment.studentID, enrollment.CRN from enrollment
LEFT JOIN coursesection ON coursesection.CRN = enrollment.CRN
where coursesection.semesterID = 0 && (enrollment.studentID, enrollment.CRN) NOT IN 
(SELECT attendance.studentID, attendance.CRN FROM attendance
LEFT JOIN coursesection ON coursesection.CRN = attendance.CRN
WHERE coursesection.semesterID = 0)
";

$result = mysqli_query($conn, $sql);


while($row = $result->fetch_row()){


    $studentID = $row[0];
    $CRN = $row[1];


    $subSql = "SELECT coursesection.startDate, timeslotday.dayOfTheWeek
        FROM coursesection
        LEFT JOIN timeslotday
        ON timeslotday.timeslotID = coursesection.timeslotID
        WHERE coursesection.CRN = $CRN
        LIMIT 1";
    $subResult = mysqli_query($conn, $subSql);
    $subRow = $subResult->fetch_row();

    $currentDate =new DateTime($subRow[0]);
    $endDate =new DateTime("2021-05-28");
    $isFriday = false;
    if($subRow[1] == "Friday"){
        $isFriday = true;
    }
    $incAmount = 2;

    echo $endDate->format('Y-m-d') ." <br><br>";


    while($currentDate <= $endDate){
        $presence = getPresence();
        $subSubSql = "INSERT INTO attendance VALUES($studentID, $CRN, \"$presence\", \"" . $currentDate->format('Y-m-d') ."\")";
        $subSubResult = mysqli_query($conn, $subSubSql);
        if(!$subSubResult){
            echo "Something went wrong";
            die();
        }


        if($isFriday){
            $currentDate = incDate($currentDate, 7);
        }
        else{
            
            $currentDate = incDate($currentDate, $incAmount);
            if($incAmount == 2){
                $incAmount = 5;
            }
            else{
                $incAmount = 2;
            }
        }
        
        echo $currentDate->format('Y-m-d') ." <br>";
    }

}







?>

<body>

</body>
</html>
