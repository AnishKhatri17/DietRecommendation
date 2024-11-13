<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./User_Login.css">
    <style>
        .tooglePassword
        {
            background: pink;
            border: 1px solid red;
            border-radius: 15px;
            cursor: pointer;  
            /* height: 20px; Let the heigth be default. It is looking quite good.. */
        }
    </style>
</head>
<body>
    <div class="loginbox">
        <h1> Login Here </h1>
        <div class="form">
            <form action="User_Login_Connection.php" method="POST">
                <p>Username : </p>
                <input type="text" name="username" id="username" placeholder="Enter your username" required>
                <p>Password : </p>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>

                 <!-- Button to toggle visibility -->
                 <button type="button" id="togglePasswordUser" class="tooglePassword">👁️</button><br>

                <input type="submit" name="login" value="login"><br><br>
                <a href="request_reset.php">forget password ? </a><br>
                <a href="index.php#signup">Doesn't have an account? Click here to register</a>
            </form>

            </script>
    <!-- JavaScript to toggle password visibility -->
    <script>
    document.getElementById("togglePasswordUser").addEventListener("click", function () {
        var passwordField = document.getElementById("password"); // getting the password from the Login Password .....
        
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
        </div>
    </div>
</body>
</html>
