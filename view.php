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
        $user = $_SESSION['user'];
        echo "You are logged in as $user";
        echo "<p><a href = index.php>Log Out</a></p>";
        
        // connect to localhost phpMyAdmin
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "music_db";
        $conn = new mysqli($servername, $username, $password, $dbname); 
        $s_ID = $_REQUEST['songID'];
        
        // Get the song the user wants to view (via parameterized SQL query)
        $query = "SELECT * FROM ratings WHERE id = ?" ;
        $stmt = mysqli_prepare($conn, $query) ;
        
        mysqli_stmt_bind_param($stmt, "d", $s_ID) ;
        mysqli_stmt_execute($stmt) ;
        mysqli_stmt_bind_result($stmt, $s_id, $s_username,$s_artist,$s_song,$s_rating);
        mysqli_stmt_fetch($stmt) ;
    ?>
    <!-- Displays the information on the song -->
    <h1>View Rating</h1>
    <p> User:  <?php echo "$s_username" ; ?></p>
    <p>Artist: <?php echo "$s_artist" ; ?></p>
    <p>Song: <?php echo "$s_song" ; ?></p>
    <p>Rating: <?php echo "$s_rating" ; ?></p>
    <p><a href = "ratingsPage.php">Back</a></p>
</body>
</html>