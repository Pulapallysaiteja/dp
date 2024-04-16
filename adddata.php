<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "username"; // Change this to your MySQL username
$password = "password"; // Change this to your MySQL password
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    // You might want to handle file uploads differently, this is just a basic example
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $speciality = mysqli_real_escape_string($conn, $_POST['speciality']);

    // SQL query to insert data into the table
    $sql = "INSERT INTO add_data (name, description, location, image, speciality) VALUES ('$name', '$description', '$location', '$image', '$speciality')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Data Form</title>
</head>
<body>

<h2>Add Data</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name"><br><br>
    Description: <input type="text" name="description"><br><br>
    Location: <input type="text" name="location"><br><br>
    Image: <input type="text" name="image"><br><br>
    Speciality: <input type="text" name="speciality"><br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
