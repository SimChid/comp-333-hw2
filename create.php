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
        if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
        // Conditional triggered when the user submits the html form at the bottom of the page.
        if(isset($_REQUEST["submit"])){
            // Process the input from the form
            $out_value = "";
            $s_Artist = $_REQUEST['artist'] ;
            $s_Song = $_REQUEST['song'] ;
            $s_Rating = $_REQUEST['rating'] ;
            
            // You must fill all fields
            if (!empty($s_Artist) && !empty($s_Song) && !empty($s_Rating)){
                // Rating field must be one digit between one and five (inclusive)
                if (strlen($s_Rating) == 1 && is_numeric($s_Rating) && $s_Rating < 6 && $s_Rating > 0){
                    $sql_query = "SELECT * FROM ratings where song = ? AND username = ?" ;
                    
                    $stmt = mysqli_prepare($conn, $sql_query) ;
                    mysqli_stmt_bind_param($stmt, "ss", $s_Song, $user) ;
                    mysqli_stmt_execute($stmt) ;
                    $result = mysqli_stmt_get_result($stmt) ;
                    $num = mysqli_num_rows($result) ;
                    // User cannot rate the same song twice
                    if ($num > 0){
                        $out_value = "Cannot rate the same song twice" ;
                    } else {
                        // We're good to insert the rating
                        $sql_query = "INSERT INTO ratings (username, artist, song, rating) VALUES (?, ?, ?, ?)" ;
                        $stmt = mysqli_prepare($conn, $sql_query) ;
                        mysqli_stmt_bind_param($stmt, "sssi", $user,$s_Artist, $s_Song, $s_Rating) ;
                        $result = mysqli_stmt_execute($stmt) ;
                        // If the rating worked, go back to the page where the ratings are displayed
                        if ($result){header("location: ratingsPage.php") ; exit() ;
                        } else {$out_value = "Please try that again. Something went wrong" ;}
                    }
                } else {
                    $out_value = "Rating must be a digit in the range 1 through 5" ;
                }
            } else {
                $out_value = "All fields must be filled" ;
            }
        }
        $conn->close();
    ?>
    <!-- The form the user fills out to create a new rating -->
    <h1>Add New Song Rating</h1>
    <p> Username:  <?php echo "$user" ; ?></p>
    <form method="GET" action="">
        Artist: <input type="text" name="artist" placeholder="Artist" /><br>
        Song: <input type="text" name="song" placeholder="Song" /><br>
        Rating: <input type="text" name="rating" placeholder="Rating" /><br>
        <input type="submit" name="submit" value="Post!"/>
        <p><?php if(!empty($out_value)){echo $out_value;}?></p>
    </form>
</body>
</html>