<html>
<head>
<?php 
    
    include 'global.php';
    set_time_limit(0);
?>
</head>
<?php
$conn = connectToDB();
$sql = "SELECT userID, numOfCredits FROM student";

$superResult = mysqli_query($conn, $sql);


while($superRow = $superResult->fetch_row()){
    $studentID = $superRow[0];
    $numOfCredits = $superRow[1];

    $sql = "SELECT grade From Enrollment WHERE studentID = $studentID && grade IS NOT NULL";
    $result = mysqli_query($conn, $sql);
    $gradePoints = 0;
    while($row = $result->fetch_row()){
        switch($row[0]){
            case "A":
                $gradePoints += 16;
                break;
            case "B":
                
                $gradePoints += 12;
                break;
            case "C":
                
                $gradePoints += 8;
                break;
            case "D":
                
                $gradePoints += 4;
                break;
            case "F":
                break;
            default:
                break;
            
        }
    }
   $GPA = $gradePoints/$numOfCredits;

   $sql = "UPDATE undergradstudent SET GPA = $GPA WHERE userID = $studentID";
   $result = mysqli_query($conn, $sql);
   $sql = "UPDATE gradstudent SET GPA = $GPA WHERE userID = $studentID";
   $result = mysqli_query($conn, $sql);

}



?>

<body>

</body>
</html>
