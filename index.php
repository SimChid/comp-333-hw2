<html>
<head></head>
<body>
    <h1> Welcome to StarTunes! </h1>
    <br /><h2> Login </h2>
    <p> Please enter your Username and Password </p>
    <?php
        session_start();
        require_once "config.php";
        // Conditional triggered when the user submits the html form at the bottom of the page.
        if(isset($_REQUEST["submit"])){
            // Process the input from the form
            $out_value = "";
            $s_username = $_REQUEST["username"];
            $s_password = $_REQUEST["pass"];
            $hashpassword = password_hash($s_password,PASSWORD_DEFAULT);
            // Guard checks that both fields are filled
            if(!empty($s_username) && !empty($s_password)){
                $sql_query = "SELECT * FROM users WHERE username = ?";
                $stmt = mysqli_prepare($conn,$sql_query);
                mysqli_stmt_bind_param($stmt,"s",$s_username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $arr = mysqli_fetch_assoc($result);
                $pass_check = $arr['password'];
                $num = mysqli_num_rows($result);
                // Guard checks that the username exists and the passwords match
                if($num > 0 && password_verify($s_password, $pass_check)){
                    // Log in and redirect to ratings page
                    $out_value = "Login successful!";
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user'] = $s_username;
                    header("location: ratingsPage.php");
                    exit();
                }else{
                    // Inform the user that one (or possibly both) of the fields are incorrect
                    $out_value = "Please try again";
                }
            }else{
                $out_value = "Please fill out both fields";
            }
            $conn->close();
        }
    ?>
    <!-- The form the user submits to log in-->
    <form name = "form" method = "GET">
        
        <p>
            <label> Username </label>
            <input type = "text" name = "username" placeholder = "Enter username">
        </p>
        <p>
            <label> Password </label>
            <input type = "text" name = "pass" placeholder = "Enter password">
        </p>
        <p><input type  = "submit" name = "submit" value = "Login"></p>
    </form>
    <p>
        <?php if (!empty($out_value)){echo $out_value;}?>
    </p> <!-- The link below allows users without an account to sign up -->
    <br /><p> Don't have an account? <a href = "sign-up.php"> Sign up here </a></p>
</body>
</html>
