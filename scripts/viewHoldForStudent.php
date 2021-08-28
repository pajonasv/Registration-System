<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user'])){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>View Holds of Student</title>
        <style>
            table,tr,th,td{
                border:3px solid black;
                background-color:orange;
                color:black;
            }
        </style>
    </head>
    <body>
        <?php
            $studentID = $_POST['StudentID'];
            
            $conn = connectToDB();

            //check if the student ID provided exists:
            $sql = "SELECT * FROM Student WHERE Student.userID = $studentID";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Student $studentID does not exist";
                die();
            }

            //querying all the holds of the provided student:
            $sql = "SELECT * FROM holdstudent
            LEFT JOIN hold ON holdstudent.holdID = hold.holdID WHERE holdstudent.studentID = $studentID";
            $result = mysqli_query($conn, $sql);

            echo "
                <table>
                <thead>
                    <tr>
                        <th>Hold Type</th>
                        <th>Student ID</th>
                        <th>Date Assigned</th>
                        <th>Hold Description</th>
                    </tr>
                </thead>
                <tbody>
                ";

            while ($row = $result->fetch_row()) {
                echo "
                <tr>
                ";
                echo "<td>$row[5]</td>";
                echo "<td>$row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[4]</td>";
                echo "
                </tr>
                ";
            }
            echo "
                </table>
                </tbody>
                ";
            die();
        ?>
    </body>
</html>