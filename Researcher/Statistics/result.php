<!doctype html>
<?php 
    
    include '../../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Researcher"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>Result</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../Researcher.css">
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
    </head>
    <body>
    <h1>Result</h1>
    <?php
        $conn = connectToDB();
        $type = $_POST['type'];
        $gender = $_POST['gender'];
        $studentType = $_POST['studentType'];
        $studentStatus = $_POST['studentStatus'];
        $semesterID = $_POST['semester'];
        $majorID = $_POST['major'];
        $minorID = $_POST['minor'];
        $courseID = $_POST['courseID'];
        $userType = $_POST['userType'];
        $facultyType = $_POST['facultyType'];
        $facultyRank = $_POST['facultyRank'];
        $gradProgram = $_POST['gradProgram'];

        $facultyID = $_POST['facultyID'];

        $total = 0.00;
        $count = 0;

        if($gender == "male"){ 
            $genderWhere = "&& user.gender = 'Male'";

        }
        else if($gender == "female"){
            $genderWhere = "&& user.gender = 'Female'";
        }
        else if($gender == "other"){
            $genderWhere = "&& user.gender != 'Female' && user.gender != 'Male'";
        }

        if($semesterID != '-1'){

            $semesterIDWhere = "&& user.userID IN (SELECT studentID FROM enrollment
            LEFT JOIN coursesection ON coursesection.CRN = enrollment.CRN
            WHERE coursesection.semesterID = $semesterID)";

        }

        if($majorID != '-1'){
            $majorWhere = "&& undergradstudentmajor.majorID = $majorID";
        }
        if($minorID != '-1'){
            $minorWhere = "&& undergradstudentminor.minorID = $minorID";
        }
        if($gradProgram != "any"){
            $gradProgramWhere = " && gradstudent.gradProgram = '$gradProgram'";

        }

        if($courseID != ""){
            $sql = "SELECT * from course where courseid = '$courseID'";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo " $courseID does not exist.";
                die();
            }

            $courseIDWhere = " && coursesection.courseID = '$courseID'";

        }
        if($facultyID != ""){
            
            $sql = "SELECT * from faculty where userID = $facultyID";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Faculty $facultyID does not exist.";
                die();
            }

            $facultyWhere = " && coursesection.facultyID = $facultyID";
            

        }

        if($type == "salary"){

            if($facultyRank != "any"){
                $rankWhere = " && faculty.facultyRank = '$facultyRank'";
            }


            if(($userType == "faculty" || $userType == "-1")){



                if($facultyType == "Full Time" || $facultyType == "any"){
                    $fulltimesql = "SELECT salary 
                    FROM fulltimefaculty
                    LEFT JOIN user ON user.userID = fulltimefaculty.userID
                    LEFT JOIN faculty ON fulltimefaculty.userID = faculty.userID
                    WHERE user.userID != -1 $genderWhere $rankWhere";
                    
                    $fulltimeFacultyResult = mysqli_query($conn, $fulltimesql);    
                }
                if($facultyType == "Part Time" || $facultyType == "any"){
                    $parttimesql = "SELECT wageAmount
                    FROM parttimefaculty
                    LEFT JOIN user ON user.userID = parttimefaculty.userID
                    LEFT JOIN faculty ON parttimefaculty.userID = faculty.userID
                    WHERE user.userID != -1 $genderWhere $rankWhere";
                    
                    $parttimeFacultyResult = mysqli_query($conn, $parttimesql);
                }
                
            }
            if(($userType == "admin" || $userType == "-1") && $facultyRank == "any" && $facultyType == "any"){
                $adminsql = "SELECT salary 
                    FROM admin
                    LEFT JOIN user ON user.userID = admin.userID
                    WHERE user.userID != -1 $genderWhere";
                    
                    $adminResult = mysqli_query($conn, $adminsql);

            }
            if(($userType == "researcher" || $userType == "-1") && $facultyRank == "any" && $facultyType == "any"){
                $researchersql = "SELECT salary 
                    FROM researcher
                    LEFT JOIN user ON user.userID = researcher.userID
                    WHERE user.userID != -1 $genderWhere";
                    
                    $researcherResult = mysqli_query($conn, $researchersql);

            }

            if(!is_null($fulltimeFacultyResult)){
                while($row = $fulltimeFacultyResult->fetch_row()){
                    $total += $row[0];
                    $count++;
                }
            }
            if(!is_null($parttimeFacultyResult)){
                while($row = $parttimeFacultyResult->fetch_row()){
                    $total += $row[0];
                    $count++;
                }
            }
            if(!is_null($adminResult)){
                while($row = $adminResult->fetch_row()){
                    $total += $row[0];
                    $count++;
                }
            }
            if(!is_null($researcherResult)){
                while($row = $researcherResult->fetch_row()){
                    $total += $row[0];
                    $count++;
                }
            }

            $average = $total/$count;
            if($count == 0){
                $average = 0.00;
            }
            $average = round($average, 2);
            echo "<br>Total entries: $count <br>Average Salary: $$average";
        }


        if($type == "courseGrade"){

            $sql = "SELECT enrollment.grade
                    FROM enrollment
                    LEFT JOIN user ON user.userID = enrollment.studentID
                    LEFT JOIN coursesection ON coursesection.CRN = enrollment.CRN
                    WHERE enrollment.studentID != -1 $genderWhere $courseIDWhere $facultyWhere";
            $result = mysqli_query($conn, $sql);

            if(!$result){
                echo "Something went wrong";
                die();
            }

            while($row = $result->fetch_row()){
                switch($row[0]){
                    case "A":
                        $total += 16;
                        $count++;
                        break;
                    case "B":
                        $total += 12;
                        $count++;
                        break;
                    case "C":
                        $total += 8;
                        $count++;
                        break;
                    case "D":
                        $total += 4;
                        $count++;
                        break;
                    case "F":
                        $count++;
                        break;
                    default:
                        break;
                    
                }
            }

            $average = $total/$count;
            if($count == 0){
                $average = 0.00;
            }

            if($average < 4){
                $averageGrade = 'F';
            }
            else if($average < 8){
                $averageGrade = 'D';
            }
            else if($average < 12){
                $averageGrade = 'C';
            }
            else if($average < 16){
                $averageGrade = 'B';
            }
            else{
                $averageGrade = 'A';
            }
            $average = round($average, 2);
            echo "<br>Total entries: $count <br>Average Grade: " . $averageGrade . "<br>Average Grade Points: $average";
        }

        if($type == "GPA"){

            if(($studentType == "undergraduate" || $studentType == "any") && $gradProgram == "any"){

                if($studentStatus == "fulltime"){ 
                    $statusWhere = "&& undergradstudent.status = 'Full Time'";
        
                }
                else if($studentStatus == "parttime"){
                    $statusWhere = "&& undergradstudent.status = 'Part Time'";
                }
                else if($studentStatus == "graduated"){
                    $statusWhere = "&& undergradstudent.status = 'graduated'";
                }


                $sql = "SELECT GPA, user.userID from undergradstudent
                        LEFT JOIN user ON user.userID = undergradstudent.userID
                        LEFT JOIN undergradstudentmajor ON undergradstudentmajor.undergradstudentID = user.userID
                        LEFT JOIN undergradstudentminor ON undergradstudentminor.undergradstudentID = user.userID
                        $enrollmentJOINs
                        WHERE undergradstudent.userID != -1 $genderWhere $statusWhere $semesterIDWhere $majorWhere $minorWhere";
                $undergradResult = mysqli_query($conn, $sql);
            }
            if(($studentType == "graduate" || $studentType == "any") && $majorID == "-1" && $minorID == "-1"){

                if($studentStatus == "fulltime"){ 
                    $statusWhere = "&& gradstudent.status = 'Full Time'";
        
                }
                else if($studentStatus == "parttime"){
                    $statusWhere = "&& gradstudent.status = 'Part Time'";
                }
                else if($studentStatus == "graduated"){
                    $statusWhere = "&& gradstudent.status = 'graduated'";
                }

                $sql = "SELECT GPA, user.userID from gradstudent
                        LEFT JOIN user ON user.userID = gradstudent.userID
                        WHERE gradstudent.userID != -1 $genderWhere $semesterIDWhere $statusWhere $gradProgramWhere";
                $gradResult = mysqli_query($conn, $sql);
            }

            
            if(!is_null($undergradResult)){
                while($row = $undergradResult->fetch_row()){
                    if($semesterID == -1){
                    $total += $row[0];
                    
                    }
                    else{
                        $total += getGPA($conn, $row[1], $semesterID);
                        
                    }
                    $count++;
                }
            }
            if(!is_null($gradResult)){
                while($row = $gradResult->fetch_row()){
                    if($semesterID == -1){
                        $total += $row[0];
                    }
                        else{
                            $total += getGPA($conn, $row[1], $semesterID);
                        }
                        $count++;
                }
                

            }
            $average = $total/$count;
            if($count == 0){
                $average = 0.00;
            }
            $average = round($average, 2);
            echo "<br>Total entries: $count <br> Average: " . $average;
            

        }
        
    
    
    ?>
	
    </body>
</html>