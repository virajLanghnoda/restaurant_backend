<?php
// Assuming you have a MySQL database set up
try
{
    $servername="";
    $username="id20886243_hotel";
    $psd="&>|>H<vZ7SbBe<~5";
    $dbname="id20886243_reservation";
    
    $conn = new mysqli($servername,$username,$psd,$dbname);
    
    $conn->query("USE id20886243_reservation");
}
catch(PDOException $e)
{
    die("Error : ".$e->getMessage());
}

// Retrieve form data
$customerName = $_POST["customerName"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$date = $_POST["date"];
$time = $_POST["time"];
$partySize = $_POST["partySize"];

// Prepare and execute SQL query to insert the reservation data into the database
$sql = "INSERT INTO reservations (customer_name, email, phone, reservation_date, reservation_time, party_size) 
        VALUES ('$customerName', '$email', '$phone', '$date', '$time', $partySize)";
$result=$conn->query($sql);
if ($result === TRUE) {
  echo "Reservation stored successfully.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
