
<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Admin"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<head>

<meta charset="utf-8">
<link rel="stylesheet" href="admin.css">
<script type="text/javascript">
            function sendRedirectForm(value){
                

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"courseID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"listCourses\" />";

                submissionFrom.submit();
            }

           

                  
        </script>
</head>
<body>

<h1>Results</h1>


<form method="post" id="redirectForm" action="../displays/displayCourse.php">
<?php 

$departmentWhere = "Course.departmentID != -1";
    if($_POST['department'] != '-1'){
    $departmentWhere = "Course.departmentID = " . $_POST['department'];
    }
    
    $courseIDWhere = "Course.courseID != ''";
       if($_POST['courseID'] != ''){
        $courseIDWhere = "Course.courseID = '". $_POST['courseID'] . "'";
    }
    
    $courseNameWhere = "Course.courseName != ''";
    if($_POST['courseName'] != ''){
        $courseNameWhere = "Course.courseName LIKE '%". $_POST['courseName'] . "%'";
    }
    
    $courseType = $_POST['courseType'];

    $inClause = "Course.courseID != ''";
    if($courseType == "undergraduate"){
        $inClause = "Course.courseID IN (SELECT undergradcourse.courseID FROM undergradcourse)";

    }
    else if($courseType == "graduate"){
        $inClause = "courseID IN (SELECT courseID FROM gradcourse)";

    }
    

    $conn = connectToDB();
    
    $sql = "SELECT 
    Course.CourseID,
    Course.courseName,
    Department.departmentName
    FROM Course
    LEFT JOIN Department ON Course.departmentID = Department.departmentID
    WHERE $departmentWhere && $courseIDWhere && $courseNameWhere && $inClause
    ORDER BY Course.DepartmentID";
    
    

    echo "
<table>
<thead>
<tr>
    <th>Course ID</th>
    <th>Course Name</th>
    <th>Department Name</th>
            
</tr>
</thead>
<tbody>  
";
$result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_row()) {
        echo "<tr>";
        $courseIDString = "\"$row[0]\"";
        echo "<td><div class='phpHyperText' onclick='sendRedirectForm($courseIDString)'>$row[0]</td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "</tr>";
      } 
      echo "
      </tbody>
      </table>
      ";
    
?>
    </form>
</body>
</html>