
<html>

<body>


<?php 

include '../../global.php';


if($_POST['userType'] == "undergradStudent"){

    header("Location: $baseURL/Researcher/searchUsers/searchUnderGradStudent.php");
        }
else if($_POST['userType'] == "gradStudent"){

header("Location: $baseURL/Researcher/searchUsers/searchGradStudent.php");
    }
else if($_POST['userType'] == "faculty"){

    header("Location: $baseURL/Researcher/searchUsers/searchFaculty.php");
    }
else if($_POST['userType'] == "admin"){

    header("Location: $baseURL/Researcher/searchUsers/searchAdmin.php");
    }
else if($_POST['userType'] == "researcher"){
        header("Location: $baseURL/Researcher/searchUsers/searchResearcher.php");
        }
?>

</body>
</html>