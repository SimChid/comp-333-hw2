<html>
<head></head>
<body>
    <?php 
        /* Make sure the user is actually signed in, giving a bit of information if
        so, redirecting otherwise */
        session_start();
        if(! $_SESSION['logged_in']){
            header("location: index.php");
            exit();
        }
        // connect to localhost phpMyAdmin
        include "dbconnection.php";
        require_once "config.php";
        $user = $_SESSION['user'];
    ?>
    <p>You are now logged in as <?php echo $user ?></p>
    <p><a href = "index.php">Log Out</a></p>
    <h1> StarTunes Catalogue </h1>
    <p><a href = "create.php">Add New Song Rating</a></p>
    <table>
        <tbody>
            <tr> <!-- Set up the table -->
            <th>ID</th> <th>Username</th> <th>Artist</th> <th>Song</th><th>Rating</th><th>Action</th></tr>
    <?php
        //Please note that ChatGPT was used to fix the table code because it wasn't working initially
        //https://chat.openai.com/share/12ab7911-c122-4bdd-8e16-9781239dd62f

        // Fetch the maximum ID first
        $maxIdResult = mysqli_query($db, "SELECT MAX(id) AS max_id FROM ratings");
        $maxId = mysqli_fetch_assoc($maxIdResult)['max_id'];
        // Build the table row by row
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
                    echo "<td><a href='view.php?songID=$i'>View</a> <a href='update.php?songID=$i'>Update</a> <a href='delete2.php?songID=$i'>Delete</a></td>";
                } else {
                    echo "<td><a href='view.php?songID=$i'>View</a></td>";
                }
                echo "</tr>";
            }
        }
    ?>
    </tbody>
    </table>
</body>
</html>
