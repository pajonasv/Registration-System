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
        <title>Remove Account</title>
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
    <h1>Remove Account</h1>
        <div>
            <form method="post" class="form" action="../scripts/deleteAccount.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
                <p><b>Enter User's ID Number to Remove their Account</b></p>
                <br></br>

                <p><label><b>User ID: </b></label>
                <input type="text" class="field" pattern="\d{0,10}" title="Please enter numeric user ID" placeholder="User ID #" name="userID" required></p>
                
                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>