
<!doctype html>
<html lang="en">
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Researcher"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>

    <head>
        <title>Researcher Homepage</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="Researcher.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "logout"
                        break;
                    case 1:
                        id = "changePass"
                        break;
                    case 3:
                        id = "viewAllMajors"
                        break;
                    case 4:
                        id = "viewAllMinors"
                        break;
                    case 9:
                        id="viewStatistics"
                        break;
                    case 10:
                        id="viewAnonymousData"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
                
            }  
        </script>
    </head>
    
    <body>
        <div>
            <h1>Welcome, Researcher!</h1>
        </div>
        <div class="linkContainer">
            <div class="buttonContainer" onclick="sendRedirectForm(0)">
                <h3>Log out</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(1)">
                <h3>Change Password</h3>
            </div>
            <div class="buttonContainer" onclick="sendRedirectForm(9)">
                <h3>Statistics</h3>
            </div>


            <div class="buttonContainer" onclick="sendRedirectForm(3)">
                <h3>View Majors</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(4)">
                <h3>View Minors</h3>
            </div>
            <div class="buttonContainer" onclick="sendRedirectForm(10)">
                <h3>Search Anonymous users</h3>
            </div>


            
        </div>
        
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>