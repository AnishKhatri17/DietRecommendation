<?php
include 'config.php';

// Check if the user ID is passed
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    // Fetch user details
    $query = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
} 
else 
{
    echo "No user selected!";
    exit();
}

// Handle form submission for updating user
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update user information in the database
    $update_query = "UPDATE users SET username='$username', email='$email', phone='$phone' WHERE id='$user_id'";
    
    if (mysqli_query($conn, $update_query)) 
    {
        echo "<script>
                    alert('User Updated Successfully !'); 
                    window.location.href='Admin_Dashboard.php#TotalUsers'; // Redirect back to admin dashboard, Total Users section.
              </script>";
        exit();
    } 
    else 
    {
        echo "Error updating user: " . mysqli_error($conn);
    }
}
?>

<style>
    .update-form
    {
       margin-top: 50px;
       align-items: center;
       text-align: center;
       font-size: 18px;
    }
    .update
    {
        border: 1px solid black;
        /* width: fit-content; */
        max-width: 40%;
        margin: 20px auto;
        background-color: #e6e6fa;
    }

</style>
<h2 style="text-align: center; margin-top: 50px; font-family: Arial;" >Update User Info Form</h2>
<div class="update">
<!-- HTML form to display and update user details -->
<form method="POST" class="update-form">
    <label for="username">Username :</label>
    <input type="text" name="username" value="<?php echo $user['username']; ?>" style="margin-bottom: 15px; width: 250px; height: 30px;" required><br>

    <label for="email">Email :</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" style="margin-bottom: 15px; width: 250px; height: 30px; " required><br>

    <label for="phone">Phone :</label>
    <input type="text" name="phone" value="<?php echo $user['phone']; ?>" style="margin-bottom: 15px; width: 250px; height: 30px;" required><br>

    <input type="submit" value="Update User" style="margin-top: 15px; cursor: pointer; background: #5ce675; color: black; width: 100px; height: 35px; border: 2px solid red;">
</form>
</div>
