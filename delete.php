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
        $s_ID = $_REQUEST['songID'];
        /* 
        When I manually set $s_ID to the correct index, the delete works. However, when I 
        assign it to $_REQUEST['songID'] it does not. This is perplexing because when I echo 
        $s_ID after assigning, it displays the proper index. 
        
        Moreover, when I check the type I get that $s_ID is a string. I tried s,d, and i as parameters 
        for mysqli_stmt_bind_param and none delete. I then tried the function intval() to convert it
        to an integer, and for s,d, and i it still does not delete.
        
        */
        $out_value = $s_ID;
        $user = $_SESSION['user'] ;
        echo "You are logged in as $user";
        echo "<p><a href = index.php>Log Out</a></p>";

        if(isset($_REQUEST["submit"])){
            $sql = "DELETE FROM ratings WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            echo "got here" ;
            mysqli_stmt_bind_param($stmt, "s", $s_ID);
            echo "got here2" ;
            // Run the prepared statement.
            mysqli_stmt_execute($stmt);
            
            header("location: ratingsPage.php") ;
            exit() ;
        }
        
        $conn->close();
    ?>
    <h1>Delete Rating</h1>
    <p>Are you sure you want to delete this rating?</p>
    <form method="GET" action="">
    <input type="submit" name="submit" value="Yes"/>
    </form>
    <p><a href = ratingsPage.php> No </a></p>
    <p>
        <?php if(!empty($out_value)){
        echo $out_value;
        echo gettype($out_value) ;
        }?>
    </p>
</body>
</html>