<?php include('db_connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Student Login - Complaint System</title>
</head>
<body>
    <header>
  <img src="babcock_logo.png" alt="Babcock Logo" style="height:60px; vertical-align:middle;">
  <h1 style="display:inline-block; margin-left:10px;">Babcock University Complaint Management System</h1>
</header>

  <h2>Student Login</h2>
  <form method="POST">
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="login">Login</button>
  </form>

<?php
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email='$email' AND role='student'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if ($password == $row['password']) {
      session_start();
      $_SESSION['user_id'] = $row['id'];
      header("Location: submit_complaint.php");
      exit();
    } else {
      echo "❌ Wrong password!";
    }
  } else {
    echo "❌ Student not found!";
  }
}
?>
</body>
</html>
