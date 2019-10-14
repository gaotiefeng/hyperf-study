<?php


namespace App\Service\Client;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    protected $username;

    protected $name;

    protected $password;

    public function sendMailer($emails = [])
    {
        $this->username = '';
        $this->name = 'liunian';
        $this->password = '';

        $mail = new PHPMailer(true);
        try {
            //Server settings
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Mailer = 'SMTP';
            $mail->Host = 'smtp.qq.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $this->username;                 // SMTP username
            $mail->Password = $this->password;                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
            //Recipients

            $mail->setFrom($this->username, $this->name);
            foreach ($emails as $email) {
                $mail->addAddress($email);     // Add a recipient
            }

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'You are very 漂亮';
            $mail->Body    = '<h6>I love you</h6><b>!</b>';
            $mail->CharSet = 'UTF-8';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
