<?php
session_start();
require '../db_connect.php';
if (!isset($_SESSION['admin_id'])) header("Location: login.php");

$admin_id = $_SESSION['admin_id'];
$complaint_id = isset($_GET['id'])? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $response_text = trim($_POST['response']);

    $stmt = $conn->prepare("UPDATE complaints SET status=?, updated_at=NOW() WHERE id=?");
    $stmt->bind_param("si", $status, $complaint_id);
    $stmt->execute();
    $stmt->close();

    $stmt2 = $conn->prepare("INSERT INTO responses (complaint_id, admin_id, response_text) VALUES (?, ?, ?)");
    $stmt2->bind_param("iis", $complaint_id, $admin_id, $response_text);
    $stmt2->execute();
    $stmt2->close();

    $success = "Updated and response saved.";
}

$stmt = $conn->prepare("SELECT c.*, u.name FROM complaints c JOIN users u ON c.user_id=u.id WHERE c.id=? LIMIT 1");
$stmt->bind_param("i",$complaint_id);
$stmt->execute();
$compl = $stmt->get_result()->fetch_assoc();
$stmt->close();

include '../header.php';
?>
<h2>Respond to Complaint #<?= htmlspecialchars($complaint_id) ?></h2>

<?php if (!$compl) { echo "<p>Complaint not found.</p></main></body></html>"; exit; } ?>

<p><strong>Student:</strong> <?= htmlspecialchars($compl['name']) ?> |
<strong>Category:</strong> <?= htmlspecialchars($compl['category']) ?></p>
<p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($compl['description'])) ?></p>

<?php if(!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>

<form method="POST">
  <label>Status</label>
  <select name="status">
    <option <?= $compl['status']==='Pending'?'selected':''; ?>>Pending</option>
    <option <?= $compl['status']==='In Progress'?'selected':''; ?>>In Progress</option>
    <option <?= $compl['status']==='Resolved'?'selected':''; ?>>Resolved</option>
  </select>
  <label>Response</label>
  <textarea name="response" rows="6" required></textarea>
  <button type="submit">Save Response & Update</button>
</form>

<p><a href="dashboard.php">← Back to dashboard</a></p>
<?php echo "</main></body></html>"; ?>
