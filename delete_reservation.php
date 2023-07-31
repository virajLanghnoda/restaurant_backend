<?php
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

// Retrieve reservation id from the POST request
$id = $_POST["id"];

// Prepare and execute SQL query to delete the reservation
$sql = "DELETE FROM reservations WHERE id = $id";

if ($conn->query($sql) === TRUE) {
  echo "Reservation deleted successfully.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
