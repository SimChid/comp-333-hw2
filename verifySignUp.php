<?php
    //include 'dbconnection.php';
    $userid = $_POST['username'];
    $p1 = $_POST['password'];
    $p2 = $_POST['confirm'] ;
    
    if ($p1 == $p2){
        $sql = "SELECT * FROM users WHERE username = '$userid'";
        $result = mysqli_query($db, $sql) or die(mysqli_error($db));
        $num = mysqli_fetch_array($result);

        if($num > 0) {
            echo "Try a different username";
        }
        else {
            echo "I need to figure out how to add to SQL";
        }
    } else {
        echo "Passwords must match!" ;
        <div id="form">
            <form name="form" action="sign-up.php" method="POST">
                <p>
                <input type="submit" id="button" value="Try Again" />
                </p>
            </form>
        </div>
    }
    
?>