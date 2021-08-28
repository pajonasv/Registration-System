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
        <title>Remove Course Section</title>
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
        <h1>Remove Course Section</h1>


        <div>
            <form method="post" class="form" action="../scripts/deleteCourseSection.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
            <table>
                <thead>
                    <td>CRN</td>
                    <td>Section Number</td>
                    <td>Days</td>
                    <td>Period</td>
                    <td>Semester</td>
                    <td>Year</td>
                    <td>Drop?</td>
                </thead>
                <tbody>
                    <?php
                    
                    $courseID = "'" . $_POST['CourseID'] . "'";
                
                    $conn = connectToDB();

                    $sql = "SELECT coursesection.CRN, coursesection.sectionNumber, timeslotday.dayOfTheWeek,timeslotperiod.periodNumber, coursesection.startDate, semester.season, semester.semesterYear
                    FROM coursesection
                    LEFT JOIN timeslotday
                    ON timeslotday.timeslotID = coursesection.timeslotID
                    LEFT JOIN timeslotperiod
                    ON timeslotperiod.timeslotID = coursesection.timeslotID
                    LEFT JOIN semester 
                    ON semester.semesterID = coursesection.semesterID
                    WHERE coursesection.courseID = $courseID
                    GROUP BY sectionNumber";
                    
                    if(!($result = mysqli_query($conn, $sql))){
                        echo "SOMETHING WENT WRONG";
                        die();
                    }

                    while ($row = $result->fetch_row()) {
                        if($row[5]=="Fall" && $row[6] =="2021"){
                            echo "<tr>";
                            echo "<td>$row[0]</td>";
                            echo "<td>$row[1]</td>";
                            echo "<td>$row[2]</td>";
                            echo "<td>$row[1]</td>";
                            echo "<td>$row[5]</td>";
                            echo "<td>$row[6]</td>";
                            echo "<td width='11%' class='pldefault'>
                            <input type='radio' name='CRN' value='$row[0]' id='drop' required>
                        </td>";
                            echo "</tr>";
                        }
                    }

                    ?>
                </tbody>
            </table>
            <p><input type="submit" value="Submit" onclick="confAddClassSubmit(this.form)">
      
            <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>

    
        
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>