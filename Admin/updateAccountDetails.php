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
        <title>Update Account</title>
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
    <h1>Update Account</h1>
    <?php

$userID = $_POST['userID'];
$conn = connectToDB();
$sql = "SELECT user.* , LoginInfo.email
FROM user 
LEFT JOIN LoginInfo ON LoginInfo.userID = user.userID
WHERE user.userID = $userID";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_row();

$FName = $row[1];
$MName = $row[2]; 
$LName = $row[3];
$gender = $row[4];
$street = $row[5];
$city = $row[6];
$state = $row[7];
$zipCode = $row[8];
$phoneNum = $row[9];
$userType = $row[10];
$email = $row[11];

if($userType == "Admin"){
  $conn = connectToDB();
  $sql = "SELECT admin.*
  FROM admin 
  WHERE admin.userID = $userID";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_row();

  $salary = $row[1];
  $privilegeLevel = $row[2];

}
else if($userType == "Faculty"){
  $conn = connectToDB();
  $sql = "SELECT faculty.*
  FROM faculty 
  WHERE faculty.userID = $userID";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_row();

  $officeID = $row[1];
  $facultyType = $row[2];
  $facultyRank = $row[3];

  



  if($facultyType== "Full Time"){
    $sql = "SELECT fulltimefaculty.*
    FROM fulltimefaculty 
    WHERE fulltimefaculty.userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $salary = $row[1];
    $maxCourseLoad = $row[2];

  }
  else{
    $sql = "SELECT parttimefaculty.*
    FROM parttimefaculty 
    WHERE parttimefaculty.userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $wages = $row[1];
    $maxCourseLoad = $row[2];
    $maxTeachingAssistantLoad = $row[3];

  }

}

else if($userType == "Student"){
  $sql = "SELECT *
  FROM Student 
  WHERE userID = $userID";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_row();

  $numOfCredits = $row[1];
  $expectedGraduationDate = $row[2];
  $startYear = $row[3];
  $studentType = $row[4];

  if($studentType == "Undergraduate"){
    $sql = "SELECT *
      FROM undergradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $GPA = $row[1];
    $GPARequirement = $row[2];
    $creditsToGraduate = $row[3];
    $status = $row[4];

    if($status== "Full Time"){
      $sql = "SELECT *
      FROM fulltimeundergradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $maxCourseLoad = $row[1];
    }
    else{
      $sql = "SELECT *
      FROM parttimeundergradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $maxCourseLoad = $row[1];
    }
  }
  else{
    $sql = "SELECT *
      FROM gradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $GPA = $row[1];
    $GPARequirement = $row[2];
    $gradProgram = $row[3];
    $bachelorsDegree = $row[4];
    $creditsToGraduate = $row[5];
    $status = $row[6];

    if($status== "Full Time"){
      $sql = "SELECT *
      FROM fulltimegradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $maxCourseLoad = $row[1];
    }
    else{
      $sql = "SELECT *
      FROM parttimegradStudent
      WHERE userID = $userID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    $maxCourseLoad = $row[1];
    }
    
  


  }
}
else if($userType = "Researcher"){
  $sql = "SELECT *
      FROM Researcher
      WHERE userID = $userID";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_row();

  $salary = $row[1];
}


        echo"
        <div>
            <form method='post' class='form' action='../scripts/updateAccount.php' onsubmit=\"return confirm('Are you sure you want to submit the form?')\">
                <input type = 'hidden' class = field value= '$userID' name='userID'>
                <label><b>First Name: </b></label>
                <input type='text' class='field' value = '$FName' name='FName'>

                <p><label><b>Middle Name: </b></label>
                <input type='text' class='field' value = '$MName' name='MName' ></p>
                
                <p><label><b>Last Name: </b></label>
                <input type='text' class='field' value = '$LName' name='LName' ></p>

                <p><label><b>Street: </b></label>
                <input type='text' class='field' name ='street' value = '$street' pattern='([a-zA-Z0-9\s]){1,100}' title='Please enter 1-100 alphanumeric characters' required></p>
                <p><label><b>City: </b></label>
                <input type='text' class='field' value = '$city' name='city' pattern='([a-zA-Z\s]){1,20}' title='Please enter 1-20 alphabetic characters' required></p>
                <p><label><b>State: </b></label>
                <input type='text' class='field' value = '$state' name='state' maxlength='2' pattern='[A-Z]{2}' title='Please enter 1-2 capital alphabetic characters' required></p>
                <p><label><b>Zip Code: </b></label>
                <input type='text' class='field'value = '$zipCode' name='zipCode' pattern='\d{5}' title='Please enter 5 digit US ZipCode' required></p>
                <p><label><b>Phone Number: </b></label>
                <input type='tel' id='phoneNumber' name='phoneNumber' value = '$phoneNum' pattern='[0-9]{10}' title='Please enter valid ###-###-#### phone number' required>
                <small>Format: 123-456-7890</small>
                
                
                <p><label><b>Gender</b></label>
                <select name='gender' id='gender'>";
                if($gender == "Male"){
                echo "<option value='Male' selected>Male</option>";
                echo "<option value='Female'>Female</option>";
                echo "<option value='Other'>Other</option>";
                }
                else if($gender == "Female"){
                    echo "<option value='Male'>Male</option>";
                    echo "<option value='Female' selected>Female</option>";
                    echo "<option value='Other'>Other</option>";
                    }
                else{
                    echo "<option value='Male'>Male</option>";
                    echo "<option value='Female'>Female</option>";
                    echo "<option value='Other' selected>Other</option>";
                }
                echo "
                </select>";

        if($userType == "Faculty"){

            echo "<p><label><b>Office ID: </b></label>
            <input type='text' class='field' value = $officeID name='officeID' pattern='\d{0,7}' title='Please enter a number 1-9999999' required></p>
            ";
            
            if($facultyType == "Full Time"){

              echo " 
                <p><label><b>Faculty Rank</b></label>
                <select name='facultyRank' id='facultyRank'>";

            if($facultyRank == "Associate Professor"){
                echo "<option value='Associate Professor' selected>Associate Professor</option>";
                echo "<option value='Professor'>Professor</option>";
                echo "<option value='Manager'>Manager</option>";
                echo "<option value='Head'>Head</option>";
                }
            else if($facultyRank == "Professor"){
                echo "<option value='Associate Professor' >Associate Professor</option>";
                echo "<option value='Professor' selected>Professor</option>";
                echo "<option value='Manager'>Manager</option>";
                echo "<option value='Head'>Head</option>";
                }
            else if($facultyRank == "Manager"){
                echo "<option value='Associate Professor' >Associate Professor</option>";
                echo "<option value='Professor'>Professor</option>";
                echo "<option value='Manager' selected>Manager</option>";
                echo "<option value='Head'>Head</option>";
                }
            else if($facultyRank == "Head"){
                echo "<option value='Associate Professor' >Associate Professor</option>";
                echo "<option value='Professor'>Professor</option>";
                echo "<option value='Manager'>Manager</option>";
                echo "<option value='Head' selected>Head</option>";
                }
                echo "
                </select>
                ";

            
              echo "<p><label><b>Salary: </b></label>
              <input type='text' class='field' value = $salary name='salary' pattern='\d{0,7}' title='Please enter a number 1-9999999' required></p>
              ";

            }
            else if($facultyType == "Part Time"){
              echo "<p><label><b>Wages: </b></label>
              <input type='text' class='field' value = $wages name='wages' pattern='\d{0,7}' title='Please enter a number 1-9999999' required></p>
              ";

            }
        }
        else if($userType == "Admin"){
          echo "<p><label><b>Salary: </b></label>
              <input type='text' class='field' value = '$salary' name='salary' pattern='\d{0,7}' title='Please enter a number 1-9999999' required></p>
              ";
          echo "<p><label><b>Privilege Level: </b></label>
              <input type='text' class='field' value = '$privilegeLevel' name='privilegeLevel' pattern='\d{0,7}' title='Please enter a number 1-9999999' required></p>
              ";
        }
        else if($userType == "Researcher"){
          echo "<p><label><b>Salary: </b></label>
              <input type='text' class='field' value = '$salary' name='salary' pattern='\d{0,7}' title='Please enter a number 1-9999999' required></p>
              ";
        }
        else if ($userType == "Student"){
          echo "<p><label><b>Start Year</b></label>
          <select name='startYear' id='startYear'>
              <option value='2021'>2021</option>
              <option value='2020'>2020</option>
              <option value='2019'>2019</option>
              <option value='2018'>2018</option>
              <option value='2017'>2017</option>
          </select></p>";

        }



        echo"
        <p><input type='submit' value='Submit'>
        <input type='button' onclick='sendRedirectForm(0)' value='Cancel'></p>
        </form>
        </div>
        <form action= '../scripts/redirect.php' method='post' id='redirectForm'>
        </form>";
    ?>
    </body>
</html>