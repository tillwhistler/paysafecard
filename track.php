<?php
session_start();
$db_host = "localhost";
$db_user = "kostenlo_referral";
$db_pass = "@Arschloch12";
$db_name = "kostenlo_referral";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) die("DB Fehler");

if(isset($_GET['get_clicks'])) {
    $ref_code = $_SESSION['ref_code'] ?? '';
    $clicks = 0;
    $res = $conn->query("SELECT COUNT(*) FROM referral_clicks WHERE ref_code='$ref_code'");
    if($row = $res->fetch_row()) $clicks = intval($row[0]);
    echo json_encode(['clicks'=>$clicks]);
    exit;
}

$ref_code = $_GET['ref'] ?? '';
$fp = $_GET['fp'] ?? '';
$ip = $_SERVER['REMOTE_ADDR'];
if(!$ref_code || !$fp) die('error');

if(isset($_SESSION['ref_code']) && $_SESSION['ref_code'] === $ref_code) die('self');

$stmt = $conn->prepare("SELECT id FROM referral_clicks WHERE ref_code=? AND (visitor_fp=? OR visitor_ip=?) AND DATE(created_at)=CURDATE() LIMIT 1");
$stmt->bind_param("sss", $ref_code, $fp, $ip);
$stmt->execute(); $stmt->store_result();
if($stmt->num_rows==0) {
    $stmt2 = $conn->prepare("INSERT INTO referral_clicks (ref_code, visitor_fp, visitor_ip) VALUES (?, ?, ?)");
    $stmt2->bind_param("sss", $ref_code, $fp, $ip); $stmt2->execute(); $stmt2->close();
    $conn->query("UPDATE referrals SET coins=coins+500 WHERE ref_code='$ref_code'");
    $res = $conn->query("SELECT COUNT(*) FROM referral_clicks WHERE ref_code='$ref_code'");
    $row = $res->fetch_row();
    $clicks = intval($row[0]);
    echo json_encode(['status'=>'ok','clicks'=>$clicks]);
} else {
    $res = $conn->query("SELECT COUNT(*) FROM referral_clicks WHERE ref_code='$ref_code'");
    $row = $res->fetch_row();
    $clicks = intval($row[0]);
    echo json_encode(['status'=>'dupe','clicks'=>$clicks]);
}
$stmt->close();