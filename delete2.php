<html>
<head></head>
<body>
    <?php
        /* Make sure the user is actually signed in, giving a bit of information if
        so, redirecting otherwise */
        session_start();
        if(! $_SESSION['logged_in']){
            header("location: index.php");
            exit();
        }
        $user = $_SESSION['user'] ;
        echo "You are logged in as $user ";
        echo "<p><a href = index.php>Log Out</a></p>";
        
        // connect to localhost phpMyAdmin
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "music_db";

        $conn = new mysqli($servername, $username, $password, $dbname); 
        $s_ID = $_REQUEST['songID'];

        
        // Get the song that might be updated
        // Conditional triggered when the user submits the html form at the bottom of the page.
        if(isset($_REQUEST["submit"])){
            // Process the confirmation
            $out_value = "";
            $s_ID = $_REQUEST['songID'];
                
            // Parameterize and perform the query
            $sql = "DELETE FROM ratings WHERE id=?" ;
            $stmt2 = mysqli_prepare($conn,$sql) ;
            mysqli_stmt_bind_param($stmt2, "i", $s_ID);
            mysqli_stmt_execute($stmt2) ;

            // Redirect back to the ratings page
            header("location: ratingsPage.php") ;
            exit() ;
                    
        }
        
        $conn->close();

    ?>
    <!-- Form for user to input the desired change to their rating -->
    <h1>Delete Rating</h1>
    <p>Are you sure you want to delete this rating?</p>
    <form method="GET" action="">
    <input type="hidden" id="songID" name="songID" value= "<?php echo $s_ID ;?>"/>
    <input type="submit" name="submit" value="Yes"/>
        <p>
            <?php 
        if(!empty($out_value)){
        echo $out_value;
        }
        ?>
        </p>
    </form>
    <p><a href = ratingsPage.php>Cancel</a></p> 
</body>
</html>