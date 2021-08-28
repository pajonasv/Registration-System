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
    <h1>Edit Majors</h1>
        <form method="post" class="form" id="editMajor" action="../scripts/editMajors.php" onsubmit="return confirm('Are you sure you want to submit the form?')" >
        <p><label><b>User ID: </b></label>
            <input type="text" class="field" placeholder="User ID #" pattern="\d{0,10}" title="Please enter numeric user ID" name="userID" required></p>
            <p><b>Edit Majors</b></p>
            <label><b>Major 1</b></label>
            <select name="majorA" id="majorA">
            
                    <option value="-1">None</option>
                    <option value="0">Mathematics</option>
                    <option value="1">Computer Science</option>
                    <option value="2">Childhood Education</option>
                    <option value="3">Visual Arts</option>
                    <option value="4">Psychology</option>
                    <option value="5">History</option>
                    <option value="6">English</option>
                    <option value="7">Biological Sciences</option>
                    
                </select>
                <label><b>Major 2</b></label>
            <select name="majorB" id="majorB">
            
                    <option value="-1">None</option>
                    <option value="0">Mathematics</option>
                    <option value="1">Computer Science</option>
                    <option value="2">Childhood Education</option>
                    <option value="3">Visual Arts</option>
                    <option value="4">Psychology</option>
                    <option value="5">History</option>
                    <option value="6">English</option>
                    <option value="7">Biological Sciences</option>
                    
                </select>
            <p><input type="submit" value="Submit">
            <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
        </form>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>