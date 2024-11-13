<?php
session_start();

include 'config.php';

if(isset($_POST['submit']))
{
    // get the value from the user register form.
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];
    $confirm_pwd = $_POST['confirm_pwd'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // validate the password match
    if($pwd === $confirm_pwd)
    {
        // It is recommendated to use hash fuction for security purpose
        $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT);

        /* 
            code is vulnerable to SQL injection attacks because it directly embeds user inputs in the SQL query.
            We should use prepared statements for better security.  
        */
        //Check if username and password already exist (Using SQL Query) .....
        // $sql = "SELECT * FROM users WHERE username='$uname' AND email='$email' ";

        //  $result = mysqli_query($conn,$sql) ;
        //  $presentrows = mysqli_num_rows($result);
        //     if($presentrows>0)
        //             {
        //               $_SESSION['alert_message']='1' ;
        //                header("location: index.php#signup") ;
        //             }

        // Using Prepared Statemt to compare username and email already exixts in users table for better security .
            $stmt = $conn ->prepare("SELECT * FROM users WHERE username=? OR email=? ");
            $stmt -> bind_param("ss", $uname, $email);
            $stmt -> execute();
            $result = $stmt ->get_result();

                if($result -> num_rows>0)
                {
                    // Username and Email already exists .....
                    $_SESSION['alert_message'] = '1';
                    header("Location: index.php#signup");
                    exit();
                }

            else
            {
                // SQL queries are vulnerable compared to Prepared Statements and leads to attack.
         /* 
                SQL query to insert data into the table
                $sql = "INSERT INTO users (username, password, email, phone) VALUES ('$uname', '$hashed_pwd', '$email', '$phone')";

                // Execute the query
                $result = mysqli_query($conn, $sql);
        */

                // Using Prepared Statement to insert data into database .....
                $stmt = $conn->prepare("INSERT INTO users(username, password, email, phone) VALUES (?,?,?,?)" );
                $stmt ->bind_param("ssss",$uname,$hashed_pwd,$email,$phone);
                $result = $stmt->execute();


             // Check if the record was inserted successfully
             if($result)
             {
                     // Use JavaScript to display the dialog box upon successful form submission
                     echo 
                     '<script>
                     alert("Form submitted successfully! \nPlease login to continue the journey to better health !!!");
                     window.location.href = "User_Login.php";  // Redirect to login page
                    </script>';
             }
                else
                {
                    echo "Error: " . mysqli_error($conn);
                }
            }
    }

                else 
                {
                    echo 
                    '<script>
                    alert("Passwords do not match! Please try again.");
                    window.location.href = "index.php#signup";
                    </script>';
                }
    }
