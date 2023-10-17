<html>
<head></head>
<body>
    <?php
        session_start();
        if(! $_SESSION['logged_in']){
            header("location: index.php");
            exit();
        }
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "music_db";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $s_ID = $_REQUEST['songID']; // This works
        $out_value = $s_ID;
        $user = $_SESSION['user'] ;
        echo "You are logged in as $user";
        echo "<p><a href = index.php>Log Out</a></p>";

        if(isset($_REQUEST["submit"])){
            $sql = "DELETE FROM ratings WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "d", $s_ID);
            // Run the prepared statement.
            mysqli_stmt_execute($stmt);
            
            
            $conn->close();
            header("location: ratingsPage.php") ;
            exit() ;
        }
        

    ?>
    <h1>Delete Rating</h1>
    <p>Are you sure you want to delete this rating?</p>
    <form method="GET" action="">
    <input type="submit" name="submit" value="Yes"/>
    </form>
    <p><a href = ratingsPage.php> No </a></p>
    <p><?php if(!empty($out_value)){echo $out_value;}?></p>
</body>
</html>