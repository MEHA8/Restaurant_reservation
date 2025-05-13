<?php
$servername = "localhost";
$username = "root";  // default username for XAMPP
$password = "";      // no password by default
$dbname = "restaurant_db"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling reservation data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $num_people = $_POST['num_people'];

    // Insert reservation into database
    $sql_reservation = "INSERT INTO reservations (name, email, reservation_date, reservation_time, num_people)
                        VALUES ('$name', '$email', '$reservation_date', '$reservation_time', '$num_people')";

    if ($conn->query($sql_reservation) === TRUE) {
        // Get the reservation ID (auto-incremented)
        $reservation_id = $conn->insert_id;

        // Handle menu item selection
        if (isset($_POST['menu_items'])) {
            foreach ($_POST['menu_items'] as $menu_item_id) {
                // Insert selected menu items into reservation_menu table
                $sql_menu = "INSERT INTO reservation_menu (reservation_id, menu_item_id)
                             VALUES ('$reservation_id', '$menu_item_id')";
                $conn->query($sql_menu);
            }
        }

        echo "Reservation successful!";
    } else {
        echo "Error: " . $sql_reservation . "<br>" . $conn->error;
    }
}

$conn->close();
?>
