<?php

include 'config.php'; // Include the database configuration file (database connection) .....

        session_start(); // Start session to access session variables

// Check if the form is submitted by checking if the submit button was clicked !
if (isset($_POST['submit'])) 
{
   // Retrieve email from session (since it's read-only in the form)
   $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

    // Sanitize the feedback input to remove any special characters or HTML tags 
    /*
    This filter strips tags and removes or encodes special characters. 
    It helps prevent certain types of attacks, like cross-site scripting (XSS), 
    where harmful code could be injected through user input i.e Feedback !!!!!
    */
    $feedback = filter_var($_POST['feedback'], FILTER_SANITIZE_STRING);

        // Prepare an SQL statement to safely insert the fetched email and feedback into the database
        $stmt = $conn->prepare("INSERT INTO userfeedback (email, feedback) VALUES (?, ?)");
        // Bind the email and feedback values to the prepared statement to prevent SQL injection
        $stmt->bind_param("ss", $email, $feedback);
        
        // Execute the prepared statement and check if the data was successfully inserted
        if ($stmt->execute()) 
        {
            // If successful, then display a JavaScript alert thanking the user for their feedback.
            echo '<script>
                    alert("Feedback submitted successfully! Thank you for your feedback.");
                    window.location.href = "User_Dashboard.php#Feedback";  // Redirect to the #Feedback section of the User Dashboard..
                  </script>';
            exit(); // Stop further script execution after redirection
        }
         else 
         {
            // If there was an error inserting the data, display the error
            echo "Error: " . $stmt->error;
         }
        // Close the prepared statement to free up resources
        $stmt->close();
}
// Close the database connection once all operations are completed ...........
$conn->close();
?>
