<?php
// Database connection
include 'config.php';

// Fetch user data from the form
$name = $_POST['name'];
$age = $_POST['userage'];
$gender = $_POST['gender'];
$height = $_POST['userheight'];
$weight = $_POST['userweight'];
$activity = $_POST['activity'];
$goal = $_POST['goal'];
$dietary = $_POST['dietary'];
$health = $_POST['health'];

// Step 1: Calculate Daily Calorie Needs (using Harris-Benedict equation)
switch ($gender) 
{
    case 'male':
        $bmr = 88.362 + (13.397 * $weight) + (4.799 * $height) - (5.677 * $age);
        break;
    case 'female':
    default:
        $bmr = 447.593 + (9.247 * $weight) + (3.098 * $height) - (4.330 * $age);
        break;
}

// Activity level multiplier
$activity_levels = [
    'sedentary' => 1.2,
    'light' => 1.375,
    'moderate' => 1.55,
    'active' => 1.725,
    'superactive' => 1.9
];
$daily_calories = $bmr * $activity_levels[$activity];

// Adjust based on the goal
switch ($goal) {
    case 'weight_loss':
        $daily_calories -= 550;
        break;
    case 'weight_gain':
        $daily_calories += 550;
        break;
    case 'maintain_weight':
        // No adjustment needed for maintenance
        break;
}

// Step 2: Set Caloric Distribution for each meal
$meal_calories = [
    'breakfast' => round(0.25 * $daily_calories),
    'lunch' => round(0.35 * $daily_calories),
    'snacks' => round(0.15 * $daily_calories),
    'dinner' => round(0.25 * $daily_calories)
];

// Step 3: Build Filtering Query Based on Dietary Preference
$food_query = "SELECT f.* FROM foods AS f";

// Dietary preference filter adjustment
switch ($dietary) 
{
    case 'vegan':
        $preference_id = 1;
        $food_query .= " LEFT JOIN food_dietary_preferences AS dp ON f.id = dp.food_id 
                         WHERE (dp.preference_id = $preference_id OR dp.food_id IS NULL)";
        break;
    case 'vegetarian':
        $preference_id = 2;
        $food_query .= " LEFT JOIN food_dietary_preferences AS dp ON f.id = dp.food_id 
                         WHERE (dp.preference_id = $preference_id OR dp.food_id IS NULL)";
        break;
    case 'non_vegetarian':
        $preference_id = 3;
        $food_query .= " LEFT JOIN food_dietary_preferences AS dp ON f.id = dp.food_id 
                         WHERE (dp.preference_id = $preference_id OR dp.food_id IS NULL)";
        break;
    case 'any':
    default:
        $food_query .= " LEFT JOIN food_dietary_preferences AS dp ON f.id = dp.food_id 
                         WHERE 1=1";
        break;
}

// Health condition filter
$condition_id = null;
switch ($health) 
{
    case 'diabetes':
        $condition_id = 1;
        break;
    case 'kidney_disease':
        $condition_id = 2;
        break;
    case 'heart_disease':
        $condition_id = 3;
        break;
    case 'hypertension':
        $condition_id = 4;
        break;
    case 'asthma':
        $condition_id = 5;
        break;
    case 'acne':
        $condition_id = 6;
        break;
    case 'hypercholesterolemia':
        $condition_id = 7;
        break;
    case 'high_blood_pressure':
        $condition_id = 8;
        break;
    case 'low_blood_pressure':
        $condition_id = 9;
        break;
    case 'jaundice':
        $condition_id = 10;
        break;
    default:
        break;
}

if ($condition_id !== null) 
{
    $food_query .= " AND f.id NOT IN (SELECT food_id FROM food_health_conditions WHERE condition_id = $condition_id)";
}

// Step 4: Fetch Suitable Foods from Database
$food_result = $conn->query($food_query);
$foods = $food_result->fetch_all(MYSQLI_ASSOC);

// Function to get foods by meal type with fallback option
function getFoodsByMealType($foods, $meal_type, $fallback_types = []) 
{
    $meal_foods = array_filter($foods, function($food) use ($meal_type) 
    {
        return strtolower($food['meal_type']) === $meal_type;  // Ensure case-insensitivity
    });
    
    // If not enough meal_foods, check fallback types
    foreach ($fallback_types as $fallback_type) 
    {
        if (count($meal_foods) >= 5) break;
        $fallback_foods = array_filter($foods, function($food) use ($fallback_type) 
        {
            return strtolower($food['meal_type']) === $fallback_type;
        });
        $meal_foods = array_merge($meal_foods, $fallback_foods);
    }

    return $meal_foods;
}

// Helper function to get foods for each meal, targeting calorie needs with flexibility and carry-forward
function getMealFoods($foods, $calories_needed, $meal_type, $carry_forward = 0, $max_items = 6, $tolerance = 50) 
{
    $fallback_meals = [
        'breakfast' => ['lunch', 'snacks'],
        'lunch' => ['breakfast', 'dinner'],
        'snacks' => ['lunch', 'dinner'],
        'dinner' => ['breakfast', 'lunch']
    ];

    $selected_foods = [];
    $total_calories = 0;
    $attempts = 0;
    $meal_foods = getFoodsByMealType($foods, $meal_type, $fallback_meals[$meal_type]);

    do {
        $attempts++;
        shuffle($meal_foods); // Shuffle to add randomness in food selection
        $selected_foods = [];
        $total_calories = 0;
        
        foreach ($meal_foods as $food) 
        {
            if (count($selected_foods) < $max_items && ($total_calories + $food['calories'] <= $calories_needed + $carry_forward + $tolerance)) {
                $selected_foods[] = $food;
                $total_calories += $food['calories'];
            }
            
            if (abs($total_calories - ($calories_needed + $carry_forward)) <= $tolerance || count($selected_foods) >= $max_items) 
            {
                break;
            }
        }
        
    } while (abs($total_calories - ($calories_needed + $carry_forward)) > $tolerance && $attempts < 5);

    return [$selected_foods, $total_calories];
}

// Step 5: Generate Meal Plan for 7 Days
$meal_plan = [];
for ($day = 1; $day <= 7; $day++) 
{
    $day_plan = [];
    $carry_forward = 0;
    
    foreach ($meal_calories as $meal => $calories_needed) 
    {
        list($meal_foods, $total_meal_calories) = getMealFoods($foods, $calories_needed, $meal, $carry_forward, 6);
        
        $carry_forward = ($calories_needed + $carry_forward) - $total_meal_calories;
        
        $day_plan[$meal] = $meal_foods;
    }

    $meal_plan[] = $day_plan;
}

// Get the current date and time
$current_datetime = date("l, F j, Y"); // Output: Wednesday, November 13, 2024 - 03:45 PM
// We can change the format if needed .....

// Start capturing the HTML output
ob_start();

// Display the current date and time
echo "<p>Diet Recommendation Generated on : $current_datetime</p>";

// Output the meal plan
echo '<div id="meal-plan-content">'; // Wrap the content for PDF
foreach ($meal_plan as $day_index => $day_plan) 
{
    echo "<h2>Day " . ($day_index + 1) . "</h2>";
    foreach ($day_plan as $meal => $meal_foods) 
    {
        echo "<h3>" . ucfirst($meal) . " (Target: {$meal_calories[$meal]} calories)</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Food Name</th>
                    <th>Category</th>
                    <th>Calories</th>
                    <th>Protein (g)</th>
                    <th>Fat (g)</th>
                    <th>Carbohydrates (g)</th>
                    <th>Calcium (mg)</th>
                </tr>";
        $total_meal_calories = 0;    
        foreach ($meal_foods as $food) 
        {
            echo "<tr>
                    <td>{$food['food_name']}</td>
                    <td>{$food['category']}</td>
                    <td>{$food['calories']}</td>
                    <td>{$food['protein_grams']}</td>
                    <td>{$food['fat_grams']}</td>
                    <td>{$food['carbs_grams']}</td>
                    <td>{$food['calcium_mg']}</td>
                  </tr>";
            $total_meal_calories += $food['calories'];
        }
        echo "</table>";
        echo "<p>Total {$meal} Calories: $total_meal_calories</p>";
       
    }
}
echo '</div>';
// Capture the output and store it in a variable
$meal_plan_html = ob_get_clean();
?>

<!-- Additional Text Information Above the Button and Table -->
<div style="text-align: center; margin-bottom: 10px;">
    <h1>"Please download the diet recommendation as PDF to keep track."</h1>
    <p>If you provide the same input you may get different diet recommedation, If the recommended foods are invalid for you, please regenerate. Thank You.</p>
</div>

<!-- Place the PDF download button above the meal plan -->
<form action="download_pdf.php" method="post" style="text-align: center; margin-top: 20px;">
    <input type="hidden" name="meal_plan_html" value="<?php echo htmlspecialchars($meal_plan_html); ?>">
    <button type="submit" style="background-color: #EE4B2B; color: white; text-decoration: bold; padding: 12px 24px; border: 1px solid yellow; cursor: pointer; font-size: 16px; border-radius: 5px; margin-top: 10px; margin-bottom: 0px;">Download as PDF</button>
</form>

<p>"Imp Note: The nutritional details is of '100 grams' of each food-items and '30 grams' of nuts and oilseeds."</p>
<!-- Display the meal plan content on the page -->
<?php echo $meal_plan_html; ?>

<style>
        /* Table styling */
        table 
        {
            margin: 0 auto;
            width: 80%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        th, td {
            padding: 4px;
            text-align: center;
            border: 1px solid black;
        }

        th {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text color */
        }

        td {
            background-color: #f9f9f9; /* Light gray background for cells */
        }

        /* Add subtle hover effect for rows */
        tr:hover {
            background-color: #f1f1f1;
        }

        /* Table header */
        h2 {
            color: #333; /* Dark color for headers */
            text-align: center;
            color: red;
            font-size: 30px;
            /* text-decoration: underline; */
        }
        h3 {
            color: #333; /* Dark color for headers */
            text-align: center;
            color: blue;
            margin-bottom: 0px;
        }

        /* Table padding */
        p {
            font-weight: bold;
            font-weight: italic;
            margin-bottom: 10px;
            text-align: center;
            font-size: 18px;
        }
    </style>
