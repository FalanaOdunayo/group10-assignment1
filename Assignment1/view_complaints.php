<?php
session_start();
require 'db_connect.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];

// Filters via GET: ?status=Pending&category=Hostel%20Issue
$status = isset($_GET['status']) ? $_GET['status'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Build query safely
$query = "SELECT c.*, u.name FROM complaints c JOIN users u ON c.user_id = u.id WHERE c.user_id = ?";
$params = [$user_id];
$types = "i";

if ($status !== '') { $query .= " AND c.status = ?"; $types .= "s"; $params[] = $status; }
if ($category !== '') { $query .= " AND c.category = ?"; $types .= "s"; $params[] = $category; }

$query .= " ORDER BY c.created_at DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$categories = ['','Hostel Issue','Academic','IT Services','Facilities','Discipline','Other'];

include 'header.php';
?>
<h2>My Complaints (GET filters)</h2>

<form method="GET">
  <label>Filter by status:</label>
  <select name="status">
    <option value="">All</option>
    <option <?= $status==='Pending'?'selected':''; ?>>Pending</option>
    <option <?= $status==='In Progress'?'selected':''; ?>>In Progress</option>
    <option <?= $status==='Resolved'?'selected':''; ?>>Resolved</option>
  </select>

  <label>Filter by category:</label>
  <select name="category">
    <?php foreach($categories as $c) echo "<option value=\"{$c}\" ".($category===$c?"selected":"").">".($c===''?'All':$c)."</option>"; ?>
  </select>

  <button type="submit">Apply (GET)</button>
</form>

<table>
  <tr><th>ID</th><th>Category</th><th>Description</th><th>Status</th><th>Submitted</th></tr>
  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['id']) ?></td>
      <td><?= htmlspecialchars($row['category']) ?></td>
      <td style="text-align:left;"><?= nl2br(htmlspecialchars($row['description'])) ?></td>
      <td><?= htmlspecialchars($row['status']) ?></td>
      <td><?= htmlspecialchars($row['created_at']) ?></td>
    </tr>
  <?php endwhile; ?>
</table>

<?php echo "</main></body></html>"; ?>
