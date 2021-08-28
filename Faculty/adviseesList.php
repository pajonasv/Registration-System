<!doctype html>
<html lang="en">
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Faculty"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="faculty.css">
        <script type="text/javascript">
    function sendGoToCourseForm(value){
                

                var submissionFrom = document.getElementById("gotoCourse"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"courseID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
                }

    function sendFacultyToTranscriptPage(value){
                

                var submissionFrom = document.getElementById("studentIDForm"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"StudentID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
                }
             
    </script>
    </head>
    <body>
        <h1>List of students you advise:</h1>
        <?php

        $userID = $_COOKIE['userID'];
         //advisees
         $conn = connectToDB();
         $sql = "SELECT user.userID, user.FName, user.LName,advises.dateAssigned 
           FROM advises
           LEFT JOIN User ON user.userID = advises.studentID 
           WHERE facultyID =$userID";
         $result = mysqli_query($conn, $sql);
 
         echo "
         
         <form method='post' id='studentIDForm' action='../scripts/viewTranscriptOfStudent.php'>
         <h3>Advisees</h3>
         <table>
         <thead>
         <tr>
         <th>User ID</th>
         <th>Student Name</th>
         <th>Date Assigned</th>
         </tr>
         </thead>
         <tbody>  
         ";
         
         while($row = $result->fetch_row()){
           echo "<tr>";
           echo "<td><div class='phpHyperText' onclick=\"sendFacultyToTranscriptPage($row[0])\">$row[0]</div></td>";
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
    </body>
</html>
