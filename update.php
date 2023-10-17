<html>
<head></head>
<body>
    <?php
        session_start();
        if(! $_SESSION['logged_in']){
            header("location: index.php");
            exit();
        }
        $user = $_SESSION['user'] ;
        echo "You are logged in as $user ";
        echo "<p><a href = index.php>Log Out</a></p>";

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "music_db";

        $conn = new mysqli($servername, $username, $password, $dbname); 
        $s_ID = $_REQUEST['songID'];

        
        // Get the song the might be updated
        $query = "SELECT * FROM ratings WHERE id = ?" ;
        $stmt = mysqli_prepare($conn, $query) ;
        mysqli_stmt_bind_param($stmt, "i", $s_ID) ;
        mysqli_stmt_execute($stmt) ;
        mysqli_stmt_bind_result($stmt, $s_id, $s_username,$s_artist,$s_song,$s_rating);
        mysqli_stmt_fetch($stmt) ;
        
        if(isset($_REQUEST["submit"])){
            $conn = new mysqli($servername, $username, $password, $dbname);
            $out_value = "";
            $s_Artist = $_REQUEST['artist'] ;
            $s_Song = $_REQUEST['song'] ;
            $s_Rating = $_REQUEST['rating'] ;
            $s_ID = $_REQUEST['songID'];
            
            
            // You must fill all fields
            if (!empty($s_Artist) && !empty($s_Song) && !empty($s_Rating)){
                
                // Rating field must be one digit between one and five (inclusive)
                if (strlen($s_Rating) == 1 && is_numeric($s_Rating) && $s_Rating < 6 && $s_Rating > 0){
                    
                    // We're good to update
                    $sql_query = "UPDATE ratings SET artist = ?, song = ?, rating = ? where id = ?" ;
                    $stmt = mysqli_prepare($conn, $sql_query) ;
                    
                    mysqli_stmt_bind_param($stmt, "ssdd", $s_Artist, $s_Song, $s_Rating, $s_ID) ;
                    $result = mysqli_stmt_execute($stmt) ;
                    
                    // If the rating worked, go back to the page where the ratings are displayed
                    if ($result){
                        header("location: ratingsPage.php") ;
                        exit() ;
                    } else {
                        $out_value = "Please try that again. Something went wrong" ;
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
    <h1>Update a Song Rating</h1>
    <form method="GET" action="">
    Artist: <input type="text" name="artist" placeholder="Artist" value = "<?php echo $s_artist ; ?>" /><br>
    Song: <input type="text" name="song" placeholder="Song" value = "<?php echo $s_song ;?>" /><br>
    Rating: <input type="text" name="rating" placeholder="Rating" value = "<?php echo $s_rating ;?>" /><br>
    <input type="hidden" id="songID" name="songID" value= "<?php echo $s_ID ;?>"/>
    <input type="submit" name="submit" value="submit"/>
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