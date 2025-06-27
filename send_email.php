
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nithishsiva1551@gmail.com';     // Your Gmail
        $mail->Password = 'ehgzvqaacmdmjcvj';    // Your App Password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('nithishsiva1551@gmail.com', 'Portfolio Website');
        $mail->addAddress('nithishsiva1551@gmail.com');
        $mail->addReplyTo($_POST['email'], $_POST['name']);

        $mail->isHTML(true);
        $mail->Subject = htmlspecialchars($_POST["subject"]);
        $mail->Body = "From: " . htmlspecialchars($_POST["name"]) . "<br>" .
                      "Email: " . htmlspecialchars($_POST["email"]) . "<br><br>" .
                      nl2br(htmlspecialchars($_POST["message"]));

        $mail->send();
        echo "✅ Success: Message sent!";
    } catch (Exception $e) {
        echo "❌ Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    echo "❌ Form not submitted correctly.";
}
?>
