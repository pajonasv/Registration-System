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
        <title>Edit Attendance For Student</title>
        <style>
            table, tr, th, td{
                border: 3px solid black;
                background-color: orange;
                color: black;
                width: 700px;
                height: 50px;
                text-align: center;
            }
        </style>
    </head>
    <body>

    <form id= "EditAttendance" method="post" action="../scripts/updateAttendance.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
        <?php
            $studentID = $_POST['StudentID'];
            $CRN = $_POST['CRN'];
            echo"<h1>CHANGING ATTENDANCE OF STUDENT $studentID IN SECTION WITH CRN $CRN</h1>";
            $date = date("Y-m-d");
            $springStart = '2021-01-25';
            $springEnd = '2021-05-28"';
            $FallStart = '2021-09-06';
            $FallEnd = '2021-12-17';

            $conn = connectToDB();
            //Get the correct semester:
            if(time() >= strtotime($springStart) && time() <= strtotime($springEnd)){
                $semester = 'Spring';
            }
            if(time() >= strtotime($FallStart) && time() <= strtotime($FallEnd)){
                $semester = 'Fall';
            }

            // Get today's sessionDate:
            /*$sql= "SELECT sessionDate FROM Attendance
                WHERE studentID= $studentID AND sessionDate = '$date' AND CRN = $CRN";
            $result =  mysqli_query($conn,$sql);
            $row = $result->fetch_row();
            $todaySessionDate = $row[0];*/

            //Displaying the attendance of selected student for CRN provided for the appropriate semester:
            if($semester = 'Spring'){
                $sql= "SELECT Attendance.presence, Attendance.sessionDate FROM Attendance 
                        WHERE studentID = $studentID AND sessionDate >= '$springStart' 
                        AND sessionDate <= '$springEnd'";
            }
            else{
                $sql= "SELECT Attendance.presence, Attendance.sessionDate FROM Attendance 
                WHERE studentID = $studentID AND sessionDate >= $fallStart 
                AND sessionDate <= $fallEnd";
            }            

            echo "
            <table>
            <thead>
            <tr>
            <th>Presence</th>
            <th>Session Date</th>
            <th>Change Presence</th>
            </tr>
            </thead>
            <tbody>  
            ";

            $result = mysqli_query($conn, $sql);
            while($row = $result->fetch_row()){
                echo "<tr>";
                echo "<td>$row[0]</td>";
                echo "<td>$row[1]</td>";
                if($date == $row[1]){
                echo "<td>
                            <select name='Presence' id='Presence'>
                                <option value='Present'>Present</option>
                                <option value='Late'>Late</option>
                                <option value='Absent'>Absent</option>
                            </select>
                    </td>";
                }
                else{
                    echo "<td>NOT AVAILABLE AT THIS TIME</td>";
                }
            }
            echo "
            </tbody>
            </table>
            ";
            echo "<input type = 'hidden' name='CRN' value ='$CRN'>";
            echo "<input type = 'hidden' name='StudentID' value ='$studentID'>";
            echo "<input type = 'hidden' name='SessionDate' value ='$date'>";
        ?>
        <p><input type="submit" value="Submit"></p>
        </form>
    </body>
</html>