<html>
<head></head>
<body>
    <?php
        session_start();
        if(! $_SESSION['logged_in']){
            header("location: index.php");
            exit();
        }

        echo "You are logged in as user $user";
        echo "<p><a href = index.php>Log Out</a></p>";
    ?>
    <h1>View Rating</h1>
    <p>Username</p>
    <p>Artist</p>
    <p>Song</p>
    <p>Rating</p>
    <p><a href = "ratingsPage.php">Back</a></p>
</body>
</html>