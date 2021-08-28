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
        <title>Add a Researcher Account</title>
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
    <h1>Add Researcher Account</h1>
        <div>
        <form method="post" class="form" action= "../scripts/addResearcherAccount.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
                <p><b>Add Researcher Account</b></p>

            


                <p><label><b>First Name: </b></label>
                <input type="text" class="field" placeholder="First Name of Researcher" name="FName" pattern="[A-Za-z]{1,25}" title="Please enter 1-25 alphabetical characters" required></p>

                <p><label><b>Middle Name (Optional): </b></label>
                <input type="text" class="field" placeholder="MName of Researcher" name="MName" pattern="[A-Za-z]{1,25}"  title="Please enter 1-25 alphabetical characters"></p>
                
                <p><label><b>Last Name: </b></label>
                <input type="text" class="field" placeholder="Last Name of Researcher" name="LName" pattern="[A-Za-z]{1,25}"  title="Please enter 1-25 alphabetical characters" required></p>


                <p><label><b>Gender</b></label>
                <select name="gender" id="Gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select></p>

                <p><label><b>Address</b></label>
                <p><label><b>Street: </b></label>
                <input type="text" class="field" placeholder="Street" name="street" pattern="([a-zA-Z0-9\s]+){1,100}" title="Please enter 1-100 alphanumeric characters" required></p>
                <p><label><b>City: </b></label>
                <input type="text" class="field" placeholder="City" name="city" pattern="([a-zA-Z\s]+){1,20}" title="Please enter 1-20 alphabetic characters" required></p>
                <p><label><b>State: </b></label>
                <input type="text" class="field" placeholder="State" name="state" maxlength="2" pattern="[A-Z]{2}" title="Please enter 1-2 capital alphabetic characters" required></p>
                <p><label><b>Zip Code: </b></label>
                <input type="text" class="field" placeholder="Zip Code" name="zipcode" pattern="\d{5}" title="Please enter 5 digit US ZipCode" required></p>
                <p><label><b>Phone Number: </b></label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder = "123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="Please enter valid ###-###-#### phone number" required>
                <small>Format: 123-456-7890</small>

                <p><label><b>Salary: </b></label>
                <input type="number" id="salary" name="salary"  min="1" required>
                
                
                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>