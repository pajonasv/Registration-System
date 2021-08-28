<?php 
	$baseURL = "http://localhost:8080/Project";

	class User{
		public $username;
		public $type;

		public function __construct($username, $type){
			$this->username = $username;
			$this->type = $type;
		}
	}

	function connectToDB(){
		$DBservername = "00.000.00.000:0000";
		$DBusername = "username";
		$DBpassword = "password";
		$DBname = "nope";
		$conn = mysqli_connect($DBservername, $DBusername, $DBpassword, $DBname);

		// Check connection
		if (!$conn) {
			  die("Connection failed!: " . mysqli_connect_error());
		}
		return $conn;
	}

function setGPA($conn, $studentID){
		
$sql = "SELECT numOfCredits FROM student WHERE userID = $studentID";

$superResult = mysqli_query($conn, $sql);


while($superRow = $superResult->fetch_row()){
    
    $numOfCredits = $superRow[0];

    $sql = "SELECT grade From Enrollment WHERE studentID = $studentID && grade IS NOT NULL";
    $result = mysqli_query($conn, $sql);
    $gradePoints = 0;
    while($row = $result->fetch_row()){
        switch($row[0]){
            case "A":
                $gradePoints += 16;
                break;
            case "B":
                
                $gradePoints += 12;
                break;
            case "C":
                
                $gradePoints += 8;
                break;
            case "D":
                
                $gradePoints += 4;
                break;
            case "F":
                break;
            default:
                break;
            
        }
    }
   $GPA = $gradePoints/$numOfCredits;

   $sql = "UPDATE undergradstudent SET GPA = $GPA WHERE userID = $studentID";
   $result = mysqli_query($conn, $sql);
   $sql = "UPDATE gradstudent SET GPA = $GPA WHERE userID = $studentID";
   $result = mysqli_query($conn, $sql);

}


	}


    function getGPA($conn, $studentID, $semesterID){
		
        $sql = "SELECT numOfCredits FROM student WHERE userID = $studentID";
        
        $superResult = mysqli_query($conn, $sql);
        
        
        while($superRow = $superResult->fetch_row()){
            
            $numOfCredits = 0;
        
            $sql = "SELECT grade From Enrollment
            LEFT JOIN coursesection ON Enrollment.CRN = coursesection.CRN WHERE studentID = $studentID && grade IS NOT NULL && coursesection.semesterID = $semesterID";
            $result = mysqli_query($conn, $sql);
            $gradePoints = 0;
            while($row = $result->fetch_row()){
                
            $numOfCredits += 4;
                switch($row[0]){
                    case "A":
                        $gradePoints += 16;
                        break;
                    case "B":
                        
                        $gradePoints += 12;
                        break;
                    case "C":
                        
                        $gradePoints += 8;
                        break;
                    case "D":
                        
                        $gradePoints += 4;
                        break;
                    case "F":
                        break;
                    default:
                        break;
                    
                }
            }
           $GPA = $gradePoints/$numOfCredits;
        
           return $GPA;
        
        }
        
        
            }

?>