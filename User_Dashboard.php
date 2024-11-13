<?php
session_start(); // Start session to access session variables (after user login)

// Check if the user is logged in by checking if user_id is in session
if (!isset($_SESSION['user_id'])) 
{
    // Redirect to login page if not logged in...
    header("Location: User_Login.php");
    exit();
}

// Fetch the user's email from the session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="User_Dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Javascript code to calculate BMI of the user -->
    <script>
        function calculateBMI(event) {
            event.preventDefault(); // Prevent form from submitting

            // Get the input values
            var weight = document.getElementById("BMIweight").value;
            var height = document.getElementById("BMIheight").value;

            // Convert height from cm to meters
            height = height / 100;

            // Calculate BMI
            var bmi = weight / (height * height);

            // Display the result
            document.getElementById("result").innerText = "" + bmi.toFixed(3);
        }
    </script>

     <!-- Javascript code for the calculation of calorie of Harris-Benedict Equation ...... -->
     <script>
        function calculateCalories(e) 
        {
            e.preventDefault();
            
            // Get form values
            const weight = document.getElementById('weight').value;
            const height = document.getElementById('height').value;
            const age = document.getElementById('age').value;
            const gender = document.getElementById('gender').value;
            const activityLevel = document.getElementById('activity_level').value;

            if (isNaN(weight) || weight <= 0 || isNaN(height) || height <= 0 || isNaN(age) || age <= 0) 
            {
                 alert("Please enter valid positive values for weight, height, and age.");
                 return false;
            }


            // Harris-Benedict Equation
            let bmr;
                 /* Basal Metabolic Rate (BMR)
                The BMR represents the number of calories your body needs to maintain basic physiological functions
                (like breathing, circulation, cell production, etc.) at rest.
                */
            if (gender === 'male') //for male
            {
                bmr = 88.362 + (13.397 * weight) + (4.799 * height) - (5.677 * age);
            } 

            else //for women
            {
                bmr = 447.593 + (9.247 * weight) + (3.098 * height) - (4.330 * age);
            }


            // For the calculation of Total Daily Energy Expenditure (TDEE).
            // Activity factor
            let activityFactor;
            switch(activityLevel) 
            {
                case 'sedentary':
                    activityFactor = 1.2;
                    break;
                case 'lightly_active':
                    activityFactor = 1.375;
                    break;
                case 'moderately_active':
                    activityFactor = 1.55;
                    break;
                case 'very_active':
                    activityFactor = 1.725;
                    break;
                case 'super_active':
                    activityFactor = 1.9;
                    break;
            }
            // NOTE : "1 kg of body weight is approximately equivalent to 7700 calories." !!!!!


            // Calculate daily calorie needs or to maintain the current weight.
            const dailyCalories = bmr * activityFactor;

            // Calculate daily calories for weight gain.
            const weightGainCaloriesQuarterkg = dailyCalories + 275;   //for gaining 0.25 per week.
            /*
                gaining 0.25 kg per week would require a surplus of about 0.25*7700 = '1925' calories per week, which is roughly 275 calories per day.
            */
             const weightGainCaloriesHalfkg = dailyCalories + 550;   //for gaining 0.5 kg per week.
             /*
                gaining 0.5 kg per week would require a surplus of about 3850 calories per week, which is roughly 550 calories per day.
             */
            const weightGainCaloriesOnekg = dailyCalories + 1100;   //for gaining 1 kg per week.
            /*
                gaining 1 kg per week would require a surplus of about 7700 calories per week, which is roughly 1100 calories per day.
            */
            const weightGainCaloriesTwokg = dailyCalories + 2200; // for gaining 2 kg per week.
            /*
                gaining 2 kg per week would require a surplus of about 15400 calories per week, which is roughly 2200 calories per day.
            */
            const weightGainCaloriesThreekg = dailyCalories + 3300; // for gaining 3 kg per week.
            /*
                gaining 3 kg per week would require a surplus of about 23100 calories per week, which is roughly 3300 calories per day.
            */


                // Calculate daily calories for weight loss
             const weightLossCaloriesQuarterkg = dailyCalories - 275;   //for losing 0.25 kg per week.
             /*
                 losing 0.25 kg per week would require a deficit of about 0.25*7700 = '1925' calories per week, which is roughly 275 calories per day.
             */
            const weightLossCaloriesHalfkg = dailyCalories - 550;   //for losing 0.5 kg per week.
             /*
                 losing 0.5 kg per week would require a deficit of about 0.5*7700 = '3850' calories per week, which is roughly 550 calories per day.
             */
            const weightLossCaloriesOnekg = dailyCalories - 1100;   //for losing 1 kg per week.
            /*
                losing 1 kg per week would require a deficit of about 1*7700 = '7700' calories per week, which is roughly 1100 calories per day.
            */
            const weightLossCaloriesTwokg = dailyCalories - 2200; // for losing 2 kg per week.
            /*
                losing 2 kg per week would require a deficit of about 15400 calories per week, which is roughly 2200 calories per day.
            */
            const weightLossCaloriesThreekg = dailyCalories - 3300; // for losing 3 kg per week.
            /*
                losing 3 kg per week would require a deficit of about 23100 calories per week, which is roughly 3300 calories per day.
            */


            // Display result
            document.getElementById('results').innerHTML = 
            ` 
            <br>
            To maintain your current weight, calorie needs are approximately : ${dailyCalories.toFixed(2)} calories per day.<br><br>

            To gain 0.25 kg weight in 1 week, you need approximately : ${weightGainCaloriesQuarterkg.toFixed(2)} calories per day.<br>
            To gain 0.5 kg weight in 1 week, you need approximately : ${weightGainCaloriesHalfkg.toFixed(2)} calories per day.<br>
            To gain 1 kg weight in 1 week, you need approximately : ${weightGainCaloriesOnekg.toFixed(2)} calories per day.<br>
            To gain 2 kg weight in 1 week, you need approximately : ${weightGainCaloriesTwokg.toFixed(2)} calories per day.<br>
            To gain 3 kg weight in 1 week, you need approximately : ${weightGainCaloriesThreekg.toFixed(2)} calories per day.
            <br><br><br>

            To lose 0.25 kg weight in 1 week, you need approximately : ${weightLossCaloriesQuarterkg.toFixed(2)} calories per day.<br>
            To lose 0.5 kg weight in 1 week, you need approximately : ${weightLossCaloriesHalfkg.toFixed(2)} calories per day.<br>
            To lose 1 kg weight in 1 week, you need approximately : ${weightLossCaloriesOnekg.toFixed(2)} calories per day.<br>
            To lose 2 kg weight in 1 week, you need approximately : ${weightLossCaloriesTwokg.toFixed(2)} calories per day.<br>
            To lose 3 kg weight in 1 week, you need approximately : ${weightLossCaloriesThreekg.toFixed(2)} calories per day.<br><br>
            `;
        }
    </script>

<script>
        document.querySelector('form').addEventListener('submit', function(event) {
            // Get the age input field
            var ageInput = document.getElementById('userage');  
            var age = parseInt(ageInput.value, 10);  // Convert the input value to an integer
            
            // Check if the age is less than 15 or greater than 200
            if (age < 15 || age > 200) 
            {
                // Show an alert if the age is not valid
                alert('Please enter a valid age between 15 and 200.');    
                ageInput.focus();   // Set focus back to the age input field for correction
                event.preventDefault(); // Prevent the form from being submitted
            }
        });
        </script>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        // Get the height and weight input fields
        var heightInput = document.getElementById('userheight');
        var weightInput = document.getElementById('userweight');
        
        // Convert input values to integers
        var height = parseInt(heightInput.value, 10);
        var weight = parseInt(weightInput.value, 10);
        
        // Validate height
        if (height < 50 || height > 250) {
            alert('Please enter a valid height between 50 cm and 250 cm.');
            heightInput.focus();
            event.preventDefault(); // Prevent form submission
            return; // Exit the function
        }
    
        // Validate weight
        if (weight < 25 || weight > 350) {
            alert('Please enter a valid weight between 30 kg and 300 kg.');
            weightInput.focus();
            event.preventDefault(); // Prevent form submission
        }
    });
    </script>
<!-- 
The JavaScript code listens for the form's submit event.
It retrieves the height and weight values, converts them to integers, and checks if they fall within the specified range.
If a value is out of range, an alert is shown, and form submission is prevented. -->

</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h1>Dashboard</h1>
            <ul>
                <li><a href="#">Homepage</a></li>
                <li><a href="#BMI">Calculate BMI</a></li>
                <li><a href="#Calorie">Calorie Calculator</a></li>
                <li><a href="#UserProfile">Start New Journey</a></li>
                <li><a href="#">History and Records</a></li>
                <li><a href="#Feedback">Feedback</a></li>
                <li><a href="User_Login.php">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                
                <div class="user-info">
                    <img src="images/hero-image.jpg" alt="Project Logo" class="avatar">
                    <span class="user-name"></span>
                    <p>Welcome, To The Journey Of Healthy Life!</p>
                </div>
            </div>
            
            <div class="cards">

                <a href="#BMI" class="card-link">
                <div class="card">
                    <h3>Calculate BMI</h3>
                    <p>Calculate your BMI here</p>
                </div>
              </a>

                <a href="#Calorie" class="card-link">
                <div class="card">
                    <h3>Calorie Calculator</h3>
                    <p>Your daily calorie needs</p>
                </div>
                </a>

                <a href="#" class="card-link">
                <div class="card">
                    <h3>Your Progress</h3>
                    <p>Tap to see history records</p>
                </div>
                </a>

                <a href="#Feedback" class="card-link">
                <div class="card">
                    <h3>Feedbacks</h3>
                    <p>Feedbacks are appreciated</p>
                </div>
                </a>

                <a href="#" class="card-link">
                <div class="card">
                    <h3>Continue Journey</h3>
                    <p>Your journey to healthy life</p>
                </div>
                </a>
            </div>
        </div>
    </div>
    
    <section id="BMI" class="BMI">
        <div class="container">
            <div class="calculator">
                <h2>BMI Calculator</h2>
                <form onsubmit="calculateBMI(event)">
                    <label for="weight">Weight (kg):</label>
                    <input type="number" id="BMIweight" name="BMIweight" placeholder="Enter your weight in kilograms" required><br>
                    
                    <label for="height">Height (cm):</label>
                    <input type="number" id="BMIheight" name="BMIheight" placeholder="Enter your height in centimeters" required><br>
                    
                    <input type="submit" value="Calculate BMI">
                </form>
            
            <!-- <p id="result"></p> "It is also used for displaying the BMI Value :"<br> -->
            <div class="output">
               <b>Your BMI is :</b> <span id="result"></span>
            </div><br><br>
            <a href="Unit_Converter_Dashboard.php">Click here for unit converter</a>
           </div>

            <div class="info">
                <h1>Body Mass Index (BMI) Range</h1>
                <table>
                    <tr>
                        <th>BMI Range</th>
                        <th>Category</th>
                    </tr>
                    <tr>
                        <td>Less than 18.5</td>
                        <td style="color:rgba(0, 0, 255, 0.755);">Underweight</td>
                    </tr>
                    <tr>
                        <td>18.5 to 24.9</td>
                        <td style="color:rgb(13, 138, 13);">Normal weight</td>
                    </tr>
                    <tr>
                        <td>25 to 29.9</td>
                        <td style="color:rgba(255, 0, 0, 0.753);">Overweight</td>
                    </tr>
                    <tr>
                        <td>30 to 34.9</td>
                        <td style="color:brown;">Obesity (Class 1)</td>
                    </tr>
                    <tr>
                        <td>35 to 39.9</td>
                        <td style="color:brown;">Obesity (Class 2)</td>
                    </tr>
                    <tr>
                        <td>40 and above</td>
                        <td style="color:brown;">Severe obesity (Class 3)</td>
                    </tr>
                </table>
                <div class="information">
                    <div class="ok">Understanding BMI</div>
                    <p>The Body Mass Index (BMI) is a simple and widely used method for estimating body fat based on an individual's weight and height. It is calculated using the formula:</p>
                    <p><strong>BMI = weight (kg) / height (m)^2</strong></p>   
                </div>
            </div>
        </div>
    </section>

        <section id="Calorie" class="Calorie">
                 <!-- Here is the div of Calorie Calculator using Harris-Benedict Equation ...... -->
            <div class="container2">
                <div class="calculator2">
                    <h2 style="text-align: center;">Calorie Calculator</h2>
                    <form onsubmit="return calculateCalories(event)">
                        <label for="weight">Weight (kg):</label>
                        <input type="number" id="weight" name="weight" min="0" required><br>
                        
                        <label for="height">Height (cm):</label>
                        <input type="number" id="height" name="height" min="0" required><br>
                        
                        <label for="age">Age (years):</label>
                        <input type="number" id="age" name="age" min="0" placeholder="Efficient for age (18 - 60)" required><br>
                        
                        <label for="gender">Gender:</label>
                        <select id="gender" name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select><br>
                        
                        <label for="activity_level">Activity Level:</label>
                        <select id="activity_level" name="activity_level" required>
                            <option value="sedentary">Sedentary (little or no exercise)</option>
                            <option value="lightly_active">Lightly active (light exercise/sports 1-3 days/week)</option>
                            <option value="moderately_active">Moderately active (moderate exercise/sports 3-5 days/week)</option>
                            <option value="very_active">Very active (hard exercise/sports 6-7 days a week)</option>
                            <option value="super_active">Super active (very hard exercise/sports and a physical job)</option>
                        </select><br>
                        
                        <input type="submit" value="Calculate">
            
                        <div class="second">
                            <b>Your Calorie Calculation is : </b><span id="results"></span>
                        </div>
                    </form><br>
                    <a href="Harris_Benedict_Info.php">Click here to know more about the information</a>
                </div>  
                </div>
        </section>

        <section id="UserProfile" class="UserProfile">
        <div class="form-container">
        <h1><u>Create Your Profile</u></h1>
        <h3>**Please Provide valid informations for best results !</h3>
        <form action="recommendation.php" method="post">
            <!-- Name, Age, Gender -->
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="userage" name="userage" placeholder="Enter your age" required min="15" max="150">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <!-- <option value="other">Other</option> -->
                    </select>
                </div>
            </div>

            <!-- Height, Weight, Activity Level -->
            <div class="form-row">
                <div class="form-group">
                    <label for="height">Height (cm)</label>
                    <input type="number" id="userheight" name="userheight" placeholder="Enter height" required min="50" max="250"> 
                    <!-- Assuming reasonable limits, based on some research on the internet..... -->
                </div>

                <div class="form-group">
                    <label for="weight">Weight (kg)</label>
                    <input type="number" id="userweight" name="userweight" placeholder="Enter weight" required min="25" max="350">
                    <!-- Assuming reasonable limits, based on some research on the internet.... -->
                </div>

                <div class="form-group">
                    <label for="activity">Activity Level</label>
                    <select id="activity" name="activity" required>
                        <option value="" disabled selected>Select activity level</option>
                        <option value="sedentary">Sedentary (Little or no exercise)</option>
                        <option value="light">Light (Exercise 1-3 days/week)</option>
                        <option value="moderate">Moderate (Exercise 3-5 days/week)</option>
                        <option value="active">Active (Exercise 6-7 days/week)</option>
                        <option value="superactive">Super active (very hard exercise)</option>
                    </select>
                </div>
            </div>

            <!-- Goal and Dietary Preference -->
            <div class="form-row">
                <div class="form-group">
                    <label for="goal">Goal</label>
                    <select id="goal" name="goal" required>
                        <option value="" disabled selected>Select goal</option>
                        <option value="maintain_weight">Maintain Weight</option>
                        <option value="weight_loss">Weight Loss</option>
                        <option value="weight_gain">Weight Gain</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dietary">Dietary Preference</label>
                    <select id="dietary" name="dietary" required>
                        <option value="" disabled selected>Select dietary preference</option>
                        <option value="any">Any (both veg and non-veg)</option> <!--For users that prefer both veg and non veg -->
                        <option value="vegetarian">Vegetarian</option>
                        <option value="vegan">Vegan</option>
                        <option value="non_vegetarian">Non-Vegetarian</option>
                       
                    </select>
                </div>
            </div>

            <!-- Health Condition -->
            <div class="form-row">
                <div class="form-group">
                    <label for="health">Health Condition /Disease</label>
                    <select id="health" name="health" placeholder="Select Health Condition" required>
                        <option value="" disabled selected>Select health condition(Any diseases)</option>
                        <option value="none">None</option>
                        <option value="diabetes">Diabetes</option>
                        <option value="kidney_disease">Kidney Disease</option>
                        <option value="heart_disease">Heart Disease</option>
                        <option value="hypertension">Hypertension</option>
                        <option value="asthma">Asthma</option>
                        <option value="acne">Acne</option>
                        <option value="hypercholesterolemia">Hypercholesterolemia</option>
                        <option value="high_blood_pressure">High Blood Pressure</option>
                        <option value="low_blood_pressure">Low Blood Pressure</option>
                        <option value="jaundice">Jaundice</option> 
                    </select>
                </div>
            </div>

            <div class="form-group">
                <button type="submit">Start Your Journey</button>
            </div>
        </form>
    </div>
        </section>

        <section id="Feedback" id="Feedback">
            <div class="feedback-container">
                <h2>We would appreciate your feedback !</h2>
                <form action="user_feedback_register.php" method="post" class="feedback-form">
                    <label for="email">Email Address :</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly required>
        
                    <label for="feedback">Your Feedback :</label>
                    <textarea id="feedback" name="feedback" placeholder="Write your feedback here..." rows="6" required></textarea>
                    <button type="submit" name="submit">Submit Feedback</button>
                </form>
            </div>
        </section>
</body>
</html>
