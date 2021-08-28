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
        <title>User Search</title>
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
    <h1>Averages</h1>
	<form method="post" action="result.php">
    <?php 
        $type = $_POST["type"];
        echo "<input type = 'hidden' name = 'type' value = '$type'>";

        echo "
        <label for='gender'><b>Gender</b></label>
        <select name='gender' id='gender'>
                <option value='any'>Any</option>
                <option value='male'>Male</option>
                <option value='female'>Female</option>
                <option value='other'>Other</option>
        </select>
        <br>";

        if($type == "GPA"){
            echo "
        <label for='studentType'><b>Student Type</b></label>
        <select name='studentType' id='studentType'>
                <option value='any'>Any</option>
                <option value='undergraduate'>Undergraduate</option>
                <option value='graduate'>Graduate</option>
        </select>
        <br>";

        echo "
        <label for='studentStatus'><b>Student Status</b></label>
        <select name='studentStatus' id='studentStatus'>
                <option value='any'>Any</option>
                <option value='fulltime'>Full Time</option>
                <option value='parttime'>Part Time</option>
                <option value='graduated'>Graduated</option>
        </select>
        <br>";

        echo "
        <p><label for='semester'><b>Semester</b></label>
            <select name='semester' id='semester'>
            
                <option value='-1'>Any</option>
                <option value='99'>Spring 2020</option>
                <option value='98'>Fall 2020</option>
                <option value='97'>Spring 2019</option>
                <option value='96'>Fall 2019</option>
                <option value='95'>Spring 2018</option>
                <option value='94'>Fall 2018</option>
                <option value='93'>Spring 2017</option>
                <option value='92'>Fall 2017</option>
            </select>
            <br>";

        echo "
        <label><b>Major</b></label>
            <select name='major' id='major'>
            
                    <option value='-1'>None</option>
                    <option value='0'>Mathematics</option>
                    <option value='1'>Computer Science</option>
                    <option value='2'>Childhood Education</option>
                    <option value='3'>Visual Arts</option>
                    <option value='4'>Psychology</option>
                    <option value='5'>History</option>
                    <option value='6'>English</option>
                    <option value='7'>Biological Sciences</option>
                    
                </select>
                <br>
        ";
        echo "
        <label><b>Minor</b></label>
            <select name='minor' id='minor'>
            
                    <option value='-1'>None</option>
                    <option value='0'>Mathematics</option>
                    <option value='1'>Computer Science</option>
                    <option value='2'>Psychology</option>
                    
                </select>
                <br>
                <label><b>Grad Program</b></label>
                <select name='gradProgram' id='gradProgram'>
                
                        <option value='any'>Any</option>
                        <option value='Mathematics, PhD'>Mathematics, PhD</option>
                        <option value='M.S. in Data Science'>M.S. in Data Science</option>
                        <option value='Biomedical Sciences, PhD'>Biomedical Sciences, PhD</option>
                        <option value='Adolescence Education: Biology (7-12), M.A.T.'>Adolescence Education: Biology (7-12), M.A.T.</option>
                        <option value='Adolescence Education: English Language Arts (7-12), M.A.T.'>Adolescence Education: English Language Arts (7-12), M.A.T.</option>
                        <option value='Mental Health Counseling, M.S.'>Mental Health Counseling, M.S.</option>
                        <option value='Adolescence Education: Mathematics (7-12), M.A.T.'>Adolescence Education: Mathematics (7-12), M.A.T.</option>
                        
                    </select>
        ";

        }
        else if($type == "courseGrade"){

            echo "
            
            <p><label><b>Course ID: </b></label>
            <input type='text' placeholder='Course ID' class='field' name='courseID'></p>
            ";
            
        }
        else if($type == "salary"){
            echo "
            <p><label><b>User Type</b></label>
            <select name='userType' id='userType'>
            
                    <option value='-1'>All</option>
                    <option value='researcher'>Researcher</option>
                    <option value='admin'>Admin</option>
                    <option value='faculty'>Faculty</option>
                    
                </select>";
            echo "
            <div>
            <p><label><b>Faculty Type</b></label>
                        <select name='facultyType' id='facultyType'>
                        <option value='any'>Any</option>
                        <option value='Full Time'>Full Time</option>
                        <option value='Part Time'>Part Time</option>
                        </select>
            </div>
        
            <div>
            <p><label><b>Faculty Rank</b></label>
                        <select name='facultyRank' id='facultyRank'>
                        <option value='any'>Any</option>
                        <option value='Junior'>Junior</option>
                        <option value='Senior'>Senior</option>
                        <option value='Manager'>Manager</option>
                        <option value='Head'>Head</option>
                        </select>
            </div>
            ";
        }

    ?>
    <input type="submit" value="Confirm">
	
	</form>
    </body>
</html>