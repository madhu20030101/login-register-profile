<?php
$conn = new mysqli('localhost','root','','registration');

if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Get form data
                    $name=$_POST['username'];
                    $password=$_POST['password'];
                    $q="select * from reg where username='$name' and password='$password'";
                    $result = mysqli_query($conn, $q);
                    ?>
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link href="http://localhost/html/php-sql/css/profile.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <h1>User Profile</h1>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Course:</strong> <?php echo $row['course']; ?></p>
            <p><strong>Branch:</strong> <?php echo $row['branch']; ?></p>
            <p><strong>Number:</strong> <?php echo $row['num']; ?></p>
            <?php
        }
        ?>
        <button><a href="http://>Logout</a></button>
    </body>
    </html>
    <?php
}

$conn->close();
?>
                 
