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
        <title>Update Course Section</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="admin.css">
        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "adminHomepage";
                        break;
                    case 1:
                        id = "updateCourseSectionSelectSection";
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
            
        </script>
    </head>

    <body>
    <h1>Update Course Section</h1>
        <form method="post" action="updateCourseSectionSelectSection.php" name="courseIDForm" id="courseIDForm" class= "form" onsubmit="return confirm('Are you sure you want to submit the form?')">
            <p><label><b>Course ID: </b></label>
            <input type="text" class="field" placeholder="Course ID" pattern="([a-zA-Z0-9\s]){1,10}"  title="Please enter 1-10 alphanumeric characters" name="CourseID" required></p>

            <p><button type="submit">Submit</button>
            <input type="button" value="Cancel"onclick="sendRedirectForm(0)"></p>
        </form>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>