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

            if(!empty($s_username) && !empty($s_password)){
                $sql_query = "SELECT * FROM users WHERE username = ('$s_username') AND password = ('$s_password')";
                $result = mysqli_query($conn,$sql_query);
                $num = mysqli_num_rows($result);
                if($num > 0){
                    $out_value = "Login successful!";
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
