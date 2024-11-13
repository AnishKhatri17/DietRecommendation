<?php
include 'config.php';

if (isset($_GET['id'])) 
{
    $user_id = $_GET['id'];
    // Delete the user
    $query = "DELETE FROM users WHERE id='$user_id'";

    if (mysqli_query($conn, $query)) 
    {
        echo "User deleted successfully.";
    
    } 
    else 
    {
        echo "Error deleting user: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
