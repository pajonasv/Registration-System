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
        <title>Remove Hold for a Student</title>
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
        <h1>Remove Hold</h1>
        <div>
            <form method="post" class="form" action="../scripts/removeHold.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
                <p><b>Remove Hold for a Student</b></p>

                <label><b>Student ID: </b></label>
                <input type="text" class="field" placeholder="Enter Student ID #"  pattern="\d{0,10}" title="Please enter numeric user ID" name="StudentID" required>

                <table>
                <tr>
                    <p for="holdType"><b>Hold Type:</b></p>

                    <td width="11%" class="pldefault">
                    <input type="radio" name="select_hold_type" value="1" id="financial" required>
                    <abbr title="Financial">Financial</abbr>
                    </td>

                    <td width="11%" class="pldefault">
                    <input type="radio" name="select_hold_type" value="2" id="disciplinary">
                    <abbr title="Disciplinary">Disciplinary</abbr>
                    </td>
                </tr>
                </table>

                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>