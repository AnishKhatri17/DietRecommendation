<?php
include 'config.php';

if (isset($_GET['id'])) 
{
    $user_id = $_GET['id'];

    // Generate a random new password or set a default one, in this case default password for all is set !!!!!
    $new_password = 'newpassword123'; // This generates a default password ..
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user's password in the database.
    $query = "UPDATE users SET password='$hashed_password' WHERE id='$user_id'";

    if (mysqli_query($conn, $query)) 
    {
        echo "Password reset successfully. The new password is: $new_password";
    } 
    
    else 
    {
        echo "Error resetting password: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
