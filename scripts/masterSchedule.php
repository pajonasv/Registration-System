<!doctype html>
<html lang="en">

<head>
    <title>masterSchedule</title>
</head>
<body>
    <?php 
        include '../global.php';

        $departmentName = $_POST['department'];
        $courseID = "'" . $_POST['courseID'] . "'";
        $facultyFirstName = $_POST['facultyFirstName'];
        $facultyLastName = $_Post['facultyLastName'];
        $semester = $_POST['semester'];
        $day = $_POST['select_day'];

        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];

        //To change department from name to ID.
        if($departmentName == "Maths & CIS")
            $department = 0;
        if($departmentName == "Education")
            $department = 1;
        if($departmentName == "Visual Arts")
            $department = 2;
        if($departmentName == "Psychology")
            $department = 3;
        if($departmentName == "History")
            $department = 4;
        if($departmentName == "English")
            $department = 5;
        if($departmentName == "Biological Sciences")
            $department = 6;

        $conn = connectToDB();

        //To make sure that the course exists in the selected semester.
        if($courseID && $department){
            $sql = "SELECT course.departmentID, courseSection.CRN, courseSection.courseID, courseSection.roomID, courseSection.startDate, courseSection.endDate, courseSection.seatsLeft, courseSection.seatsTaken, courseSection.sectionNumber, user.FName, user.LName, period.startTime, period.endTime, building.buildingID from courseSection
                where courseSection.courseID = $courseID AND course.departmentID = $department
                INNER JOIN user ON courseSection.facultyID = user.userID
                INNER JOIN timeslot ON courseSection.timeslotID = timeslot.timeslotID
                INNER JOIN timeslotPeriod ON timeslot.timeslotID = timeslotPeriod.timeslotID
                INNER JOIN period ON period.periodNumber = timeslotPeriod.periodNumber
                INNER JOIN timeslotDay ON timelsotDay.timeslotID = timeslot.timeSlotID
                INNER JOIN room ON courseSection.roomID = building.roomID
                INNER JOIN department ON courseSection.departmentID = $department";

            $result = mysqli_query($conn, $sql);
            if(!$mysqli->connect_errno){
                echo "
                <table>
                    <thead>
                    <tr>
                        <th>CRN</th>
                        <th>CourseID</th>
                        <th>Faculty First Name</th>
                        <th>Faculty Last Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Day</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>Building ID</th>
                        <th>Room ID</th>
                        <th>Seats Left</th>
                        <th>Seats Taken</th>
                    </tr>
                </thead>
                <tbody>  
                ";

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
                    echo "</tr>";
                } 
                echo "
                </tbody>
                </table>
                ";
            }
        }
        //To make sure professor first name exists.
        if($facultyFirstName){
            $sql = "SELECT userID from user WHERE FName = $facultyFirstName";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Faculty First Name does not exist";
                die();
            }
        }
        
        //To make sure professor last name exists.
        if($facultyLastName){
            $sql = "SELECT userID from user WHERE LName = $facultyLastName";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Faculty Last Name does not exist";
                die();
            }
        }
        
        //To make sure the start time exists.
        if($startTime){
            $sql = "SELECT startTime from period where startTime = $startTime";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Start Time";
                die();
            }
        }

        //To make sure the end time exists.
        if($endTime){
            $sql = "SELECT endTime from period where endTime = $endTime";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "End Time does not exist";
                die();
            }
        }
        
        //To query the sections from given input.
        if($courseID && $facultyFirstName && $facultyLastName && $startTime && $endTime && $day && $department){
            $sql = "SELECT courseSection.CRN, courseSection.courseID, courseSection.roomID, courseSection.startDate, courseSection.endDate, courseSection.seatsLeft, courseSection.seatsTaken, courseSection.sectionNumber, user.FName, user.LName, period.startTime, period.endTime, building.buildingID from courseSection
                where courseSection.courseID = $courseID AND user.FName = $facultyFirstName AND user.LName = $facultyLastName AND period.startTime = $startTime AND period.endTime = $endTime AND course.departmentID = $department
                INNER JOIN user ON courseSection.facultyID = user.userID
                INNER JOIN timeslot ON courseSection.timeslotID = timeslot.timeslotID
                INNER JOIN timeslotPeriod ON timeslot.timeslotID = timeslotPeriod.timeslotID
                INNER JOIN period ON period.periodNumber = timeslotPeriod.periodNumber
                INNER JOIN timeslotDay ON timelsotDay.timeslotID = timeslot.timeSlotID
                INNER JOIN room ON courseSection.roomID = building.roomID
                INNER JOIN department ON courseSection.departmentID = $department";

            $result = mysqli_query($conn, $sql);
            if(!$mysqli->connect_errno){
                echo "
                <table>
                    <thead>
                    <tr>
                        <th>CRN</th>
                        <th>CourseID</th>
                        <th>Faculty First Name</th>
                        <th>Faculty Last Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Day</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>Building ID</th>
                        <th>Room ID</th>
                        <th>Seats Left</th>
                        <th>Seats Taken</th>
                    </tr>
                </thead>
                <tbody>  
                ";

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
                    echo "</tr>";
                } 
                echo "
                </tbody>
                </table>
                ";
            }
        }
        else{
            echo "it didnt work";
        }

        die();
    ?>
</body>