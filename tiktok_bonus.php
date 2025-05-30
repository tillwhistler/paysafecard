<?php
session_start();
$db_host = "localhost";
$db_user = "kostenlo_referral";
$db_pass = "@Arschloch12";
$db_name = "kostenlo_referral";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) die("DB Fehler");

$ref_code = $_SESSION['ref_code'] ?? '';
$tiktok_url = trim($_POST['tiktok_url'] ?? '');

if(!$ref_code || !$tiktok_url) die('error');
$stmt = $conn->prepare("INSERT INTO tiktok_entries (ref_code, tiktok_url) VALUES (?, ?)");
$stmt->bind_param("ss", $ref_code, $tiktok_url);
$stmt->execute();
$stmt->close();

// optional: direkt Coins gutschreiben (oder nach Prüfung)
$stmt = $conn->prepare("UPDATE referrals SET coins = coins + 5000 WHERE ref_code = ?");
$stmt->bind_param("s", $ref_code);
$stmt->execute();
$stmt->close();

$stmt = $conn->prepare("SELECT coins FROM referrals WHERE ref_code = ?");
$stmt->bind_param("s", $ref_code);
$stmt->execute();
$stmt->bind_result($coins);
$stmt->fetch();
$stmt->close();

echo json_encode(['coins'=>$coins]);