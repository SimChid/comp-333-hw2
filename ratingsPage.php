<html>
<head></head>
<body>
    <?php 
        session_start();
        echo('PHPSESSID: ' . session_id($_GET['session_id']));
    ?>
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
            
        </tbody>
    </table>
</body>
</html>