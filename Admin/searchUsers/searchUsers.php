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
        <title>User Search</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="searchUsers.css">
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
    <h1>User Search</h1>
	<form method="post" action="searchUsersDetails.php">
    <label for="userType"><b>User Type</b></label>
            <select name="userType" id="userType">
                <option value='undergradStudent'>Undergraduate Student</option>
                <option value='gradStudent'>Graduate Student</option>
                <option value='faculty'>Faculty</option>
                <option value='admin'>Admin</option>
                <option value='researcher'>Researcher</option>
                
            </select>
            <input type="submit" value="Confirm">
	
	</form>
    </body>
</html>