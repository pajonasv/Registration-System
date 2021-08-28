<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Admin"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>List of Enrolled Undergraduate Students</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="admin.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "adminHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
        </script>
    </head>
    <body>
            <h1>LIST OF ALL ENROLLED UNDERGARDUATE STUDENTS</h1>
            
                <?php
                $conn = connectToDB();
                
                $sql = "SELECT
                            User.userID,
                            User.FName, 
                            User.MName,
                            User.LName,
                            User.Gender,
                            User.Street,
                            User.City,
                            User.State,
                            User.zipCode,
                            User.phoneNumber,
                            logininfo.email,
                            Student.numOfCredits,
                            Student.expectedGraduationDate,
                            Student.startYear,
                            undergradstudent.GPA,
                            undergradstudent.GPARequirement,
                            undergradstudent.creditsToGraduate,
                            undergradstudent.status,
                            fulltimeundergradstudent.courseLoad
                            FROM fulltimeundergradstudent
                            LEFT JOIN logininfo ON fulltimeundergradstudent.userID = logininfo.userID
                            LEFT JOIN User ON User.userID = fulltimeundergradstudent.userID
                            LEFT JOIN Student ON fulltimeundergradstudent.userID = Student.userID
                            LEFT JOIN undergradstudent ON undergradstudent.userID = fulltimeundergradstudent.userID";
                $sql2 = "SELECT 
                User.userID,
                User.FName, 
                User.MName,
                User.LName,
                User.Gender,
                User.Street,
                User.City,
                User.State,
                User.zipCode,
                User.phoneNumber,
                logininfo.email,
                Student.numOfCredits,
                Student.expectedGraduationDate,
                Student.startYear,
                undergradstudent.GPA,
                undergradstudent.GPARequirement,
                undergradstudent.creditsToGraduate,
                undergradstudent.status,
                parttimeundergradstudent.courseLoad
                FROM parttimeundergradstudent
                LEFT JOIN logininfo ON parttimeundergradstudent.userID = logininfo.userID
                LEFT JOIN User ON User.userID = parttimeundergradstudent.userID
                LEFT JOIN Student ON parttimeundergradstudent.userID = Student.userID
                LEFT JOIN undergradstudent ON undergradstudent.userID = parttimeundergradstudent.userID";

                
                

                echo "
        <table>
        <thead>
        <tr>
        <th>ID </th>
        <th>FName</th>
        <th>MName</th>
        <th>LName</th>
        <th>Gender</th>
        <th>Street</th>
        <th>City</th>
        <th>State</th>
        <th>ZipCode</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Number Of Credits</th>
        <th>Expected Graduation Date</th>
        <th>Start Year</th>
        <th>GPA</th>
        <th>GPA Requirement</th>
        <th>Credits To Graduate</th>
        <th>Status</th>
        <th>Course Load</th>
        </tr>
        </thead>
        <tbody>  
        ";
        $result = mysqli_query($conn, $sql);
                while ($row = $result->fetch_row()) {
                    echo "<tr>";
                    echo "<td>$row[0]</td>";
                    echo "<td>$row[1]</td>";
                    echo "<td>$row[2]</td>";
                    echo "<td>$row[3]</td>";
                    echo "<td>$row[4]</td>";
                    echo "<td>$row[5]</td>";
                    echo "<td>$row[6]</td>";
                    echo "<td>$row[7]</td>";
                    echo "<td>$row[8]</td>";
                    echo "<td>$row[9]</td>";
                    echo "<td>$row[10]</td>";
                    echo "<td>$row[11]</td>";
                    echo "<td>$row[12]</td>";
                    echo "<td>$row[13]</td>";
                    echo "<td>$row[14]</td>";
                    echo "<td>$row[15]</td>";
                    echo "<td>$row[16]</td>";
                    echo "<td>$row[17]</td>";
                    echo "<td>$row[18]</td>";
                    echo "</tr>";
                  } 
                  
                  $result = mysqli_query($conn, $sql2);
                  while ($row = $result->fetch_row()) {
                      echo "<tr>";
                      echo "<td>$row[0]</td>";
                      echo "<td>$row[1]</td>";
                      echo "<td>$row[2]</td>";
                      echo "<td>$row[3]</td>";
                      echo "<td>$row[4]</td>";
                      echo "<td>$row[5]</td>";
                      echo "<td>$row[6]</td>";
                      echo "<td>$row[7]</td>";
                      echo "<td>$row[8]</td>";
                      echo "<td>$row[9]</td>";
                      echo "<td>$row[10]</td>";
                      echo "<td>$row[11]</td>";
                      echo "<td>$row[12]</td>";
                      echo "<td>$row[13]</td>";
                      echo "<td>$row[14]</td>";
                      echo "<td>$row[15]</td>";
                      echo "<td>$row[16]</td>";
                      echo "<td>$row[17]</td>";
                      echo "</tr>";
                    } 
                    echo "
                    </tbody>
                    </table>
                    ";
                
            ?>
           
    </body>
</html>