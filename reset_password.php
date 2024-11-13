<?php

// Database connection
$conn = new mysqli("localhost", "root", "", "hdrs");

    if(isset($_GET['token']))
    {
        $token = $_GET['token'];

        //Check is token exists and is valid
        $stmt = $conn->prepare("SELECT id, reset_expires FROM users WHERE reset_token = ? ");
        $stmt -> bind_param("s", $token);
        $stmt ->execute();
        $stmt ->store_result();
        $stmt -> bind_result($id, $expires);
        $stmt ->fetch();

        if($stmt->num_rows > 0 && $expires > date("U"))
        {
             // Token is valid, show the reset form
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Reset Password</title>
        </head>
        <body>
        <form method="POST" action="">
            <input type="password" name="new_password" placeholder="Enter new password" required>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <button type="submit">Reset Password</button>
        </form>
        </body>
        </html>
            <?php
        }

        else 
        {
            echo "Invalid or expired token.";
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $id = $_POST['id'];

        // Update the password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?");
        $stmt ->bind_param("si", $new_password, $id);
        $stmt ->execute();

        echo "Password has been reset successfully.";
    }

?>