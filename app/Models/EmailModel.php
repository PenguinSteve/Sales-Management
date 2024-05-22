<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('./vendor/autoload.php');

class EmailModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    private function generateToken($email)
    {
        $token = bin2hex(random_bytes(16)) . dechex(time());
        $now = new DateTime();
        $now->add(new DateInterval('PT1M'));
        $expired = $now->format('Y-m-d H:i:s');
        $this->action("UPDATE token SET token = ?, expire_on = ? WHERE email = ?", [$token, $expired, $email], 'sss');
        return $token;
    }

    private function sendEmail($email, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'dogiahuyfore@gmail.com';                     //SMTP username
            $mail->Password   = 'mugx uauu hwex nrwl';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('', 'Sales Management');
            $mail->addAddress($email);                           

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $body;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function sendEmailOnCreateUser($email){
        $token = $this->generateToken($email);
        $subject = "Đăng nhập vào hệ thống quản lý bán hàng";
        $body = "Chào mừng bạn đến với Sales Management.<br>Tài khoản của bạn đã được tạo bằng email này.<br> Hãy click vào link sau để kích hoạt tài khoản của bạn và đăng nhập vào hệ thống: <a href='" . _HOST . "home/loginViaEmail?email=". $email ."token=" . $token . "'>Đăng nhập</a>";
        $this->sendEmail($email, $subject, $body);
    }

    public function resendEmail($email){
        $token = $this->generateToken($email);
        $subject = "Đăng nhập vào hệ thống quản lý bán hàng";
        $body = "Chào mừng bạn đến với Sales Management.<br>Đây là email được gửi lại để kích hoạt tài khoản và đăng nhập vào hệ thống.<br> Hãy click vào link sau để kích hoạt tài khoản của bạn và đăng nhập vào hệ thống: <a href='" . _HOST . "home/loginViaEmail?email=". $email ."token=" . $token . "'>Đăng nhập</a>";
        $this->sendEmail($email, $subject, $body);
    }
}
?>