<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Faculty"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>View Course-Section Student List</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="faculty.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "facultyHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
            function sendFacultyGoToUserForm(value){
                

                var submissionFrom = document.getElementById("FacultyUserForm"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"userID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
                }
        </script>
    </head>
    <body>
        <h1>View Course-Section Student List</h1>
        <?php

        $CRN = $_POST['CRN'];
         $conn = connectToDB();
         $sql = "SELECT user.userID, user.FName, user.LName, student.studentType 
           FROM enrollment
           LEFT JOIN User ON user.userID = enrollment.studentID 
           LEFT JOIN Student ON user.userID = student.userID
           WHERE enrollment.CRN = $CRN";
         $result = mysqli_query($conn, $sql);
         if(!$result){
             echo "something went wrong";
         }
 
         echo "
         
         <form method='post' id='FacultyUserForm' action='../displays/displayUser.php'>
         <table>
         <thead>
         <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Student Type</th>
         </tr>
         </thead>
         <tbody>  
         ";
         
         while($row = $result->fetch_row()){
           echo "<tr>";
           $studentIDString = "'" . $row[0] . "'";
           echo "<td>$row[0]</td>";
           echo "<td>$row[1] $row[2]</td>";
           echo "<td>$row[3]</td>";
           echo "</tr>";
         }
         echo "
           </tbody>
           </table>
           </form>
           ";
           ?>
        
        
        
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>