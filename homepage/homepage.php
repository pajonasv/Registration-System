
<!doctype html>
<html lang="en">
    <?php 
        include '../global.php';

    ?>
    <head>
        <title>NHU homepage</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="homepage.css">
        <script type="text/javascript">
            function sendRedirectForm(value){

                var id;
                switch(value){
                    case 0:
                        id = "loginPage"
                        break;
                    case 1:
                        id = "academicCalendar"
                        break;
                    case 2:
                        id = "catalog"
                        break;
                    case 3:
                        id = "masterSchedule"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();

            }
        </script>
    </head>
    
    <body>
        <div class="center"><img src="NorthernHemisphereUniversity.png" alt="School"></div>
        <div class="title">
    	    <h1>Welcome to NHU website!</h1>
        </div>
        <div class="linkContainer">
            <div class="buttonContainer" onclick="sendRedirectForm(0)">
                <h3>Log In</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(1)">
                <h3>Academic Calendar</h3>

            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(2)">
                <h3>College Catalog</h3>
            </div>

            <div class="buttonContainer" onclick="sendRedirectForm(3)">
               <h3>Master Schedule 2021</h3>
            </div>

        </div>
        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>