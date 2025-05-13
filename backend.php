<?php
$conn = new mysqli('localhost', 'root', '', 'restaurant_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$date = $_POST['reservation_date'];
$time = $_POST['reservation_time'];
$num_people = $_POST['num_people'];
$menu_items = $_POST['menu_items'] ?? [];

$res_sql = "INSERT INTO reservations (name, email, reservation_date, reservation_time, num_people)
            VALUES ('$name', '$email', '$date', '$time', $num_people)";
if ($conn->query($res_sql) === TRUE) {
    $reservation_id = $conn->insert_id;

    foreach ($menu_items as $item_id) {
        $conn->query("INSERT INTO reservation_menu (reservation_id, menu_item_id) VALUES ($reservation_id, $item_id)");
    }

    header("Location: success.html");
    exit();
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
