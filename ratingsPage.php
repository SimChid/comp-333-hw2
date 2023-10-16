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
        //Please note that ChatGPT was used to fix the table code because it wasn't working initially
        //https://chat.openai.com/share/12ab7911-c122-4bdd-8e16-9781239dd62f
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

        // Fetch the maximum ID first
        $maxIdResult = mysqli_query($db, "SELECT MAX(id) AS max_id FROM ratings");
        $maxId = mysqli_fetch_assoc($maxIdResult)['max_id'];

        for ($i = 1; $i <= $maxId; $i++) {
            $row = mysqli_query($db, "SELECT * FROM ratings WHERE id = $i");
            $rating = mysqli_fetch_assoc($row);
            $num = mysqli_num_rows($row);

            if ($num > 0) {
                echo "<tr>";
                echo "<td>" . $rating['id'] . "</td>";
                echo "<td>" . $rating['username'] . "</td>";
                echo "<td>" . $rating['artist'] . "</td>";
                echo "<td>" . $rating['song'] . "</td>";
                echo "<td>" . $rating['rating'] . "</td>";
                if ($user == $rating['username']) {
                    echo "<td><a href='view.php'>View</a> <a href='update.php'>Update</a> <a href='delete.php'>Delete</a></td>";
                } else {
                    echo "<td><a href='view.php'>view</a></td>";
                }
                echo "</tr>";
            }
        }

        echo "</tbody>";
        echo "</table>";
    ?>
</body>
</html>
