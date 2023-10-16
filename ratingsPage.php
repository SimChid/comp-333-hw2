<html>
<head></head>
<body>
    <?php 
        session_start();
        if(! $_SESSION['logged_in']){
            header("location: index.php");
            exit();
        }
        include "dbconnection.php";
        require_once "config.php";
        $user = $_SESSION['user'];
        // $result = mysquli_query($conn,$sql_query);
    ?>
    <p>You are now logged in as <?php echo $user ?></p>
    <p><a href = "index.php">Log Out</a></p>
    <h1> StarTunes Catalogue </h1>
    <p><a href = "create.php">Add New Song Rating</a></p>
    <?php
    echo "<table>";
        echo "<tbody>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Username</th>";
                echo "<th>Artist</th>";
                echo "<th>Song</th>";
                echo "<th>Rating</th>";
                echo "<th>Action</th>";
            echo "</tr>";
            for($i = 1; $i <= "SELECT MAX(id) FROM ratings"; $i = $i+1){
                $row = "SELECT * FROM ratings WHERE id = $i";
                $result = mysqli_query($db,$row);
                $rating = mysqli_fetch_array($result);
                $num = mysqli_num_rows($rating);
                echo "<tr> <td>abc</td> </tr>";
                if($num > 0){
                    echo "<tr>";
                        echo "<td> . $rating['id'] . </td>";
                        echo "<td> . $rating['username'] . </td>";
                        echo "<td> . $rating['artist'] . </td>";
                        echo "<td> . $rating['song'] . </td>";
                        echo "<td> . $rating['rating'] . </td>";
                        if($user = $rating['username']){
                            echo "<td><a href = 'view.php'>view</a><a href = 'update.php'>update</a><a href = 'delete.php'>delete</a></td>"
                        }else{
                            echo "<td><a href = 'view.php'>view</a></td>";
                        }
                    echo "</tr>";
                }
            }
        echo "</tbody>";
    echo "</table>";
    ?>
</body>
</html>