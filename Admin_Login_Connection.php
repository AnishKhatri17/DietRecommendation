<?php
include 'config.php' ;

if(isset($_POST['adminlogin']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt= $conn->prepare("SELECT * FROM admin WHERE uname=? AND pwd=? ");
    $stmt ->bind_param("ss", $username, $password);
    $stmt ->execute();
    $stmt ->store_result();

    // Check if the Admin exists ...
    if($stmt->num_rows == 1)
    {
        header("Location: Admin_dashboard.php");
        exit();
    }

    else
    {
        // Password is incorrect, redirect with an error message
        echo 
        '<script>
        alert("Login info you provided is incorrect !!!\n\n Please try contacting the development team for more info.");
        window.location.href = "Admin_Login.php";
        </script>';
    }
}
?>