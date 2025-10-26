<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Babcock University Complaint Management System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <img src="babcock_logo.png" alt="Babcock Logo" style="height:60px; vertical-align:middle;">
  <h1 style="display:inline-block; margin-left:10px;">Babcock University Complaint Management System</h1>
</header>

<h2 style="text-align:center; margin-top:30px;">Welcome to Babcock University Complaint Portal</h2>
<p style="text-align:center;">Select an option below to proceed:</p>

<div style="display:flex; justify-content:center; gap:40px; margin-top:40px; flex-wrap:wrap;">

  <a href="submit_complaint.php" style="text-decoration:none;">
    <div style="background-color:#0b3d91; color:white; padding:20px; width:220px; text-align:center; border-radius:12px; box-shadow:0 0 8px rgba(0,0,0,0.2);">
      <h3>📝 Submit Complaint</h3>
      <p>File a new complaint for review.</p>
    </div>
  </a>

  <a href="view_complaints.php" style="text-decoration:none;">
    <div style="background-color:#d4af37; color:white; padding:20px; width:220px; text-align:center; border-radius:12px; box-shadow:0 0 8px rgba(0,0,0,0.2);">
      <h3>📋 View Complaints</h3>
      <p>Track the status of your complaint.</p>
    </div>
  </a>

  <a href="admin.php" style="text-decoration:none;">
    <div style="background-color:#333; color:white; padding:20px; width:220px; text-align:center; border-radius:12px; box-shadow:0 0 8px rgba(0,0,0,0.2);">
      <h3>🧑‍💼 Admin Panel</h3>
      <p>Respond to complaints and manage records.</p>
    </div>
  </a>

</div>

<footer style="text-align:center; margin-top:60px; color:#666;">
  <p>© <?php echo date('Y'); ?> Babcock
