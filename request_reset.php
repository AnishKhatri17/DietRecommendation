<?php

    // include phpmailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

   // Include Composer's autoloader
    require 'vendor/autoload.php'; // This should point to your project's vendor directory


    // Load configuration
    // $config = require 'C:/xampp/configuration/configuration.php'; //for securing sensitive data 

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_POST['email'];

        // Database Connection
        $conn = new mysqli("localhost","root","","hdrs");

        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? ");
        $stmt ->bind_param("s", $email);
        $stmt ->execute();
        $stmt ->store_result();

        if($stmt ->num_rows > 0)
        {
            // Generate a token .....
            $token = bin2hex(random_bytes(50));
            $expires = date("U") + 1800; //30 minutes expiry of the token 

            // insert token into the database ...
            $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ? ");
            $stmt ->bind_param("sis", $token, $expires, $email);
            $stmt ->execute();

            //send email using phpmailer
            $mail = new PHPMailer(true);

            try{
                // SMTP Configuration 
                // $mail->SMTPDebug = 2; // Debug mode (2 or 3 will show detailed info)
                $mail->isSMTP() ;
                $mail->Host = 'smtp.gmail.com'; // Use Gmail SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'smctu444@gmail.com'; // Your Gmail address
                $mail->Password = 'mgpc jgbd ezxh eeef'; // Your Gmail password or app-specific password
                // App passwords provide an extra layer of security. You don’t have to expose your main Gmail password in your code.
                // App passwords can be generated when we have 2 step verification ON in oour gmail account.
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail ->Port = 587;

                //Email Setting
                $mail->setFrom('smctu444@gmail.com', 'Health Diet Recommendation System'); 
                // First parameter is email address from which the email will be sent.
                // Second parameter is we want to show up in the recipient's inbox. This could be our website's name.
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = "Password Reset Request";

                /*
                    We need to use valid domain and hosting to redirect the link to password reset form ...
                    When a user receives an email, they are not on your website. An absolute URL ensures the link directs them to the right place, regardless of their current context.
                    Server Location: It specifies exactly where to go, including which server (domain) and protocol to use. A relative URL would only work correctly if the user were already on your website, which is not the case when they are opening an email.
                 */
                // $resetLink = "https://yourdomain.com/reset_password.php?token=" . $token;
                // $resetLink = "http://example.com/reset_password.php?token=" . $token; //this is an example ......
                $resetLink = "http://localhost/ProjectII/reset_password.php?token=" . $token;
                $mail->Body = "Click the link to reset your password: <a href='$resetLink'>$resetLink</a>";

                $mail->send();
                echo 'A password reset link has been sent to your email. Please open your Inbox.';

            }
            catch (Exception $e) 
            {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        else 
        {
            echo 'No account found with that email.';
        }
    }
?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Enter Your Email" required><br>
    <button type="submit">Request Password Reset</button>
</form>