<?php
session_start();
require '../db_connect.php';
if (!isset($_SESSION['admin_id'])) header("Location: login.php");

$status = isset($_GET['status']) ? $_GET['status'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$query = "SELECT c.id, u.name as student, u.email, c.category, c.description, c.status, c.created_at, c.updated_at
          FROM complaints c JOIN users u ON c.user_id = u.id WHERE 1=1";
$params = [];
$types = "";

if ($status !== '') { $query .= " AND c.status = ?"; $types.="s"; $params[]=$status; }
if ($category !== '') { $query .= " AND c.category = ?"; $types.="s"; $params[]=$category; }

$stmt = $conn->prepare($query);
if ($types!=="") $stmt->bind_param($types, ...$params);
$stmt->execute();
$res = $stmt->get_result();

// send CSV headers
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=complaints_export_'.date('Ymd_His').'.csv');
$out = fopen('php://output', 'w');
fputcsv($out, ['ID','Student','Email','Category','Description','Status','Submitted At','Updated At']);
while ($row = $res->fetch_assoc()) {
    fputcsv($out, [
        $row['id'],
        $row['student'],
        $row['email'],
        $row['category'],
        $row['description'],
        $row['status'],
        $row['created_at'],
        $row['updated_at']
    ]);
}
fclose($out);
exit;
