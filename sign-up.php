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
        if(!empty($s_username) && !empty($s_p1) && !empty($s_p2)){
          $sql_query = "SELECT * FROM users WHERE username = ('$s_username')";

          $result = mysqli_query($conn, $sql_query);

          $row = mysqli_fetch_assoc($result);
          if ($row != NULL){
            $out_value = "Account with that username already exists, please enter a different username";
          } else {
            $sql = "INSERT INTO users (username, password) VALUES ('$s_username', '$s_p1')";
            if ($conn->query($sql) === TRUE) {
              $out_value = "New record created successfully";
            } else {
              $out_value = "Error: " . $sql . "<br>" . $conn->error;
            }
            session_start();
            // I think I want to redirect here.
            
          }
          
        }
        else {
          $out_value = "Please fill all fields!";
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