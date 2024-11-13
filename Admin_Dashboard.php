<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin_Dashboard.css">

</head>
<body>
    <div class="dashboard">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="Admin_Dashboard.php">Home</a></li>
            <li><a href="#UserFeedbacks">Feedbacks</a></li>
            <li><a href="#TotalUsers">Total Users</a></li>
            <li><a href="#FoodNutritionalData">Nutritional Data</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="Admin_Login.php">Logout</a></li>
        </ul>
    </div>
 
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <div class="top-nav">
            <h1>Welcome, Admin</h1>
        </div>

        <!-- Dashboard Overview -->
        <div class="dashboard-overview">
            <div class="overview-card">
                <h3>Total Users</h3>
                <p>150</p>
            </div>
            <div class="overview-card">
                <h3>Total Diet Plans</h3>
                <p>45</p>
            </div>
            <div class="overview-card">
                <h3>Pending Approvals</h3>
                <p>12</p>
            </div>
            <div class="overview-card">
                <h3>System Settings</h3>
                <p>Add or Remove food items</p>
            </div>
        </div>
    </div>
    </div>


    <section id="UserFeedbacks" class="UserFeedbacks">
    <?php
// Include the config file for database connection
include 'config.php';
// Set the number of records per page
$records_per_page = 7; // Show 7 rows per page or we can change according to the requirements.

// Get the current page number from the URL, default to 1 if not set
$current_page = isset($_GET['feedback_page']) ? intval($_GET['feedback_page']) : 1;

// Calculate the starting record for the current page
$offset = ($current_page - 1) * $records_per_page; // Calculate where to start fetching data

// Query to fetch the total number of feedbacks
$total_feedback_query = "SELECT COUNT(*) AS total FROM userfeedback";
$total_feedback_result = mysqli_query($conn, $total_feedback_query);
$total_feedback_row = mysqli_fetch_assoc($total_feedback_result);
$total_feedbacks = $total_feedback_row['total'];

// Calculate the total number of pages
$total_pages = ceil($total_feedbacks / $records_per_page);

// Query to fetch feedback data for the current page
$query = "SELECT * FROM userfeedback LIMIT $records_per_page OFFSET $offset";
$result = $conn->query($query);


// Check if there are any records in the result set
if ($result->num_rows > 0) 
{
    echo '<div class="feedback-table-container">';
    echo '<h2>All User Feedback</h2>';
    
    // Start the table and define table headers
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '<thead>
            <tr>
                <th>ID</th>
                <th>Email Address</th>
                <th>Feedback</th>
                <th>Action</th>
            </tr>
          </thead>';
    
    echo '<tbody>';
    
    // Loop through each record and display in table rows
    while ($row = $result->fetch_assoc()) 
    {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['feedback'] . '</td>';
        echo '<td>';
        // Use the feedback ID as a data attribute for the button
        echo '<button data-id="' . $row['id'] . '" onclick="respondToFeedback(\'' . $row['id'] . '\', \'' . $row['email'] . '\', this)">Respond</button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    // echo '</div>';
?>

<!-- Pagination -->
<div class="user-pagination">
    <?php if ($current_page > 1): ?>
        <a href="?feedback_page=1#UserFeedbacks">First</a>
        <a href="?feedback_page=<?php echo $current_page - 1; ?>#UserFeedbacks">Previous</a>
    <?php endif; ?>

    <?php
    // Determine the range of pages to show
    $start_page = max(1, $current_page - 2);
    $end_page = min($total_pages, $current_page + 2);

    if ($start_page > 1) 
    {
        echo '<a href="?feedback_page=1#UserFeedbacks">1</a>';
        if ($start_page > 2) 
        {
            echo '<span>...</span>';
        }
    }

    for ($i = $start_page; $i <= $end_page; $i++) 
    {
        echo '<a href="?feedback_page=' . $i . '#UserFeedbacks" ' . ($i == $current_page ? 'class="active"' : '') . '>' . $i . '</a>';
    }

    if ($end_page < $total_pages) 
    {
        if ($end_page < $total_pages - 1) 
        {
            echo '<span>...</span>';
        }
        echo '<a href="?feedback_page=' . $total_pages . '#UserFeedbacks">' . $total_pages . '</a>';
    }
    ?>

    <?php if ($current_page < $total_pages): ?>
        <a href="?feedback_page=<?php echo $current_page + 1; ?>#UserFeedbacks">Next</a>
        <a href="?feedback_page=<?php echo $total_pages; ?>#UserFeedbacks">Last</a>
    <?php endif; ?>
</div>

<?php
    echo '</div>'; // End of feedback-table-container
}

 else 
    {
    echo '<p>No feedback records found.</p>';
    }

// Close the database connection
$conn->close();
?>

<script>
// Check if the specific feedback has already been responded to and update the button
function checkResponded(feedbackId, button) 
{
    const responded = localStorage.getItem('responded_' + feedbackId);
    if (responded === 'true') {
        button.innerText = 'Responded';
        button.disabled = true;
    }
}

// Function to handle the respond action
function respondToFeedback(feedbackId, email, button) {
    // Open Gmail's compose window with the recipient's email address
    window.open('https://mail.google.com/mail/?view=cm&fs=1&to=' + email, '_blank');
    
    // Change the button text to "Responded" and disable it
    button.innerText = 'Responded';
    button.disabled = true;
    
    // Store the 'responded' state for the specific feedback entry in local storage
    localStorage.setItem('responded_' + feedbackId, 'true');
}

// When the DOM is fully loaded, check the response status for all feedback buttons
document.addEventListener('DOMContentLoaded', function() {
    // Select all buttons that have the respond action
    const buttons = document.querySelectorAll('button[data-id]');
    
    // Loop through each button and check if it has been responded to
    buttons.forEach(button => {
        const feedbackId = button.getAttribute('data-id');
        checkResponded(feedbackId, button);
    });
});
</script>

    </section>


<section id="TotalUsers" class="TotalUsers">
<?php
        // This is my code before pagination which is used to just fetch the total no. of users
//  Include your database connection
// include 'config.php';

//  Fetch all users data except passwords
// $query = "SELECT id, username, email, phone FROM users";
// $result = mysqli_query($conn, $query);
?>

<?php
// Include the database connection which is config.php
include 'config.php';

// Set the number of rows per page(How many data(rows) we want to display at once.)
$rows_per_page = 10; 

// Get the current page number from the URL; default to page 1 if not set
if (isset($_GET['user_page']) && is_numeric($_GET['user_page'])) 
{
    $current_page = $_GET['user_page'];
} 

else 
{
    $current_page = 1;
}

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $rows_per_page;

// Get the total number of users
$total_users_query = "SELECT COUNT(*) AS total FROM users"; 
// COUNT(*): This function counts all rows in the table, regardless of the content of each row.
// The query renames the result of COUNT(*) to 'total', which makes it easier to reference later in the code.
$total_users_result = mysqli_query($conn, $total_users_query);
$total_users_row = mysqli_fetch_assoc($total_users_result);
$total_users = $total_users_row['total'];

// Calculate the total number of pages
$total_pages = ceil($total_users / $rows_per_page); 

// Fetch the users for the current page
$query = "SELECT id, username, email, phone FROM users LIMIT $offset, $rows_per_page";  // using the limit for pagination..
$result = mysqli_query($conn, $query);
?>

<!-- Inline CSS for styling the table and buttons -->
<style>
    table 
    {
        width: 100%;
        border: 1px solid blue;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: center;
    }
    th, td {
        padding: 12px 15px;
        border: 1px solid green;
        background-color: #f9f9f9;
    }
    th {
        background-color: #f2f2f2;
        color: #333;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    a {
        text-decoration: none;
        color: white;
        padding: 6px 15px; /* Controls the inside space of the button */
        border-radius: 10px;
        margin: -3px 1px; /* Reduces margin-top and margin-bottom to -3px, margin-right to 1px */
        display: inline-block;
        text-align: center;
        /* width: 100px;  */
        /* Set a standard width */
    }
    .update-btn 
    {
        background-color: #4CAF50; /* Green */
        border: 1px solid black;
    }
    .delete-btn 
    {
        background-color: #f44336; /* Red */
        border: 1px solid black;
    }
    .reset-btn 
    {
        background-color: #008CBA; /* Blue */
        border: 1px solid black;
    }
    a:hover {
        opacity: 0.8;
        color: black;
    }

    /* Responsive table: container for scrolling */
    .table-container 
    {
        max-width: 100%;
        overflow-x: auto; /* Enables horizontal scrolling on smaller screens */
    }

    /* Media query for smaller screens */
    @media screen and (max-width: 768px) 
    {
        table 
        {
            font-size: 14px; /* Adjust font size for smaller screens */
        }
        th, td 
        {
            padding: 10px; /* Reduce padding for smaller screens */
        }
    }
</style>

<h1 style="text-align: center; margin-top: -10px;">Displaying all the users</h1>
<!-- Display the table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
                <!-- Styled action buttons -->
                <a href="admin_update_user.php?id=<?php echo $row['id']; ?>" class="update-btn">Update</a>
                <a href="admin_delete_user.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                <a href="admin_reset_password.php?id=<?php echo $row['id']; ?>" class="reset-btn">Reset Password</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Pagination Code -->
<div class="pagination">
    <!-- First and Previous Links -->
    <?php if ($current_page > 1): ?>
        <a href="?user_page=1#TotalUsers">First</a>
        <a href="?user_page=<?php echo $current_page - 1; ?>#TotalUsers">Previous</a>
    <?php endif; ?>

    <!-- Page Numbers -->
    <?php
    // Determine the range of pages to show
    $start_page = max(1, $current_page - 2);
    $end_page = min($total_pages, $current_page + 2);

    // Show page numbers with ellipsis for hidden pages
    if ($start_page > 1) 
    {
        echo '<a href="?user_page=1#TotalUsers">1</a>';
        if ($start_page > 2) {
            echo '<span>...</span>'; // Ellipsis
        }
    }

    for ($i = $start_page; $i <= $end_page; $i++) // loop for starting page to the ending page...
    {
        echo '<a href="?user_page=' . $i . '#TotalUsers" ' . ($i == $current_page ? 'class="active"' : '') . '>' . $i . '</a>';
    }

    if ($end_page < $total_pages) 
    {
        if ($end_page < $total_pages - 1) 
        {
            echo '<span>...</span>'; // Ellipsis
        }
        echo '<a href="?user_page=' . $total_pages . '#TotalUsers">' . $total_pages . '</a>';
    }
    ?>

    <!-- Next and Last Links -->
    <?php if ($current_page < $total_pages): ?>
        <a href="?user_page=<?php echo $current_page + 1; ?>#TotalUsers">Next</a>
        <a href="?user_page=<?php echo $total_pages; ?>#TotalUsers">Last</a>
    <?php endif; ?>
</div>

<?php
// Close the connection
mysqli_close($conn);
?>

<!-- admin_delete_user.php, admin_reset_password_user.php and admin_update_user.php are all declared in a separate file for simplicity -->
</section>



<section id="FoodNutritionalData" class="FoodNutritionalData">
<?php
// Include the database connection file (config.php)
include 'config.php';

// Set the number of rows per page (you can change this value)
$rows_per_page = 10;

// Get the current page number from the URL, default to page 1 if not set
if (isset($_GET['food_page']) && is_numeric($_GET['food_page'])) 
{
    $current_page = $_GET['food_page'];
} else {
    $current_page = 1;
}

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $rows_per_page;

// Get the total number of foods
$total_foods_query = "SELECT COUNT(*) AS total FROM foods"; 
$total_foods_result = mysqli_query($conn, $total_foods_query);
$total_foods_row = mysqli_fetch_assoc($total_foods_result);
$total_foods = $total_foods_row['total'];

// Calculate the total number of pages
$total_pages = ceil($total_foods / $rows_per_page);

// Fetch the foods for the current page
$query = "SELECT id, food_name, category, calories, protein_grams, fat_grams, carbs_grams, calcium_mg, meal_type 
          FROM foods LIMIT $offset, $rows_per_page";
$result = mysqli_query($conn, $query);
?>

<!-- Inline CSS for styling the table and pagination -->
<style>
    table {
        width: 100%;
        border: 1px solid blue;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: center;
    }
    th, td {
        padding: 12px 15px;
        border: 1px solid green;
        background-color: #f9f9f9;
    }
    th {
        background-color: #f2f2f2;
        color: #333;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Responsive table container */
    .table-container {
        max-width: 100%;
        overflow-x: auto;
    }

    /* Media query for smaller screens */
    @media screen and (max-width: 768px) {
        table {
            font-size: 14px;
        }
        th, td {
            padding: 10px;
        }
    }
</style>

<h2 style="text-align: center;">Food Nutritional Data (100 grams each), (30 grams of nuts_oilseeds)</h2>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Food Name</th>
                <th>Category</th>
                <th>Calories</th>
                <th>Protein (g)</th>
                <th>Fat (g)</th>
                <th>Carbs (g)</th>
                <th>Calcium (mg)</th>
                <th>Meal Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['food_name']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['calories']; ?></td>
                <td><?php echo $row['protein_grams']; ?></td>
                <td><?php echo $row['fat_grams']; ?></td>
                <td><?php echo $row['carbs_grams']; ?></td>
                <td><?php echo $row['calcium_mg']; ?></td>
                <td><?php echo $row['meal_type']; ?></td>
                <td>
                <!-- Update button with link to update page, passing the food id -->
                <a href="admin_food_update.php?id=<?php echo $row['id']; ?>" class="update-btn">Update</a>
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination">
    <!-- First and Previous Links -->
    <?php if ($current_page > 1): ?>
        <a href="?food_page=1#FoodNutritionalData">First</a>
        <a href="?food_page=<?php echo $current_page - 1; ?>#FoodNutritionalData">Previous</a>
    <?php endif; ?>

    <!-- Page Numbers -->
    <?php
    $start_page = max(1, $current_page - 2);
    $end_page = min($total_pages, $current_page + 2);

    if ($start_page > 1) {
        echo '<a href="?food_page=1#FoodNutritionalData">1</a>';
        if ($start_page > 2) {
            echo '<span>...</span>';
        }
    }

    for ($i = $start_page; $i <= $end_page; $i++) {
        echo '<a href="?food_page=' . $i . '#FoodNutritionalData" ' . ($i == $current_page ? 'class="active"' : '') . '>' . $i . '</a>';
    }

    if ($end_page < $total_pages) {
        if ($end_page < $total_pages - 1) {
            echo '<span>...</span>';
        }
        echo '<a href="?food_page=' . $total_pages . '#FoodNutritionalData">' . $total_pages . '</a>';
    }
    ?>

    <!-- Next and Last Links -->
    <?php if ($current_page < $total_pages): ?>
        <a href="?food_page=<?php echo $current_page + 1; ?>#FoodNutritionalData">Next</a>
        <a href="?food_page=<?php echo $total_pages; ?>#FoodNutritionalData">Last</a>
    <?php endif; ?>
</div>

<?php
// Close the connection
mysqli_close($conn);
?>
</section>

</body>
</html>
