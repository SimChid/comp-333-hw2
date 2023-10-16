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
    <h1>Delete Rating</h1>
    <p>Are you sure you want to delete this rating?</p>
    <p><a href = ratingsPage.php> No </a></p>
</body>
</html>