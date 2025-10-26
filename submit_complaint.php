<?php
session_start();
require 'db_connect.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$categories = ['Hostel Issue','Academic','IT Services','Facilities','Discipline','Other'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);

    $stmt = $conn->prepare("INSERT INTO complaints (user_id,category,description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $category, $description);
    if ($stmt->execute()) {
        $success = "Complaint submitted successfully.";
    } else {
        $error = "Failed to submit: " . $stmt->error;
    }
    $stmt->close();
}

include 'header.php';

?>
<h2>Submit Complaint</h2>
<?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
<form method="POST">
  <label>Category</label>
  <select name="category" required>
    <?php foreach($categories as $c) echo "<option value=\"$c\">$c</option>"; ?>
  </select>
  <label>Description</label>
  <textarea name="description" rows="6" required></textarea>
  <button type="submit">Submit (POST)</button>
</form>

<p><a href="view_complaints.php">View my complaints</a> | <a href="logout.php">Logout</a></p>
<?php echo "</main></body></html>"; ?>