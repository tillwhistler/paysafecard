<?php
session_start();
$db_host = "localhost";
$db_user = "kostenlo_referral";
$db_pass = "@Arschloch12";
$db_name = "kostenlo_referral";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) die("DB Fehler");

$ref_code = $_SESSION['ref_code'] ?? '';
$prize = $_POST['prize'] ?? '';
$cost = intval($_POST['cost'] ?? 0);

if(!$ref_code || !$prize || !$cost) die('error');

// Prüfe Guthaben
$stmt = $conn->prepare("SELECT coins, email FROM referrals WHERE ref_code = ?");
$stmt->bind_param("s", $ref_code);
$stmt->execute(); $stmt->bind_result($coins,$email); $stmt->fetch(); $stmt->close();

if($coins < $cost) die('notenough');

// Coins abziehen und Redemption speichern
$stmt = $conn->prepare("UPDATE referrals SET coins=coins-? WHERE ref_code=?");
$stmt->bind_param("is", $cost, $ref_code);
$stmt->execute(); $stmt->close();

$stmt = $conn->prepare("INSERT INTO redemptions (ref_code, prize, coins_spent, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $ref_code, $prize, $cost, $email);
$stmt->execute();
$stmt->close();

$stmt = $conn->prepare("SELECT coins FROM referrals WHERE ref_code = ?");
$stmt->bind_param("s", $ref_code);
$stmt->execute(); $stmt->bind_result($coins);
$stmt->fetch(); $stmt->close();

echo json_encode(['coins'=>$coins]);