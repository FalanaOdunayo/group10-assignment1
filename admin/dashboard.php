<?php
session_start();
require '../db_connect.php';
if (!isset($_SESSION['admin_id'])) header("Location: login.php");

// Filters via GET for admin
$status = isset($_GET['status']) ? $_GET['status'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Build query
$query = "SELECT c.*, u.name FROM complaints c JOIN users u ON c.user_id = u.id WHERE 1=1";
$params = [];
$types = "";

if ($status !== '') { $query .= " AND c.status = ?"; $types .= "s"; $params[] = $status; }
if ($category !== '') { $query .= " AND c.category = ?"; $types .= "s"; $params[] = $category; }

$query .= " ORDER BY c.created_at DESC";
$stmt = $conn->prepare($query);
if ($types !== "") $stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$categories = ['','Hostel Issue','Academic','IT Services','Facilities','Discipline','Other'];

include '../header.php';
?>
<h2>Admin Dashboard</h2>

<p>Welcome, <?= htmlspecialchars($_SESSION['admin_name']) ?> | <a href="export_csv.php?status=<?= urlencode($status) ?>&category=<?= urlencode($category) ?>">Export CSV</a> | <a href="../logout.php">Logout</a></p>

<form method="GET">
  <label>Status</label>
  <select name="status">
    <option value="">All</option>
    <option <?= $status==='Pending'?'selected':''; ?>>Pending</option>
    <option <?= $status==='In Progress'?'selected':''; ?>>In Progress</option>
    <option <?= $status==='Resolved'?'selected':''; ?>>Resolved</option>
  </select>

  <label>Category</label>
  <select name="category">
    <?php foreach($categories as $c) echo "<option value=\"{$c}\" ".($category===$c?"selected":"").">".($c===''?'All':$c)."</option>"; ?>
  </select>

  <button type="submit">Filter</button>
</form>

<table>
  <tr><th>ID</th><th>Student</th><th>Category</th><th>Description</th><th>Status</th><th>Submitted</th><th>Action</th></tr>
  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= htmlspecialchars($row['id']) ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['category']) ?></td>
    <td style="text-align:left;"><?= nl2br(htmlspecialchars($row['description'])) ?></td>
    <td><?= htmlspecialchars($row['status']) ?></td>
    <td><?= htmlspecialchars($row['created_at']) ?></td>
    <td><a href="respond.php?id=<?= $row['id'] ?>">Respond / Update</a></td>
  </tr>
  <?php endwhile; ?>
</table>

<?php echo "</main></body></html>"; ?>
