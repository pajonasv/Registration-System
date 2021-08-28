<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Student"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>View Holds</title>
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
            $userID = $_COOKIE['userID'];

            $conn = connectToDB();

            //querying all the holds of the provided student:
            $sql = "SELECT * FROM holdstudent
            LEFT JOIN hold ON holdstudent.holdID = hold.holdID WHERE holdstudent.studentID = $userID";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows > 0){
            echo "
                <table>
                <thead>
                    <tr>
                        <th>Hold Type</th>
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
                echo "<td>$row[2]</td>";
                echo "<td>$row[4]</td>";
                echo "
                </tr>
                ";
            }
            echo "
                </tbody>
                </table>
                ";
        }
        else{
            echo "You have no holds.";
        }
        ?>

    </body>
</html>