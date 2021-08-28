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
$sql = "SELECT coursesection.facultyID, course.departmentID
        from coursesection
        LEFT JOIN course ON course.courseID = coursesection.courseID";

$result = mysqli_query($conn, $sql);

$count = 0;

while($row = $result->fetch_row()){
    

    $facultyID = $row[0];
    $departmentID = $row[1];

    

    $sql2 = "SELECT * from departmentfaculty where departmentid = $departmentID && facultyID = $facultyID";
    $result2 = mysqli_query($conn, $sql2);
    if($result2->num_rows == 0){
        $count++;
        echo $count . "<br>";
        $sql3 = "INSERT INTO departmentfaculty VALUES ($departmentID, $facultyID, 0.5)";
        
        $result3 = mysqli_query($conn, $sql3);

        
        $sql3 = "UPDATE departmentfaculty SET percentageTime = 0.4 where departmentid != $departmentID && facultyID = $facultyID ";
        
        $result3 = mysqli_query($conn, $sql3);
    }


}
echo "$count Done";





?>

<body>

</body>
</html>
