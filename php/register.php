<?php

$conn = new mysqli('localhost', 'root', '', 'registration');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $course = $_POST['course'];
    $branch = $_POST['branch'];
    $num = $_POST['rollno'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Use prepared statements to prevent SQL injection
    $q = $conn->prepare("INSERT INTO reg (username, email, course, branch, num, password) VALUES (?, ?, ?, ?, ?, ?)");
    $q->bind_param("ssssss", $name, $email, $course, $branch, $num, $password);
    $q->execute();

    // Select the user's data
    $query = "SELECT * FROM reg WHERE username='$name'";
    $result = mysqli_query($conn, $query);

    // Display the user profile information
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
        <button><a href="http://localhost/html/php-sql/register.html">Logout</a></button>
    </body>
    </html>
    <?php
}

// Close the database connection
$conn->close();
?>
