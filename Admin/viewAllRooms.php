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
        <title>View all Rooms</title>
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
        <h2>Offices</h2>
        <?php

        $conn = connectToDB();
        $sql = "select room.* from officeroom
        LEFT JOIN room on room.roomID = officeroom.roomID";
    
            
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
    
        echo "
            <table>
            <thead>
            <tr>
                
                <th>Room ID</th>
                <th>Building</th>
                <th>Room Number</th>
            </tr>
            </thead>
            <tbody>
            ";
            while ($row = $result->fetch_row()) {
                echo "<tr>";
                        
                echo "<td>$row[0]";
                echo "<td>$row[1]</td>";
                 echo "<td>$row[2]</td>";
                echo "</tr>";
            } 
            echo "
            </tbody>
            </table>
            ";
        }
        ?>

        <h2>Lecture Rooms</h2>
        <?php

        $conn = connectToDB();
        $sql = "select room.* from lectureroom
        LEFT JOIN room on room.roomID = lectureroom.roomID";
    
            
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
    
        echo "
            <table>
            <thead>
            <tr>
                
                <th>Room ID</th>
                <th>Building</th>
                <th>Room Number</th>
            </tr>
            </thead>
            <tbody>
            ";
            while ($row = $result->fetch_row()) {
                echo "<tr>";
                        
                echo "<td>$row[0]";
                echo "<td>$row[1]</td>";
                 echo "<td>$row[2]</td>";
                echo "</tr>";
            } 
            echo "
            </tbody>
            </table>
            ";
        }
        ?>
        
        <h2>Lab Rooms</h2>
        
        <?php

        $conn = connectToDB();
        $sql = "select room.* from lectureroom
        LEFT JOIN room on room.roomID = lectureroom.roomID";
    
            
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
    
        echo "
            <table>
            <thead>
            <tr>
                
                <th>Room ID</th>
                <th>Building</th>
                <th>Room Number</th>
            </tr>
            </thead>
            <tbody>
            ";
            while ($row = $result->fetch_row()) {
                echo "<tr>";
                        
                echo "<td>$row[0]";
                echo "<td>$row[1]</td>";
                 echo "<td>$row[2]</td>";
                echo "</tr>";
            } 
            echo "
            </tbody>
            </table>
            ";
        }
        ?>

        <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form>
    </body>
</html>