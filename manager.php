<!DOCTYPE html>
<html>
<head>
  <title>Manager Page - Reservation Information</title>
  <style>
    body {
  font-family: Arial, sans-serif;
}

h1 {
  color: #d25555;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #d25555;
  color: white;
}

.delete-btn {
  background-color: #d25555;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
}

.delete-btn:hover {
  background-color: #b43f3f;
}

  </style>
</head>
<body>
  <h1>Reservation Information</h1>
  
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Date</th>
      <th>Time</th>
      <th>Party Size</th>
      <th>Action</th>
    </tr>
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

      // Retrieve reservation information from the database
      $sql = "SELECT * FROM reservations";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Display each reservation as a table row
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["customer_name"] . "</td>";
          echo "<td>" . $row["email"] . "</td>";
          echo "<td>" . $row["phone"] . "</td>";
          echo "<td>" . $row["reservation_date"] . "</td>";
          echo "<td>" . $row["reservation_time"] . "</td>";
          echo "<td>" . $row["party_size"] . "</td>";
          echo "<td><button class='delete-btn' data-id='".$row["id"]."'>Delete</button></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='7'>No reservations found.</td></tr>";
      }

      $conn->close();
    ?>
  </table>

  <script>
      // Attach event listener to delete buttons
      var deleteButtons = document.getElementsByClassName("delete-btn");
      for (var i = 0; i < deleteButtons.length; i++) {
      deleteButtons[i].addEventListener("click", function() {
      var reservationId = this.getAttribute("data-id");
      deleteReservation(reservationId);
      });
      }

      // Function to delete a reservation
      function deleteReservation(id) {
      if (confirm("Are you sure you want to delete this reservation?")) {
      // Send an AJAX request to delete_reservation.php
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        location.reload(); // Refresh the page after deletion
      }
      };
      xhttp.open("POST", "delete_reservation.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("id=" + id); // Pass the id as a POST parameter
    }
  }
  </script>
  </body>
</html>

