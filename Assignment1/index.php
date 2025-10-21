<?php include('db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Complaint Management System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Submit a Complaint</h2>

  <form method="POST" action="">
    <label>Full Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email Address:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Category:</label><br>
    <select name="category" required>
      <option value="">--Select Category--</option>
      <option value="Hostel">Hostel</option>
      <option value="Academics">Academics</option>
      <option value="Finance">Finance</option>
      <option value="Others">Others</option>
    </select><br><br>

    <label>Complaint:</label><br>
    <textarea name="complaint" rows="5" cols="30" required></textarea><br><br>

    <button type="submit" name="submit">Submit Complaint</button>
  </form>

  <?php
  if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $category = $_POST['category'];
      $complaint = $_POST['complaint'];

      $sql = "INSERT INTO complaints (name, email, category, description, status)
              VALUES ('$name', '$email', '$category', '$complaint', 'Pending')";

      if ($conn->query($sql) === TRUE) {
          echo "<p style='color: green;'

