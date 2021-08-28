<!doctype html>

<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Admin"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
    $CRN = $_POST['CRN'];
    $conn = connectToDB();
    $sql = "SELECT coursesection.startDate, coursesection.facultyID, coursesection.roomID, timeslotday.dayOfTheWeek,timeslotperiod.periodNumber, coursesection.totalSeats
    FROM coursesection
    LEFT JOIN timeslotday
    ON timeslotday.timeslotID = coursesection.timeslotID
    LEFT JOIN timeslotperiod
    ON timeslotperiod.timeslotID = coursesection.timeslotID
    WHERE CRN = $CRN
    GROUP BY CRN";

if(!($result = mysqli_query($conn, $sql))){
    echo "SOMETHING WENT WRONG";
    die();
}
$row = $result->fetch_row();
$isSpring = false;
if(substr($row[0],3,2) == "01"){
    $isSpring = true;
}
$facultyID = $row[1];
$roomID = $row[2];

$day = 2;
if($row[3] == "Monday" || $row[3] == "Wednesday"){
$day = 0;
}
else if($row[3] == "Tuesday" || $row[3] == "Thursday"){
$day = 1;
}

$period = $row[4];
$totalSeats = $row[5];
?>

<html lang="en">
    <head>
        <title>Update Course Section Details</title>
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
        
        <h1>Update Course Section</h1>


        <div>
            <form method="post" class="form" action= "../scripts/updateCourseSection.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
                <p><b>Enter the Semester and CRN of the course section you wish to update.</b></p>

                <p><label><b>Semester</b></label>

                <select name="Semester" id="Semester">
                
                <option>Spring 2021</option>
                <?php
                    if(!$isSpring){
                      
                        echo "<option selected>Fall 2021</option>";

                    }
                    else{
                        echo "<option>Fall 2021</option>";
                    }
                ?>
                </select>
                <br></br>

                <p><b>Enter the information of the course section you wish to update. 
                Information inputed here will be made to update the course section's details.</b></p>

                <p><label><b>Faculty ID: </b></label>
                <?php
                echo "<input type = 'hidden' name = 'CRN' value = '$CRN' />";
                echo "<input type='text' class='field'pattern='\d{0,10}' title='Please enter numeric user ID' placeholder='Faculty ID #' value = '$facultyID' name='facultyID' >";
                ?>
                </p>

                <p><label><b>Room Number: </b></label>
                <?php
                echo "<input type='text' class='field' value='$roomID' min='0' max='1000000000' placeholder='Enter Room #' name='RoomID' >";
                ?>

                <p><label><b>Total Seats: </b></label>
                <?php
                echo "<input type='number' min='0' max='1000000000' value='$totalSeats' class='field' placeholder='Enter Total Seats' name='totalSeats' required></p>";
                ?>
                <br></br>
                <table>
                <tr>
                    <p for="Days"><b>Days: </b></p>

                    <?php
                        if ($day == 0){
                            echo "<td width='11%' class='pldefault'>
                            <input type='radio' name='select_day' value='mw' id='monwed' checked>
                            <abbr title='MonWed'>Mon/Wed</abbr>
                            </td>
        
                            <td width='11%' class='pldefault'>
                            <input type='radio' name='select_day' value='tt' id='tuethur'>
                            <abbr title='TueThur'>Tue/Thur</abbr>
                            </td>
        
                            <td width='11%' class='pldefault'>
                            <input type='radio' name='select_day' value='f' id='fri'>
                            <abbr title='Fri'>Fri</abbr>
                            </td>";

                        }
                        else if($day == 1){
                            echo "<td width='11%' class='pldefault'>
                            <input type='radio' name='select_day' value='mw' id='monwed'>
                            <abbr title='MonWed'>Mon/Wed</abbr>
                            </td>
        
                            <td width='11%' class='pldefault'>
                            <input type='radio' name='select_day' value='tt' id='tuethur' checked>
                            <abbr title='TueThur'>Tue/Thur</abbr>
                            </td>
        
                            <td width='11%' class='pldefault'>
                            <input type='radio' name='select_day' value='f' id='fri'>
                            <abbr title='Fri'>Fri</abbr>
                            </td>";

                        }
                        else{
                            echo "<td width='11%' class='pldefault'>
                            <input type='radio' name='select_day' value='mw' id='monwed'>
                            <abbr title='MonWed'>Mon/Wed</abbr>
                            </td>
        
                            <td width='11%' class='pldefault'>
                            <input type='radio' name='select_day' value='tt' id='tuethur'>
                            <abbr title='TueThur'>Tue/Thur</abbr>
                            </td>
        
                            <td width='11%' class='pldefault'>
                            <input type='radio' name='select_day' value='f' id='fri' checked>
                            <abbr title='Fri'>Fri</abbr>
                            </td>";

                        }
                    ?>

                </tr>
                </table>
                
                <br></br>
                <div>
                <label><b>Period Number:</b></label>
                <?php
                echo "<input type = 'number' id='period' value = '$period' name = 'period' min='1' max='7' step='1' >";
                ?>
                </div>
                <br></br>

                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>


        
        <form action= "../scripts/redirect.php" method="post" id="redirectForm" onsubmit="return confirm('Are you sure you want to submit the form?')">
        </form>
    </body>
</html>