<?php
include 'config.php' ;

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=? ");
    $stmt->bind_param("s", $username );
    $stmt-> execute();
    $stmt-> store_result();

    //check if the user exists
    if($stmt->num_rows == 1)
    {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        /*
            To match the password with a hashed password stored in our database, we need to use password_hash() to hash passwords when storing them, and password_verify() to check the hashed password during login.
        */
         // Verify the password with the hashed password from the database
         if(password_verify($password,$hashedPassword))
         {
                // Start session if not already started
                if (session_status() == PHP_SESSION_NONE) /* session_status() checks if a session is already started or not.
                                                           PHP_SESSION_NONE means no session has been started yet.*/
                {
                    session_start();  // starts new session() this avoids multiple session start errors.
                }   
                // Fetch the user's id and email for session
                $stmt = $conn->prepare("SELECT id, email FROM users WHERE username=?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->bind_result($user_id, $email);
                $stmt->fetch();
            
                // Store user ID and email in session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $email;

                 // Password is correct, redirect to dashboard
                 header("Location: User_Dashboard.php");
                 exit();
         }
         else
         {
             // Password is incorrect, redirect with an error message
             echo 
                    '<script>
                    alert("Password you provided is incorrect !!!\n\n Please try again.");
                    window.location.href = "User_Login.php";
                    </script>';
         }
    }
    else
        {
           // Username not found, redirect with an error message
               echo 
                    '<script>
                    alert("Username or password you provided is incorrect !!!\n\n Please try again.");
                    window.location.href = "User_Login.php";
                    </script>';
         }
    }
    $stmt->close();
    $conn->close();
?>