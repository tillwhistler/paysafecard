<?php
session_start();
$db_host = "localhost";
$db_user = "kostenlo_referral";
$db_pass = "@Arschloch12";
$db_name = "kostenlo_referral";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) die("DB Fehler");

function createRefCode() { return substr(md5(mt_rand().time()),0,10);}
if(isset($_GET['ref'])) $_SESSION['ref_code'] = preg_replace('/[^a-zA-Z0-9]/','',$_GET['ref']);
elseif(!isset($_SESSION['ref_code'])) $_SESSION['ref_code'] = createRefCode();
$ref_code = $_SESSION['ref_code'];

$stmt = $conn->prepare("SELECT id, coins, email FROM referrals WHERE ref_code=? LIMIT 1");
$stmt->bind_param("s", $ref_code);
$stmt->execute(); $stmt->store_result();
if($stmt->num_rows==0) {
    $coins = 100;
    $stmt2 = $conn->prepare("INSERT INTO referrals (ref_code, coins) VALUES (?, ?)");
    $stmt2->bind_param("si", $ref_code, $coins); $stmt2->execute(); $stmt2->close();
    $email = '';
} else {
    $stmt->bind_result($id,$coins,$email); $stmt->fetch();
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Paysafecard Rewards</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/app.css?v=<?= filemtime('js/wheel.js') ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header-app">
        <div class="header-brand">
            <img src="/referral/logo.png" alt="Logo" height="38" class="header-logo">
        </div>
        <div class="header-balance">
            <span class="balance-label">Coins</span>
            <span class="balance-value" id="coinCounter"><?=$coins?></span>
        </div>
    </header>
    <nav class="app-nav">
        <ul>
            <li><a href="#" data-tab="home" class="nav-active"><span>🏠</span><span class="nav-text">Start</span></a></li>
            <li><a href="#" data-tab="wheel"><span>🎡</span><span class="nav-text">Glücksrad</span></a></li>
            <li><a href="#" data-tab="offers"><span>💼</span><span class="nav-text">Angebote</span></a></li>
            <li><a href="#" data-tab="referral"><span>👥</span><span class="nav-text">Freunde</span></a></li>
            <li><a href="#" data-tab="tiktok"><span>📱</span><span class="nav-text">TikTok</span></a></li>
            <li><a href="#" data-tab="redeem"><span>💳</span><span class="nav-text">Auszahlen</span></a></li>
        </ul>
    </nav>
    <main>
        <div class="tab-content" id="tab-home"><?php include 'tpl/home.php'; ?></div>
        <div class="tab-content" id="tab-wheel" style="display:none"><?php include 'tpl/wheel.php'; ?></div>
        <div class="tab-content" id="tab-offers" style="display:none"><?php include 'tpl/offers.php'; ?></div>
        <div class="tab-content" id="tab-referral" style="display:none"><?php include 'tpl/referral.php'; ?></div>
        <div class="tab-content" id="tab-tiktok" style="display:none"><?php include 'tpl/tiktok.php'; ?></div>
        <div class="tab-content" id="tab-redeem" style="display:none"><?php include 'tpl/redeem.php'; ?></div>
    </main>
    <footer>
        <div class="footer-app">
            <span>Copyright © <?=date('Y')?> by DeepBlue Webservices LLC | <a href="https://www.kostenlose-paysafecard.com/kontakt/" rel="noopener" data-cke-saved-href="https://www.kostenlose-paysafecard.com/kontakt/">Support</a>&nbsp;|&nbsp;<a href="https://kostenlose-paysafecard.com/privacy.html" target="_blank" rel="noopener" data-cke-saved-href="https://kostenlose-paysafecard.com/privacy.html">Datenschutz</a>&nbsp;|&nbsp;<a href="https://kostenlose-paysafecard.com/disclaimer.html" target="_blank" rel="noopener" data-cke-saved-href="https://kostenlose-paysafecard.com/disclaimer.html">Impressum</a></span>
        </div>
    </footer>
    <div id="popup" class="popup"></div>
    <canvas id="confetti-canvas" class="confetti-canvas"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.9.2/p5.min.js"></script>
    <script src="https://openfpcdn.io/fingerprintjs/v4"></script>
    <script>
    window.PSC_USER = <?=json_encode(['ref_code'=>$ref_code,'coins'=>$coins, 'email'=>$email])?>;
    </script>
    <script src="js/main.js?v=<?= filemtime('js/wheel.js') ?>"></script>
    <script src="js/wheel.js?v=<?= filemtime('js/wheel.js') ?>"></script>
        <div id="popup" class="popup"></div>
    <canvas id="confetti-canvas" class="confetti-canvas"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.9.2/p5.min.js"></script>
    <script src="https://openfpcdn.io/fingerprintjs/v4"></script>
    <script src="js/main.js?v=<?= filemtime('js/wheel.js') ?>"></script>
    <script src="js/wheel.js?v=<?= filemtime('js/wheel.js') ?>"></script>
</body>
</html>