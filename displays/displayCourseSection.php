<!doctype html>
<?php 
    
    include '../global.php';
    if(!isset($_COOKIE['user']) || ($_COOKIE['userType'] != "Admin" && $_COOKIE['userType'] != "Faculty")){
        header("Location:  $baseURL/homepage/homepage.php"); 
          die();
      }
?>
<html lang="en">
  <head>

  <meta charset="utf-8">
  <link rel="stylesheet" href="display.css">
  <script type="text/javascript">
    function sendRedirectForm(value){
                  

      var submissionFrom = document.getElementById("redirectForm"); 

        submissionFrom.innerHTML = "<input type = \"hidden\" name = \"courseID\" value = "+ value +" />" +
        "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";

        submissionFrom.submit();
      }

      function sendGoToCourseForm(value){
        var submissionFrom = document.getElementById("gotoCourse"); 
              
        submissionFrom.innerHTML = "<input type = \"hidden\" name = \"courseID\" value = "+ value +" />" +
                  "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";
              
        submissionFrom.submit();
      }

      function sendGoToAttendance(ID, CRN){
        
        var submissionFrom = document.getElementById("studentList");

        submissionFrom.innerHTML = "<input type = \"hidden\" name = \"StudentID\" value = "+ ID +" />" +
                  "<input type = \"hidden\" name = \"CRN\" value = "+ CRN +" />" +
                    "<input type = \"hidden\" name = \"backPage\" value = \"homepage\" />";

        submissionFrom.submit();
      }       
  </script>

  </head>
  <body>
    <p><button type="submit" onclick="history.back()">Back</button>

    <form method="post" id="editGradeForm" class="form" action="../scripts/facultyEditGrade.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
    <?php 
        $CRN = $_POST['CRN'];
        
        $conn = connectToDB();
        $sql = "SELECT coursesection.*, user.FName, user.LName
                    FROM courseSection
                    LEFT JOIN user ON user.userID = coursesection.facultyID
                    WHERE CRN = $CRN";
        $result = mysqli_query($conn, $sql);
        //set variables here later

        if(!$result){
            echo "Something went wrong! $CRN";
        }

        $sql = "SELECT enrollment.studentID, user.FName, user.LName, enrollment.enrollDate, enrollment.grade from enrollment
                    LEFT JOIN user ON user.userID = enrollment.studentID
                    WHERE enrollment.CRN = $CRN";
        $result = mysqli_query($conn, $sql);


      echo "
        <table>
        <thead>
        <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Enroll Date</th>
        <th>Grade</th>
        <th>Select To Change Grade</th>
        </tr>
        </thead>
        <tbody>  
        ";

        while ($row = $result->fetch_row()) {
          echo "<tr>";
          if($row[3] >= '2021-01-01' && $row[3] <= '2021-06-01'){
            echo "<form method='post' id='studentList' action='../scripts/editAttendance.php'>
            <td><div class='phpHyperText' onclick=\"sendGoToAttendance($row[0], $CRN)\">$row[0]</div></td>
            </form>";
          }
          else
            echo "<td>$row[0]</td>";
          echo "<td>$row[1] $row[2]</td></form>";
          echo "<td>$row[3]</td>";
          echo "<td>$row[4]</td>";
          echo "<td width='11%' class='pldefault'>
                    <input type='radio' name='StudentID' value='$row[0]' id='StudentIDCheck' required>
                </td>";
        } 
        echo "
        </tbody>
        </table>
        ";

        echo "
        <table>
        <thead>
        <tr>
        <th>Change Grade</th>
        </tr>
        </thead>
        <tbody>  
        ";
        echo "<td style='height:100px; text-align:center'>
            <select name='CourseGrade' id='courseGrade'>
              <option value='A'>A</option>
              <option value='B'>B</option>
              <option value='C'>C</option>
              <option value='D'>D</option>
              <option value='F'>F</option>
            </select>
            </td>";
        echo "
        </tbody>
        </table>
        ";

        echo "<input type = 'hidden' name='CRN' value ='$CRN'>";
    ?>
      
      <p><input type="submit" value="Submit"></p>
    </form>
  </body>
</html>