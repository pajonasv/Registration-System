<!doctype html>
<?php 
    
    include '../../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Admin"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
    
    $facultyType = $_POST['facultyType'];
?>
<html lang="en">
<head>
    <title>User search results</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="searchUsers.css">
        <script type="text/javascript">
  
    function sendRedirectForm(value){
                

                var submissionFrom = document.getElementById("redirectForm"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"userID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
                }
             
</script>
        
    </head>
<body>
<h1>Results</h1>



<form method="post" id="redirectForm" action="../../displays/displayUser.php">
<?php 

    $conn = connectToDB();
    $userType = $_POST['userType'];

    
    $userIDWhere = "User.userID != -1";
    if($_POST['userID'] != ''){
        $userIDWhere = "User.userID = " . $_POST['userID'];
    }
    $FNameWhere = "User.FName != ''";
    if($_POST['FName'] != ''){
        $FNameWhere = "User.FName LIKE '%" . $_POST['FName'] . "%'";
    }
    
    $LNameWhere = "User.LName != ''";
    if($_POST['LName'] != ''){
        $LNameWhere = "User.LName LIKE '%" . $_POST['LName'] . "%'";
    }
    $emailWhere = "LoginInfo.email != ''";
    if($_POST['email'] != ''){
        $emailWhere = "LoginInfo.email = '" . $_POST['email'] . "'";
    }
    $phoneNumWhere = "User.phoneNumber != -1";
        if($_POST['phoneNumber'] != ''){
            
	        $phoneNumberOld = $_POST['phoneNumber'] . "";
            $phoneNumber = substr($phoneNumberOld,0,3) . substr($phoneNumberOld,4,3) . substr($phoneNumberOld,8,4);
            $phoneNumWhere = "User.phoneNumber = $phoneNumber";
        }
    

    //admin
    if($userType == "admin"){
        $salaryWhere = "Admin.salary != -1";
        if($_POST['salary'] != ''){
            $salaryWhere = "Admin.salary = " . $_POST['salary'];
        }
        $privilegeWhere = "Admin.privelageLevel != -1";
        if($_POST['privilegeLevel'] != ''){
            $privilegeWhere = "Admin.privelageLevel = " . $_POST['privilegeLevel'];
        }
        

        $sql = "SELECT 
        User.userID,
        User.FName,
        User.LName,
        User.UserType
        FROM Admin
        LEFT JOIN User ON User.userID = Admin.userID
        LEFT JOIN LoginInfo ON User.userID = LoginInfo.userID
        WHERE $userIDWhere && $FNameWhere && $LNameWhere && $emailWhere && $phoneNumWhere && $salaryWhere && $privilegeWhere
        ORDER BY User.userID";

    }
    

    //faculty
    else if($userType == "faculty"){

        $typeWhere = "Faculty.facultyType != ''";
        if($_POST['facultyType'] != 'any'){
            $typeWhere = "Faculty.facultyType = '" . $_POST['facultyType'] . "'";
        }
        $rankWhere = "Faculty.facultyRank != ''";
        if($_POST['facultyRank'] != 'any'){
            $rankWhere = "Faculty.facultyRank = '" . $_POST['facultyRank'] . "'";
        }
        $officeWhere = "Faculty.officeID != -1";
        if($_POST['officeID'] != ''){
            $officeWhere = "Faculty.officeID = " . $_POST['officeID'];
        }
        
        $typeJoin = "";
        $salaryWagesWhere = "User.userID != 0";
        if($_POST['facultyType'] == 'Part Time' && $_POST['salary'] != ''){
            $typeJoin = "LEFT JOIN parttimefaculty ON parttimefaculty.userID = Faculty.userID";
            $salaryWagesWhere = "parttimefaculty.wageAmount = " . $_POST['salary'];
        }
        else if($_POST['facultyType'] == 'Full Time' && $_POST['salary'] != ''){
            $typeJoin = "LEFT JOIN fulltimefaculty ON fulltimefaculty.userID = Faculty.userID";
            $salaryWagesWhere = "fulltimefaculty.salary = " . $_POST['salary'];
        }

        $sql = "SELECT 
        User.userID,
        User.FName,
        User.LName,
        User.UserType
        FROM Faculty
        LEFT JOIN User ON user.userID = faculty.userID
        LEFT JOIN LoginInfo ON User.userID = LoginInfo.userID
        LEFT JOIN OfficeRoom ON OfficeRoom.roomID = faculty.officeID 
        $typeJoin
        WHERE $userIDWhere && $FNameWhere && $LNameWhere && $emailWhere && $phoneNumWhere && $typeWhere && $rankWhere && $officeWhere
        && $salaryWagesWhere
        ORDER BY User.userID";
    }
    //researcher
    else if($userType == "researcher"){
        $sql = "SELECT 
        User.userID,
        User.FName,
        User.LName,
        User.UserType
        FROM Researcher
        LEFT JOIN User ON User.userID = Researcher.userID
        LEFT JOIN LoginInfo ON User.userID = LoginInfo.userID
        WHERE $userIDWhere && $FNameWhere && $LNameWhere && $emailWhere && $phoneNumWhere
        ORDER BY User.userID";

    }
    //undergradstudent
    else if($userType == "undergradStudent"){

        $numOfCreditsWhere = "User.userID != -1";
        if($_POST['studyYear'] != "any"){
            if($_POST['studyYear'] == "freshman"){
                $numOfCreditsWhere = "Student.numOfCredits >= 0 && Student.numOfCredits < 30";
            }
            else if($_POST['studyYear'] == "sophmore"){
                $numOfCreditsWhere = "Student.numOfCredits >= 30 && Student.numOfCredits < 60";
            }
            else if($_POST['studyYear'] == "junior"){
                $numOfCreditsWhere = "Student.numOfCredits >= 60 && Student.numOfCredits < 90";
            }
            else if($_POST['studyYear'] == "senior"){
                $numOfCreditsWhere = "Student.numOfCredits >= 90 && Student.numOfCredits < 120";
            }    
        }
        
        $startYearWhere = "User.userID != -1";
        if($_POST['startYear'] != "any"){
            $startYearWhere = "Student.startYear = '" . $_POST['startYear'] . "'";  
        }

        $graduationDateWhere = "User.userID != -1";
        if($_POST['graduationYear'] != ""){
            $graduationDateWhere = "DATEDIFF(expectedGraduationDate, '".$_POST['graduationYear'] ."-01-01') < 365 && DATEDIFF(expectedGraduationDate, '".$_POST['graduationYear'] ."-01-01') > 0";
        }

        $statusWhere = "User.userID != -1";
        if($_POST['undergradStatus'] != 'any'){
            $statusWhere = "undergradstudent.status = '" . $_POST['undergradStatus'] . "'";

        }
        $majorWhere = "User.userID != -1";
        if($_POST['major'] != 'any'){
            $majorWhere = "undergradStudentmajor.majorID = " . $_POST['major'];
        }
        $minorWhere = "User.userID != -1";
        if($_POST['minor'] != 'any'){
            $minorWhere = "undergradStudentminor.minorID = " . $_POST['minor'];
        }

        $minGPAWhere = "User.userID != -1";
        if($_POST['minGPA'] != ""){
            $minGPAWhere = "undergradstudent.GPA >= " . $_POST['minGPA']; 
        }
        $maxGPAWhere = "User.userID != -1";
        if($_POST['maxGPA'] != ""){
            $maxGPAWhere = "undergradstudent.GPA <= " . $_POST['maxGPA']; 
        }


        $sql = "SELECT 
        User.userID,
        User.FName,
        User.LName,
        User.UserType
        FROM undergradStudent
        LEFT JOIN User ON User.userID = undergradStudent.userID
        LEFT JOIN Student ON student.userID = undergradStudent.userID
        LEFT JOIN LoginInfo ON UndergradStudent.userID = LoginInfo.userID
        LEFT JOIN undergradStudentMajor ON undergradStudentMajor.undergradstudentID = user.userID
        LEFT JOIN undergradStudentMinor ON undergradStudentMinor.undergradstudentID = user.userID
        WHERE $userIDWhere && $FNameWhere && $LNameWhere && $emailWhere && $phoneNumWhere && $numOfCreditsWhere && $startYearWhere && $graduationDateWhere
        && $statusWhere && $majorWhere && $minorWhere && $minGPAWhere && $maxGPAWhere
        ORDER BY User.userID";




    }
    //gradstudent
    else if($userType == "gradStudent"){

        $numOfCreditsWhere = "User.userID != -1";
        if($_POST['studyYear'] != "any"){
            if($_POST['studyYear'] == "1"){
                $numOfCreditsWhere = "Student.numOfCredits >= 0 && Student.numOfCredits < 16";
            }
            else if($_POST['studyYear'] == "2"){
                $numOfCreditsWhere = "Student.numOfCredits >= 16 && Student.numOfCredits < 32";
            }
            else if($_POST['studyYear'] == "3"){
                $numOfCreditsWhere = "Student.numOfCredits >= 32 && Student.numOfCredits < 48";
            }
            
        }

        $startYearWhere = "User.userID != -1";
        if($_POST['startYear'] != "any"){
            $startYearWhere = "Student.startYear = '" . $_POST['startYear'] . "'";  
        }

        $graduationDateWhere = "User.userID != -1";
        if($_POST['graduationYear'] != ""){
            $graduationDateWhere = "DATEDIFF(expectedGraduationDate, '".$_POST['graduationYear'] ."-01-01') < 365 && DATEDIFF(expectedGraduationDate, '".$_POST['graduationYear'] ."-01-01') > 0";
        }
        
        $statusWhere = "User.userID != -1";
        if($_POST['gradStatus'] != 'any'){
            $statusWhere = "gradstudent.status = '" . $_POST['gradStatus'] . "'";

        }
        $bachelorsWhere = "User.userID != -1";
        if($_POST['bachelorsDegree'] != ""){
                $bachelorsWhere = "bachelorsDegree LIKE '%" . $_POST['bachelorsDegree'] ."%'";
        }

        $gradProgramWhere = "User.userID != -1";
        if($_POST['graduateProgram'] != ""){
                $gradProgramWhere = "gradProgram LIKE '%" . $_POST['gradProgram'] ."%'";
        }

        $minGPAWhere = "User.userID != -1";
        if($_POST['minGPA'] != ""){
            $minGPAWhere = "gradstudent.GPA >= " . $_POST['minGPA']; 
        }
        $maxGPAWhere = "User.userID != -1";
        if($_POST['maxGPA'] != ""){
            $maxGPAWhere = "gradstudent.GPA <= " . $_POST['maxGPA']; 
        }

        $sql = "SELECT 
        User.userID,
        User.FName,
        User.LName,
        User.UserType
        FROM GradStudent
        LEFT JOIN User ON User.userID = gradStudent.userID
        LEFT JOIN Student ON student.userID = gradStudent.userID
        LEFT JOIN LoginInfo ON GradStudent.userID = LoginInfo.userID
        WHERE $userIDWhere && $FNameWhere && $LNameWhere && $emailWhere && $phoneNumWhere && $numOfCreditsWhere && $startYearWhere
        && $graduationDateWhere && $statusWhere && $bachelorsWhere && $gradProgramWhere && $minGPAWhere && $maxGPAWhere
        ORDER BY User.userID";

    }
    else if ($userType == "researcher"){
        $salaryWhere = "Researcher.salary != -1";
        if($_POST['salary'] != ''){
            $salaryWhere = "Researcher.salary = " . $_POST['salary'];
        }
        
        

        $sql = "SELECT 
        User.userID,
        User.FName,
        User.LName,
        User.UserType
        FROM Researcher
        LEFT JOIN User ON User.userID = Admin.userID
        LEFT JOIN LoginInfo ON User.userID = LoginInfo.userID
        WHERE $userIDWhere && $FNameWhere && $LNameWhere && $emailWhere && $phoneNumWhere && $salaryWhere && $privilegeWhere
        ORDER BY User.userID";

    }
    
    
    
    

    echo "
<table>
<thead>
<tr>
    <th>User ID</th>
    <th>Name</th>
    <th>User Type</th>
            
</tr>
</thead>
<tbody>  
";
$result = mysqli_query($conn, $sql);
if(!$result){
    echo "Something went wrong.";
}
    while ($row = $result->fetch_row()) {
        echo "<tr>";
        $userIDString = "\"$row[0]\"";
        echo "<td><div class='phpHyperText' onclick='sendRedirectForm($userIDString)'>$row[0]</td>";
        echo "<td>$row[1] $row[2]</td>";
        echo "<td>$row[3]</td>";
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