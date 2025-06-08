<?php
session_start();
$db_host = "localhost";
$db_user = "kostenlo_referral";
$db_pass = "@Arschloch12";
$db_name = "kostenlo_referral";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) die("DB Fehler");

$ref_code = $_SESSION['ref_code'] ?? '';
$add = intval($_POST['add'] ?? 0);
if(!$ref_code || !$add) die('error');

// Coins gutschreiben
$stmt = $conn->prepare("UPDATE referrals SET coins = coins + ? WHERE ref_code = ?");
$stmt->bind_param("is", $add, $ref_code);
$stmt->execute();

// Coins zurückgeben
$stmt = $conn->prepare("SELECT coins FROM referrals WHERE ref_code = ?");
$stmt->bind_param("s", $ref_code);
$stmt->execute();
$stmt->bind_result($coins);
$stmt->fetch();
$stmt->close();

echo json_encode(['coins' => $coins]);