<?php
// Udobi Ifeanyichukwu David
// 23/1509
// Group C

include("config.php");

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="complaints.csv"');

$output = fopen("php://output", "w");
fputcsv($output, ['ID', 'User ID', 'Category', 'Description', 'Status', 'Date']);

$result = $conn->query("SELECT * FROM complaints");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
