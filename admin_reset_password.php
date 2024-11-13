<?php
include 'config.php';

if (isset($_GET['id'])) 
{
    $user_id = $_GET['id'];
    ?>

    <style>
        .reset
        {
            border: 1px solid black;
            max-width: 25%;
            margin: 15px auto;
            background: #e6e6fa;
            height: 20%;
        }
        /* .reset input[type="password"] 
        {
            width: 220px;
        } */
    </style>

    <h2 style="text-align: center; margin-top: 50px; font-family: Arial;">User Password Reset</h2>
    <div class="reset">
    <!-- HTML form for entering a new password -->
    <form action="admin_reset_password.php" method="POST" onsubmit="return validatePassword()">
        <input type="hidden" name="id" value="<?php echo $user_id; ?>">
        <label for="new_password" style="color: green; font-size: 18px; font-weight: bold; margin-top: 40px;"><u>Enter New Password :</u></label><br><br>
        <input type="password" id="new_password" name="new_password" placeholder="min length 8 and 1 special char" style="width: 220px;" required>
        <!-- Button to toggle visibility -->
        <button type="button" id="togglePassword" style="background: pink; border: 1px solid red; border-radius:15px; cursor: pointer;">👁️</button><br><br>
        <button type="submit" style="background: skyblue; cursor: pointer; width: 180px; height: 30px; text-align: center;">Reset Password</button>
    </form>
    </div>

        <!-- Javascript for password validation -->
    <script>
        function validatePassword()
        {
            var password = document.getElementById("new_password").value;
            var specialCharPattern = /[!@#$%^&*(),.?":{}|<>]/g;

            if(password.length < 8)
        {
            alert("Password must be at least 8 characters long.");
            return false;
        }

        if(!specialCharPattern.test(password))
        {
            alert("Password must contain at least one special character.");
            return false;
        }
                return true;

        }

    </script>
    <!-- JavaScript to toggle password visibility -->
<script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        var passwordField = document.getElementById("new_password"); // getting the passworf from the password reset form .....
        
        // Toggle the type attribute between password and text
        if (passwordField.type === "password") 
        {
            passwordField.type = "text";  // Show password
            this.textContent = "🙈";     // Change icon to "eye with slash"
        } 
        else 
        {
            passwordField.type = "password";  // Hide password
            this.textContent = "👁️";          // Change back to "eye" icon
        }
    });
</script>

    <?php
}

// Handle the form submission to reset the password
if (isset($_POST['id']) && isset($_POST['new_password'])) 
{
    $user_id = $_POST['id'];
    $new_password = $_POST['new_password'];

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $query = "UPDATE users SET password='$hashed_password' WHERE id='$user_id'";

    if (mysqli_query($conn, $query)) 
    {
        // echo "Password reset successfully.";     This displays a message in a page..
        // header("Location: Admin_Dashboard.php#TotalUsers");      This redirects to the same Admin_Dashboard section after successful execution.

        // Using predefined javascript alert to display a message and redirect to same section after successful execution ...
        echo 
        '<script>
        alert("Password Reset Successfully !!!\n\n Please provide the login info to the specific users only for security purposes.");
        window.location.href = "Admin_Dashboard.php#TotalUsers";
        </script>';
    } 
    
    else 
    {
        echo "Error resetting password: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
