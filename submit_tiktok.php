<?php
// TikTok-Link einreichen & Coins gutschreiben
$db_host = "localhost";
$db_user = "kostenlo_referral";
$db_pass = "@Arschloch12";
$db_name = "kostenlo_referral";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) die("DB Fehler");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ref_code = $_POST['ref_code'];
    $tiktok_link = trim($_POST['tiktok_link']);
    if (filter_var($tiktok_link, FILTER_VALIDATE_URL) && preg_match('/tiktok\.com/', $tiktok_link)) {
        // Nur wenn noch kein TikTok für diesen Ref!
        $check = $conn->prepare("SELECT id FROM referrals WHERE ref_code=? AND tiktok_link IS NOT NULL");
        $check->bind_param("s", $ref_code);
        $check->execute();
        $check->store_result();
        if ($check->num_rows == 0) {
            // Speichern & Coins gutschreiben
            $stmt = $conn->prepare("UPDATE referrals SET tiktok_link=?, coins=coins+5000 WHERE ref_code=?");
            $stmt->bind_param("ss", $tiktok_link, $ref_code);
            $stmt->execute();
        }
    }
}
header("Location: /?ref=$ref_code&tiktok=1");
exit;