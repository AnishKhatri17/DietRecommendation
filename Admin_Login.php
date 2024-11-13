<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./Admin_Login.css">
    <style>
        .tooglePassword
        {
            background: pink;
            border: 1px solid red;
            border-radius: 15px;
            cursor: pointer;       
        }
    </style>
</head>
<body>
    <div class="loginbox">
        <h1> Login Here </h1>
        <div class="form">
            <form action="Admin_Login_Connection.php" method="POST">
                <p>Username : </p>
                <input type="text" name="username" id="username" placeholder="Enter your username" required>
                <p>Password : </p>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>

                <!-- Button to toggle visibility -->
                <button type="button" id="togglePasswordAdmin" class="tooglePassword">👁️</button><br>

                <input type="submit" name="adminlogin" value="login"><br><br>
                <a href="#">forget password ? </a><br>
                <a href="index.php#signup">Doesn't have an account? Contact the developers team.</a>
            </form>

            </script>
    <!-- JavaScript to toggle password visibility -->
    <script>
    document.getElementById("togglePasswordAdmin").addEventListener("click", function () {
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
