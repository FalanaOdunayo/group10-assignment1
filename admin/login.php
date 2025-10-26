<?php
session_start();
require '../db_connect.php';

if (isset($_SESSION['admin_id'])) header("Location: dashboard.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pw = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, name FROM users WHERE email=? AND role='admin' LIMIT 1");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        if (password_verify($pw, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['name'];
            header("Location: dashboard.php");
            exit();
        } else { $error = "Wrong password."; }
    } else { $error = "Admin not found."; }
    $stmt->close();
}
include '../header.php';
?>
<h2>Admin Login</h2>
<form method="POST">
  <input name="email" type="email" placeholder="Admin email" required>
  <input name="password" type="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php echo "</main></body></html>"; ?>
