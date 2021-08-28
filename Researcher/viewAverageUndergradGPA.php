<!doctype html>

<?php 
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Researcher"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>

<html lang="en">
    <head>
        <title>List of Undergraduate Student's GPA</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Researcher.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "researcherHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
        </script>
        <style>
            table,tr,th,td{
                border:3px solid black;
                background-color:orange;
                color:black;
            }
        </style>
    </head>
    <body>

        <h1>List of Undergraduate Student's GPA</h1>
        <?php
            $userID = $_COOKIE['userID'];

            $conn = connectToDB();


            $graduated = 'graduated';

            $sql = "SELECT COUNT (User.userID) AS TotalStudents, AVG(undergradstudent.GPA)
            FROM User
            INNER JOIN undergradstudent
            ON User.userID = undergradstudent.userID
            WHERE undergradstudent.status != '$graduated'";

            echo "
                <table>
                <thead>
                <tr>
                    <th>Total Undergraduate Students</th>
                    <th>Average GPA</th>
                </thead>
                <tbody>
                ";
                $result = mysqli_query($conn, $sql);
                while ($row = $result->fetch_row()) {
                    echo "<tr>";
                    echo "<td>$row[0]</td>";
                    echo "<td>$row[1]</td>";
                    echo "</tr>";
                } 

                echo "
                </tbody>
                </table>
                ";
            die();
        ?>

    </body>
        
</html>