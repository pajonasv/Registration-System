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
        <title>Admin Search</title>
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
    <h1>Admin Search</h1>
	<form method="post" action="result.php">

    
    <div>
    <p><label><b>Salary: </b></label>
    <input type="number" class="field" placeholder="Salary" name="salary"></p>
    </div>

    <p><label><b>Privilege Level: </b></label>
    <input type="number" class="field" placeholder="0-10" name="privilegeLevel" max="10" min="0"></p>
    </div>
	
    <input type = "hidden" name = "userType" value = "admin" />

    <p><input type="submit" value="Submit">
    <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>

	</form>

    <form action= "../../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>