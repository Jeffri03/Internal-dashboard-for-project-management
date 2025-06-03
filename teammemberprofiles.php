<?php
include("connect.php");

// Fetch all registered team members from the database
$result = $mysqli->query("SELECT * FROM taskmemberregister");

if ($result->num_rows > 0) {
    echo "<h1>Registered Team Members</h1>";
    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
          </tr>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['Number']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No registered team members found.</p>";
}
?>
