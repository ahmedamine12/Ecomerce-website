
<?php

require('connexion.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require('phpmailer\Exception.php');
require('phpmailer\PHPMailer.php');
require('phpmailer\SMTP.php');

$id=$_GET['id'];

$user = $conn->query("SELECT * FROM utilisateurs WHERE id_utilisateur=$id")->fetch();


echo $user['id_utilisateur'];
echo $user['nom_utilisateur'];
echo $user['prenom_utilisateur'];
echo $user['sexe_utilisateur'];
echo $user['email_utilisateur'];
echo $user['numero_utilisateur'];
echo $user['adresse_utilisateur'];
echo $user['date_naissance'];


//Create a new PHPMailer instance
$mail = new PHPMailer();

try {
    //Server settings
    $mail->SMTPDebug = 3;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'rida.elbardai-etu@etu.univh2c.ma';                     //SMTP username
    $mail->Password   = 'Elbard3ai';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('rida.elbardai-etu@etu.univh2c.ma', 'ILISI SHOP');
    $mail->addAddress($user['email_utilisateur'], $user['nom_utilisateur']);     //Add a recipient
    $mail->addReplyTo('rida.elbardai-etu@etu.univh2c.ma', 'Information');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Confirmation d\'inscription';
    $mail->Body    = "Votre demande a bien ete accepte <br>
                      cliquer sur ce lien pour poursuivre votre inscription 
                      <a href=\"http://localhost/projetWeb/pages/creer_compte.php?id=".$user['id_utilisateur']."\">cliquer ici</a>";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo 'Message has been sent';


    header('location:demandes.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}