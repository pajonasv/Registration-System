<!doctype html>
<html lang="en">
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user'])){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
    <head>
        <title>Change Password</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="changePassword.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "facultyHomepage"
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
            <form method="post" class="form" id="changePassForm" action="../scripts/changePassword.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
                <h1><b>Change Password</b></h1>
                <label><b>Current Password</b></label>
                <input type="password" class="field" placeholder="Enter current password"  name="oldPassword" required>

                <p><label><b>New Password</b></label>
                <input type="password" class="field" placeholder="Enter new password" name="newPassword" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Password must be: Minimum eight characters, At least one uppercase letter, one lowercase letter, one number and one special character" required></p>

                <p><label><b>Re-enter New Password</b></label>
                <input type="password" class="field" placeholder="Re-enter new password" name="reNewPassword" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Password must be: Minimum eight characters, At least one uppercase letter, one lowercase letter, one number and one special character" required></p>

                <input type="submit" value="Submit">
                <button type="button" onclick="history.back()">Cancel</button>
            </form>
        </div>
    </body>
</html>
