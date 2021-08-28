<!doctype html>
<html lang="en" class="page">
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Admin"){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
    <head>
        <title>Drop Major</title>
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
    <h1>Edit Minor</h1>
        <form method="post" class="form" id="editMajor" action="../scripts/editMinor.php" onsubmit="return confirm('Are you sure you want to submit the form?')" >
        <p><label><b>User ID: </b></label>
            <input type="text" class="field" placeholder="User ID #" pattern="\d{0,10}" title="Please enter numeric user ID" name="userID" required></p>
            <p><b>Edit Minor</b></p>
            <label><b>Minor</b></label>
            <select name="minorID" id="minorID">
            
                    <option value="-1">None</option>
                    <option value="0">Mathematics</option>
                    <option value="1">Computer Science</option>
                    <option value="2">Psychology</option>
                    
                </select>
            
            <p><input type="submit" value="Submit">
            <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
        </form>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>