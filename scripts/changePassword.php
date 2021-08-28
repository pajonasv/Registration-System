<doctype html>
<?php 
    include '../global.php';
    if(!isset($_COOKIE['user'])){
        header("Location:  $baseURL/homepage/homepage.php"); 
        die();
    }
?>
<html lang="en">
    <head>
        <title>Change Password</title>
    <head>
    <body>
        <?php
            $oldPass = "'" . $_POST['oldPassword'] . "'";
            $newPass = "'" . $_POST['newPassword'] . "'";
            $reNewPass = "'" .$_POST['reNewPassword'] . "'";

            $userID = $_COOKIE['userID'];

            $conn = connectToDB();

            //check if newPass = reNewPass.
            if(strcmp($newPass, $reNewPass) !=0){
                echo "new Pass and re enter pass do NOT match.";
                die();
            }

            //check if oldPassword matches the current password.
            //1. check if user has hashed password.
            $sql = "SELECT * FROM LoginInfo WHERE userID = $userID AND hashedPWord IS NULL ";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                //get the hashedPWord for the specified user.
                $sql = "SELECT hashedPWord FROM LoginInfo WHERE userId = $userID";
                $result = mysqli_query($conn, $sql);

                if($result->num_rows == 1){
                    $row = $result->fetch_row();
                    $hashedPWord = $row[0]; //store hashedPWord.
                }
                if(!password_verify($oldPass, $hashedPWord)){
                    echo "Your input for current Password is invalid.";
                    die();
                }
            }
            //2. user does not have hashedPWord so we work with pWord.
            else{
                $sql = "SELECT * FROM LoginInfo WHERE userId = $userID AND pWord = $oldPass";
                $result = mysqli_query($conn, $sql);
                if($result->num_rows ==0){
                    echo "Your input for current Password is invalid.";
                    die();
                }
            }
            $hashedPWord = password_hash($newPass, PASSWORD_BCRYPT); //hash the new password
            //store the hashed pass in the logininfo table.
            $sql = "UPDATE LoginInfo
                    SET hashedPWord = '$hashedPWord'
                    WHERE userID = $userID"; 
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "Password changed Successfully!";
            }
            else{
                echo "Something went wrong.";
            }
            die();
        ?>
    </body>
</html>