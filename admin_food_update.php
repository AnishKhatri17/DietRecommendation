<?php
// Include database connection
include 'config.php';

// Check if the 'id' is passed in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) 
{
    $food_id = $_GET['id'];

    // Fetch the food details based on the id
    $query = "SELECT * FROM foods WHERE id = $food_id";
    $result = mysqli_query($conn, $query);
    $food = mysqli_fetch_assoc($result);
} 
else 
{
    // Redirect if no valid id is provided
    header('Location: Admin_Dashboard.php');
    exit();
}

// Handle the form submission for updating the food details
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $food_name = $_POST['food_name'];
    $category = $_POST['category'];
    $calories = (float) $_POST['calories'];
    $protein_grams = (float) $_POST['protein_grams'];
    $fat_grams = (float) $_POST['fat_grams'];
    $carbs_grams = (float) $_POST['carbs_grams'];
    $calcium_mg = (float) $_POST['calcium_mg'];
    $meal_type = $_POST['meal_type'];

    // Update query
    $update_query = "UPDATE foods SET 
        food_name = '$food_name', 
        category = '$category', 
        calories = '$calories', 
        protein_grams = '$protein_grams', 
        fat_grams = '$fat_grams', 
        carbs_grams = '$carbs_grams', 
        calcium_mg = '$calcium_mg', 
        meal_type = '$meal_type'
        WHERE id = $food_id";

    if (mysqli_query($conn, $update_query)) 
    {
        // Redirect after successful update
        header('Location: Admin_Dashboard.php#FoodNutritionalData');
        exit();
    } 
    else 
    {
        echo "Error updating food: " . mysqli_error($conn);
    }
}

?>

<!-- Simple form for updating the food details -->
<h2>Update Food Details</h2>
<form method="POST" action="">
    <label>Food Name:</label>
    <input type="text" name="food_name" value="<?php echo $food['food_name']; ?>" required><br>
    
    <label>Category:</label>
    <input type="text" name="category" value="<?php echo $food['category']; ?>" required><br>
    
    <label>Calories:</label>
    <input type="number" name="calories" value="<?php echo $food['calories']; ?>" step="0.01" required><br>
    
    <label>Protein (g):</label>
    <input type="number" name="protein_grams" value="<?php echo $food['protein_grams']; ?>" step="0.01" required><br>
    
    <label>Fat (g):</label>
    <input type="number" name="fat_grams" value="<?php echo $food['fat_grams']; ?>" step="0.01" required><br>
    
    <label>Carbs (g):</label>
    <input type="number" name="carbs_grams" value="<?php echo $food['carbs_grams']; ?>" step="0.01" required><br>
    
    <label>Calcium (mg):</label>
    <input type="number" name="calcium_mg" value="<?php echo $food['calcium_mg']; ?>" step="0.01" required><br>
    
    <label>Meal Type:</label>
    <input type="text" name="meal_type" value="<?php echo $food['meal_type']; ?>" required><br>
    
    <button type="submit">Update Food</button>
    <!-- The step="0.01" allows the input to accept any number with up to two decimal places (e.g., 100.55, 250.20). -->

</form>

<style>
    form 
    {
    width: 500px; /* Set a fixed width for the form */
    margin: 0 auto; /* Center the form horizontally */
    padding: 15px;
    background-color: #e6e6fa;
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add subtle shadow */
    font-family: Arial, sans-serif;
    border: 1px solid skyblue;
}

h2 {
    text-align: center;
    color: #333;
}

label {
    display: block;
    margin-bottom: 3px;
    color: #555;
    font-weight: bold;
}

input[type="text"],
input[type="number"] 
{
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
    background-color: #FFFFF0;
}

input[type="text"]:focus,
input[type="number"]:focus 
{
    border-color: #4CAF50; /* Green color for focus */
    color: red;
    outline: none;
}

button 
{
    display: block; /* Make the button a block element */
    margin: 0 auto; /* Center it horizontally */
    width: 40%;
    padding: 12px;
    background-color: #4CAF50; /* Green background */
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

button:hover 
{
    background-color: skyblue; 
    /* background-color: #45a049;  *//* Darker green on hover */
    color: black;
}

@media (max-width: 500px) {
    form {
        width: 90%; /* Responsive: Make the form 90% of the screen width on smaller devices */
    }
}

</style>