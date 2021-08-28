
<html>

<body>


<?php 

include '../../global.php';


if($_POST['userType'] == "undergradStudent"){

    header("Location: $baseURL/Admin/searchUsers/searchUnderGradStudent.php");
        }
else if($_POST['userType'] == "gradStudent"){

header("Location: $baseURL/Admin/searchUsers/searchGradStudent.php");
    }
else if($_POST['userType'] == "faculty"){

    header("Location: $baseURL/Admin/searchUsers/searchFaculty.php");
    }
else if($_POST['userType'] == "admin"){

    header("Location: $baseURL/Admin/searchUsers/searchAdmin.php");
    }
else if($_POST['userType'] == "researcher"){
        header("Location: $baseURL/Admin/searchUsers/searchResearcher.php");
        }
?>

</body>
</html>