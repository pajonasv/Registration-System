<!doctype html>
<html lang="en" class="page">
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Student"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
    <head>
        <title>Change Grad Program</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="student.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "studentHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            } 
        </script>
    </head>
    <body>
    <h1>Change Grad Program</h1>
        <form method="post" class="form" id="editGradProgram" action="../scripts/editGradProgram.php" onsubmit="return confirm('Are you sure you want to submit the form?')" >
            <p><b>Change Grad Program</b></p>
            <label><b>Grad Program</b></label>
            <select name="gradProgram" id="gradProgram">
            
                    <option value="Mathematics, PhD">Mathematics, PhD</option>
                    <option value="M.S. in Data Science">M.S. in Data Science</option>
                    <option value="Biomedical Sciences, PhD">Biomedical Sciences, PhD</option>
                    <option value="Adolescence Education: Biology (7-12), M.A.T.">Adolescence Education: Biology (7-12), M.A.T.</option>
                    <option value="Adolescence Education: English Language Arts (7-12), M.A.T.">Adolescence Education: English Language Arts (7-12), M.A.T.</option>
                    <option value="Mental Health Counseling, M.S.">Mental Health Counseling, M.S.</option>
                    <option value="Adolescence Education: Mathematics (7-12), M.A.T.">Adolescence Education: Mathematics (7-12), M.A.T.</option>
                    
                </select>
            <p><input type="submit" value="Submit">
            <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
        </form>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>