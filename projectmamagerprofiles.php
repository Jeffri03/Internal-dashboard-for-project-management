<?php
include("connect.php");

// Fetch all registered project managers from the database
$result = $mysqli->query("SELECT * FROM projectmanagerregister");

if ($result->num_rows > 0) {
    echo "<h1>Registered Project Managers</h1>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
          </tr>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['number']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No registered project managers found.</p>";
}
?>
