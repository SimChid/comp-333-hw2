<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
  <title>Sign Up for StarTunes</title>
</head>

<body>
  <h1>Sign Up for StarTunes!</h1>
  <h2>Please fill out the form below to create your account</h2>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "music_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

    if(isset($_REQUEST["submit"])){
      $out_value = "";
      $s_username = $_REQUEST['username'];
      $s_p1 = $_REQUEST['p1'];
      $s_p2 = $_REQUEST['p2'];

      if ($s_p1 != $s_p2){
        $out_value = "Passwords must match";
      } else{
        if (strlen($s_p1) < 10){
          $out_value = "Passwords must have at least ten characters";
        } else {
          if(!empty($s_username) && !empty($s_p1) && !empty($s_p2)){
            $sql_query = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($conn,$sql_query) ;
            mysqli_stmt_bind_param($stmt, "s", $s_username);
            // Run the prepared statement.
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $num = mysqli_num_rows($result);
            if ($num > 0){$out_value = "Account with that username already exists, please enter a different username";}
            else {
              $sql = "INSERT INTO users (username, password) VALUES (?,?)";
              $stmt = mysqli_prepare($conn,$sql) ;
              mysqli_stmt_bind_param($stmt,"ss",$s_username,$s_p1) ;
              $result = mysqli_stmt_execute($stmt);
              if ($result == TRUE) {
                $out_value = "New record created successfully";
              } else {
                $out_value = "Error";
              }
              //session_start();
              // I think I want to redirect here 
            } 
          } else { $out_value = "Please fill all fields!";}
        }
      }
    }
    $conn->close();
  ?>

  <form method="GET" action="">
  Username: <input type="text" name="username" placeholder="Enter Username" /><br>
  Password: <input type="text" name="p1" placeholder="Enter Password" /><br>
  Confirm Password: <input type="text" name="p2" placeholder="Enter Password Again" /><br>
  <input type="submit" name="submit" value="Submit"/>

  <p><?php 
    if(!empty($out_value)){
      echo $out_value;
    }
  ?></p>
  </form>
</body>
</html>