<?php
// Connect to your database
$servername = "localhost";
$username = "root"; // default user for XAMPP is 'root'
$password = "";     // no password by default
$dbname = "restaurant_db"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$date = $_POST['reservation_date'];
$time = $_POST['reservation_time'];
$people = $_POST['num_people'];

// Insert into reservation table
$sql = "INSERT INTO reservations (name, email, reservation_date, reservation_time, num_people) 
        VALUES ('$name', '$email', '$date', '$time', '$people')";

if ($conn->query($sql) === TRUE) {
    // Redirect to the success page if insert is successful
    header("Location: success.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
