<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Babcock Complaint Management System</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      display: flex;
      margin: 0;
      font-family: Arial, sans-serif;
      height: 100vh;
    }
    .sidebar {
      width: 230px;
      background-color: #001f54;
      color: white;
      padding: 20px;
    }
    .sidebar img {
      width: 100%;
      max-width: 120px;
      display: block;
      margin: 0 auto 15px;
    }
    .sidebar h2 {
      text-align: center;
      font-size: 16px;
      margin-bottom: 20px;
    }
    .sidebar a {
      display: block;
      padding: 10px;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      margin: 8px 0;
      background-color: #003080;
      text-align: center;
    }
    .sidebar a:hover {
      background-color: #0055ff;
    }
    .main {
      flex: 1;
      background-color: #f5f8ff;
      padding: 30px;
      overflow-y: auto;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <img src="babcock_logo.png" alt="Babcock University Logo">
  <h2>Babcock CMS</h2>
  <a href="dashboard.php?page=index.php">🏠 Home</a>
  <a href="dashboard.php?page=submit_complaint.php">📝 Submit Complaint</a>
  <a href="dashboard.php?page=view_complaints.php">📋 View Complaints</a>
  <a href="dashboard.php?page=admin.php">🧑‍💼 Admin Panel</a>
</div>

<div class="main">
  <?php include($page); ?>
</div>

</body>
</html>
