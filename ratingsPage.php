<html>
<head></head>
<body>
    <?php 
        session_start();
        if(! $_SESSION['logged_in']){
            header("location: index.php");
            exit();
        }else{
            $user = $_SESSION['user'];
            $sql_query = "SELECT * FROM ratings";

        }
       
    ?>
    <p>You are now logged in as <?php echo $user ?></p>
    <p><a href = "index.php">Log Out</a></p>
    <h1> StarTunes Catalogue </h1>
    <p><a href = "create.php">Add New Song Rating</a></p>
    <table>
        <tbody>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Artist</th>
                <th>Song</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
            
            <?php
            //This will crash the site, don't do anything with this yet!!
            //Run this when you can connect to db
                // for($i = 1; $i <= "SELECT MAX(id) FROM ratings"; $i = $i+1){
                //     $row = "SELECT * FROM ratings WHERE id = $i";
                //     if(!empty($row)){
                //         $id = "SELECT id FROM $row";
                //         $username = "SELECT username FROM $row";
                //         $artist = "SELECT artist FROM $row";
                //         $song = "SELECT song FROM $row";
                //         $rating = "SELECT rating FROM $row";
                //         $action = "<a href = view.php>View</a>";
                //         echo "
                //             <tr>
                //                 <th>$id</th>
                //                 <th>$username</th>
                //                 <th>$artist</th>
                //                 <th>$song</th>
                //                 <th>$rating</th>
                //                 <th>$action</th>
                //             </tr>";
                //     }
                // }
            ?>
        </tbody>
    </table>
</body>
</html>