<?php
require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../resources/templates');
$twig = new \Twig\Environment($loader);

// General variables
$basePath = __DIR__ . '/../';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$errors = false;
$error = '';

$name = '';
$email = '';
$telefoon = '';
$bericht = '';

if (isset($_POST["bttnsubmit"])) {
    if (!$_POST['naam']) {
        $errors = true;
        $error = 'Gelieve alle velden juist in te vullen.';
        $name = $_POST['name'];
    }
    if (!$_POST['email']) {
        $errors = true;
        $error = 'Gelieve alle velden juist in te vullen.';
        $email = $_POST['email'];
    }
    if (!$_POST['telefoon']) {
        $errors = true;
        $error = 'Gelieve alle velden juist in te vullen.';
        $telefoon = $_POST['telefoon'];
    }
    if (!$_POST['Bericht']) {
        $errors = true;
        $error = 'Gelieve alle velden juist in te vullen.';
        $bericht = $_POST['Bericht'];
    }

    if (!$errors) {
        try {
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.hosting.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'email';                     // SMTP username
            $mail->Password = 'password';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($_POST['email'], $_POST['naam']);
            $mail->addAddress('vincentlaureys21@gmail.com', 'Homate');     // Add a recipient

            // hello@homate.be
            // Set email format to HTML
            $mail->Subject = $_POST['naam'];
            $mail->Body = $_POST['Bericht'] . PHP_EOL . $_POST['telefoon'];
            $mail->send();


        } catch (Exception $e) {
            $error = "Bericht kon niet verzonden worden. Gelieve de velden juist in te vullen.";
        }


    }
}


echo $twig->render('pages/Index.twig', [
    'name' => $_POST['naam'] ?? '',
    'email' => $_POST['email'] ?? '',
    'telefoon' => $_POST['telefoon'] ?? '',
    'error' => $error
]);
