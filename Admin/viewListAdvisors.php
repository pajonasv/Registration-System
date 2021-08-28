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
        <title>List Of All Advisors</title>
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
            function gotoViewUserForm(value){
                

                var submissionFrom = document.getElementById("redirectForm"); 
            
                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"userID\" value = "+ value +" />" +
                "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
            
                submissionFrom.submit();
                }
        </script>
    </head>
    <body>

        <h1>List Of All Advisors</h1>
        <form method="post" id="redirectForm" action="../displays/displayUser.php">
        

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Number of Advisees</th>
                        
                    </tr>
                </thead>
                <?php

                $conn = connectToDB();
                $sql = "SELECT user.userID, 
                            user.FName, 
                            user.LName, 
                            count(advises.studentID)
                        FROM advises
                        LEFT JOIN user ON advises.facultyID = user.userID
                        GROUP BY facultyID";
                    
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    echo "Something went wrong.";
                }
                while ($row = $result->fetch_row()) {
                    echo "<tr>";
                    $userIDString = "\"$row[0]\"";
                    echo "<td><div class='phpHyperText' onclick='gotoViewUserForm($userIDString)'>$row[0]</td>";
                    echo "<td>$row[1] $row[2]</td>";
                    echo "<td>$row[3]</td>";
                    echo "</tr>";
                    } 
                    echo "
                        </tbody>
                        </table>
                        ";
    
                    ?>
                
            </table>
        </form>
    </body>
        
</html>