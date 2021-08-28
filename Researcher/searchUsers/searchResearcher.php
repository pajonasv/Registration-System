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
        <title>Researcher Search</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="searchUsers.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "ResearcherHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
        </script>
    </head>
    <body>
    <h1>Researcher Search</h1>
	<form method="post" action="result.php">

	
    <input type = "hidden" name = "userType" value = "researcher" />

    <p><input type="submit" value="Submit">
    <input type="button" onclick="sendRedirectForm(0)" value="Back"></p>
    <div>
    <p><label><b>Salary/Wages: </b></label>
    <input type="number" class="field" placeholder="Salary/Wages" name="salary"></p>
    </div>
	</form>

    <form action= "../../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>