<?php
// auth/mail_helper.php

function sendOtpEmail(string $toEmail, string $toName, string $code): bool {
    $host     = 'tw-traders.com';
    $port     = 465;
    $smtpUser = 'connect@tw-traders.com';
    $smtpPass = '#Huzi031522'; // ← put your actual email password here
    $fromName = 'TWF x SCB';

    $libPath = __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    if (file_exists($libPath)) {
        return sendWithPHPMailer($toEmail, $toName, $code, $host, $port, $smtpUser, $smtpPass, $fromName);
    }
    return sendWithSocket($toEmail, $toName, $code, $host, $port, $smtpUser, $smtpPass, $fromName);
}

function sendWithPHPMailer(string $to, string $name, string $code, string $host, int $port, string $user, string $pass, string $fromName): bool {
    require_once __DIR__ . '/../vendor/autoload.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $user;
        $mail->Password   = $pass;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = $port;
        $mail->setFrom($user, $fromName);
        $mail->addAddress($to, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Your SCB verification code';
        $mail->Body    = getEmailHtml($code);
        $mail->AltBody = "Your SCB Portal verification code is: $code\nThis code expires in 10 minutes.";
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('PHPMailer error: ' . $e->getMessage());
        return false;
    }
}

function sendWithSocket(string $to, string $name, string $code, string $host, int $port, string $user, string $pass, string $fromName): bool {
    $ctx    = stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]);
    $socket = @stream_socket_client("ssl://{$host}:{$port}", $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $ctx);
    if (!$socket) {
        error_log("SMTP socket error: $errstr ($errno)");
        return false;
    }

    $read = fn() => fgets($socket, 515);
    $send = fn(string $cmd) => fwrite($socket, $cmd . "\r\n");

    $read();
    $send("EHLO " . gethostname());
    while (($line = $read()) && substr($line, 3, 1) === '-') {}

    $send("AUTH LOGIN"); $read();
    $send(base64_encode($user)); $read();
    $send(base64_encode($pass));
    $r = $read();
    if (strpos($r, '235') === false) {
        fclose($socket);
        error_log("SMTP AUTH failed: $r");
        return false;
    }

    $send("MAIL FROM:<{$user}>"); $read();
    $send("RCPT TO:<{$to}>");     $read();
    $send("DATA");                $read();

    $boundary = md5(time());
    $html     = getEmailHtml($code);
    $plain    = "Your TWF x SCB Portal's Portal verification code is: $code\nThis code expires in 10 minutes.";

    $headers  = "From: {$fromName} <{$user}>\r\n";
    $headers .= "To: {$name} <{$to}>\r\n";
    $headers .= "Subject: Your TWF x SCB Portal's verification code\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/alternative; boundary=\"{$boundary}\"\r\n";

    $body  = "--{$boundary}\r\nContent-Type: text/plain; charset=UTF-8\r\n\r\n{$plain}\r\n";
    $body .= "--{$boundary}\r\nContent-Type: text/html; charset=UTF-8\r\n\r\n{$html}\r\n";
    $body .= "--{$boundary}--\r\n";

    $send($headers . "\r\n" . $body . "\r\n.");
    $r = $read();
    $send("QUIT");
    fclose($socket);

    return strpos($r, '250') !== false;
}

function getEmailHtml(string $code): string {
    return <<<HTML
        <!DOCTYPE html><html><body style="margin:0;padding:0;background:#FAFBFF;font-family:Poppins,sans-serif;">
        <div style="max-width:420px;margin:40px auto;background:#fff;border-radius:10px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:36px 32px;text-align:center;">
        <p style="font-size:13px;color:#555;margin:0 0 8px;">Your TWF x SCB Portal's verification code</p>
        <div style="font-size:36px;font-weight:700;letter-spacing:12px;color:#007bff;margin:16px 0;">{$code}</div>
        <p style="font-size:12px;color:#999;margin:16px 0 0;">This code expires in <strong>10 minutes</strong>. Do not share it with anyone.</p>
        </div></body></html>
    HTML;
}