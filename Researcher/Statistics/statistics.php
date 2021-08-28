
<!doctype html>
<html lang="en">
<?php 
    
    include '../../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Researcher"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>

    <head>
        <title>Researcher Homepage</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../Researcher.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                
                

                var submissionFrom = document.getElementById(value); 

                submissionFrom.submit();
                
            }  
        </script>
    </head>
    
    <body>
        <div>
        </div>
        <div class="linkContainer">
            <div class="buttonContainer" onclick="sendRedirectForm('goToAveragesForm')">
                <h3>Averages</h3>
                <form action = "averages.php" method="post" id ="goToAveragesForm">
                </form>
            </div>

            
        </div>
        
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>