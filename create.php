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
    <h1>Add New Song Rating</h1>
    <!--to be updated-->
</body>
</html>