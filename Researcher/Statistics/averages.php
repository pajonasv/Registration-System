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
	<form method="post" action="averagesDetails.php">
    <label for="type"><b>Type</b></label>
            <select name="type" id="type">
                <option value='GPA'>GPA</option>
                <option value='courseGrade'>Course Grade</option>
                <option value='salary'>Salary</option>
            </select>
            <input type="submit" value="Confirm">
	
	</form>
    </body>
</html>