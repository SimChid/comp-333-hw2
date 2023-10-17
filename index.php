<html>
<head></head>
<body>
    <h1> Welcome to StarTunes! </h1>
    <br /><h2> Login </h2>
    <p> Please enter your Username and Password </p>
    <?php
        session_start();
        require_once "config.php";

        if(isset($_REQUEST["submit"])){
            $out_value = "";
            $s_username = $_REQUEST["username"];
            $s_password = $_REQUEST["pass"];
            $hashpassword = password_hash($s_password,PASSWORD_DEFAULT);
            if(!empty($s_username) && !empty($s_password)){
                $sql_query = "SELECT * FROM users WHERE username = ?";
                $stmt = mysqli_prepare($conn,$sql_query);
                mysqli_stmt_bind_param($stmt,"s",$s_username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $arr = mysqli_fetch_assoc($result);
                $pass_check = $arr['password'];
                $num = mysqli_num_rows($result);
                if($num > 0 && password_verify($s_password, $pass_check)){
                    $out_value = "Login successful!";
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user'] = $s_username;
                    header("location: ratingsPage.php");
                    exit();
                }else{
                    $out_value = "Please try again";
                }
            }else{
                $out_value = "Please fill out both fields";
            }
            $conn->close();
        }
    ?>
    <form name = "form" method = "GET">
        <!--           ^ action = "verifyLogin.php"-->
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
    </p>
    <br /><p> Don't have an account? <a href = "sign-up.php"> Sign up here </a></p>
</body>
</html>
