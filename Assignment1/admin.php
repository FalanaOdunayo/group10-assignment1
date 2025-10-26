<h2>Admin Panel</h2>
<p>Manage and respond to student complaints below:</p>

<?php
include 'db.php';
$result = $conn->query("SELECT * FROM complaints");

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Category</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['category']}</td>
                <td>{$row['description']}</td>
                <td>{$row['status']}</td>
                <td><a href='respond.php?id={$row['id']}'>Respond</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No complaints found.</p>";
}
?>
