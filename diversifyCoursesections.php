<html>
<head>
<?php 
    
    include 'global.php';
    set_time_limit(0);
?>
</head>
<?php

$semesterID = 1;

$conn = connectToDB();
$sql = "SELECT * from departmentfaculty where 
facultyID not in (select facultyID from coursesection where semesterID = $semesterID)";



$result = mysqli_query($conn, $sql);


while($row = $result->fetch_row()){

    $departmentID = $row[0];
    $facultyID = $row[1];

    $sql2 = "SELECT CRN from coursesection 
    LEFT JOIN course on course.courseID = coursesection.courseID 
    LEFT JOIN departmentfaculty on departmentfaculty.facultyID = coursesection.facultyID 
    where course.departmentID = $departmentID && semesterID = $semesterID
    group by coursesection.facultyID HAVING COUNT(coursesection.facultyID)>1";

    $result2 = mysqli_query($conn, $sql2);
    $row2 = $result2->fetch_row();
    $CRN = $row2[0];
    $sql3 = "UPDATE Coursesection SET facultyID = $facultyID WHERE CRN = $CRN";
    
    $result3 = mysqli_query($conn, $sql3);


}
echo "Done";





?>

<body>

</body>
</html>
