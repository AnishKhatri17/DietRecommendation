<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Health Diet Recommendation System </title>
    <link rel="stylesheet" href="style.css">
     <!-- Add this link to include Unicons -->
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script>
        function calculateBMI(event) 
        {
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

</head>

<body>
    <header>
        <nav>
            <div class="logo">Health Diet Recommendation System</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <a href="#signup" class="cta">Get Started</a>
        </nav>
    </header>
    <marquee style="margin-top: 0px; margin-bottom: -20px; background-color: yellow; size: 40px; height: 45px; " scrollamount="12">
           <p style="color: blue; font-size: 23px;"><b><i>Greetings ! Welcome to Health Diet Recommendation System.</i></b></p>
    </marquee>

    <section id="home" class="hero">
        <div class="hero-content">
            <h1></h1>
            <p>Your personalized diet plan to achieve your health goals.</p>
            <a href="#signup" class="cta">Get Started</a>
        </div>
    </section>

    
    <section id="about" class="about">
        <div class="about-container">
            <div class="about-image">
                <img src="images/Fitnessmodel.jpg" alt="Fitness Model Image">
            </div>
        
        <div class="about-text">
            <h2 style="margin-top: -15px;">About Us</h2><br>
            <p>Our Health Diet Recommendation System helps you to lose, gain, or maintain weight with personalized diet plans.
               I'm Anish Khatri a student of BCA currently studying in 6th semester. I love outdoor games and sports and I want to maintain a good fitness for better results. There is a popular saying that "Health is Wealth". The reason behind my good fitness is the foods that I consume. Healthy foods leads to Healthy Lifestyle. Better food eating habits makes us more concious about our decisions and better results.
               <br><br>   
            </p>
           
            <p style="font-size:30px">
                <b>Some of the benefits of eating healthy foods are : </b>
            </p>
            <div class="align">
                <li style="text-align: justify; font-size: 16px;"><b>Improved Heart Health</b></li>
                <li style="text-align: justify;"><b>Reduced cancer risk</b></li>
                <li style="text-align: justify;"><b>Improved gut health</b></li>
                <li style="text-align: justify;"><b>Improved memory</b></li>
                <li style="text-align: justify;"><b>Weight loss and gain</b></li>
                <li style="text-align: justify;"><b>Diabetes management</b></li>
                <li style="text-align: justify;"><b>Strong bones and teeth</b></li>
                <li style="text-align: justify;"><b>Getting better sleep</b></li>
            </div>
               <!-- <p style="text-align: center;">
               <br> Courtesy -> <a href="https://www.medicalnewstoday.com/" target="_blank">https://www.medicalnewstoday.com/articles/322268</a>
            </p> -->
        </div> 
    </div>  
    </section>

    <section id="features" class="features">
        <h2>Features</h2>
        <div class="feature" style="margin-bottom: -35px;">
            <h3>For personalized plans please check your BMI here :</h3>
        </div>

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
            </div><br>
            <a href="Unit_Converter.php">Click here for unit converter</a>
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
            <p style="margin-top: -40px; margin-bottom: 20px; ">Get diet plans tailored to your specific needs and goals.</p>
       
        <div class="feature-section">   
            <div class="healthy-eating-container">
          <p class="section-title"><strong>Benefits of Eating Healthy</strong></p>
          <div class="feature-grid">

            <div class="feature-item">
              <h3>Boosts Energy</h3>
              <p>A healthy diet provides essential nutrients that increase your energy levels and keep you active throughout the day.</p>
            </div>

            <div class="feature-item">
              <h3>Strengthens Immunity</h3>
              <p>Eating a variety of nutrient-rich foods strengthens your immune system and helps prevent diseases.</p>
            </div>

            <div class="feature-item">
              <h3>Improves Mental Health</h3>
              <p>Consuming a balanced diet helps improve mood and reduces stress, contributing to better mental well-being.</p>
            </div>

            <div class="feature-item">
              <h3>Maintains Healthy Weight</h3>
              <p>Eating balanced meals helps in maintaining a healthy weight and reduces the risk of chronic diseases like obesity and diabetes.</p>
            </div>

            <div class="feature-item">
                <h3>Improves Digestion</h3>
                <p>Including fiber-rich foods in your diet supports digestive health and prevents issues like constipation.</p>
            </div>

          </div>
        </div>

        </div>
        <p style="margin-top: 10px; margin-bottom: 20px; ">Access advice from nutrition experts to help you stay on track.</p>
        <div class="feature">
            <h3 style="margin-top: 50px;">"Food Details and their Nutritional Values"</h3>
            <p style="margin-top: 10px; font-size: 30px;"><strong><u>High Nutrition Fruits</u></strong></p>
            <p>According to the web, here are the top fruits having high nutritions. The nutrition values are calculated on the basis of reliable source USDA (U.S. Department of Agriculture).</p>
            <div class="fruitcontainer">
                <!-- First Food Item -->
                <div class="food-item">
                    <img src="images/fruits_photo/apple.jpg" alt="Apple Photo" class="food-image">
                    <div class="food-details">
                        <h2>Apple</h2> <h4>(Per 200 grams)</h4>
                        <p><strong>Calories:</strong> 104 kcal</p>
                        <p><strong>Carbohydrates:</strong> 27.58 grams</p>
                        <p><strong>Protein:</strong> 0.52 grams</p>
                        <p><strong>Potassium:</strong> 214 mg</p>
                        <p><strong>Calcium:</strong> 14 mg</p>
                        <p><strong>Vitamin C:</strong> 8.4 mg</p>
                        <p><strong>Water Content:</strong> 160-170 grams</p>
                    </div>
                </div>
                
                <!-- Second Food Item -->
                <div class="food-item">
                    <img src="images/fruits_photo/blueberries.jpg" alt="Blueberries Photo" class="food-image">
                    <div class="food-details">
                        <h2>Blueberries</h2> <h4>(Per 200 grams)</h4>
                        <p><strong>Calories:</strong> 114 kcal</p>
                        <p><strong>Carbohydrates</strong> 28.5 grams</p>
                        <p><strong>Protein:</strong> 1.5 grams</p>
                        <p><strong>Potassium:</strong> 180 mg (5% Daily Value)</p>
                        <p><strong>Calcium:</strong> 18 mg (2% Daily Value)</p>
                        <p><strong>Vitamin C:</strong> 28.8 mg (48% Daily Value)</p>
                        <p><strong>Water Content:</strong> 180 grams</p>
                    </div>
                </div>
        
                 <!-- Third Food Item -->
                <div class="food-item">
                    <img src="images/fruits_photo/avocado.jpeg" alt="Avocado Photo" class="food-image">
                    <div class="food-details">
                        <h2>Avocado</h2> <h4>(Per 200 grams)</h4>
                        <p><strong>Calories:</strong> 320 kcal</p>
                        <p><strong>Carbohydrates:</strong> 17 grams</p>
                        <p><strong>Protein:</strong> 4 grams</p>
                        <p><strong>Potassium:</strong> 975 mg</p>
                        <p><strong>Calcium:</strong> 24 mg (2% Daily Value)</p>
                        <p><strong>Sodium :</strong> 14 mg</p>
                        <p><strong>Water Content:</strong> 150 grams</p>
                    </div>
                </div>

                
                 <!-- Fourth Food Item -->
                 <div class="food-item">
                    <img src="images/fruits_photo/strawberry.jpg" alt="Strawberry Photo" class="food-image">
                    <div class="food-details">
                        <h2>Strawberry</h2> <h4>(Per 200 grams)</h4>
                        <p><strong>Calories:</strong> 64 kcal</p>
                        <p><strong>Carbohydrates:</strong> 15.4 grams</p>
                        <p><strong>Protein:</strong> 1.4 grams</p>
                        <p><strong>Potassium:</strong> 306 mg</p>
                        <p><strong>Calcium:</strong> 28 mg</p>
                        <p><strong>Vitamin C:</strong> 118 mg (197% Daily Value)</p>
                        <p><strong>Water Content:</strong> 158.2 grams</p>
                    </div>
                </div>

                <!-- Fifth Food Item -->
                <div class="food-item">
                    <img src="images/fruits_photo/banana.jpg" alt="Banana Photo" class="food-image">
                    <div class="food-details">
                        <h2>Banana</h2> <h4>(Per 200 grams)</h4>
                        <p><strong>Calories:</strong> 180 kcal</p>
                        <p><strong>Carbohydrates:</strong> 46.1 grams</p>
                        <p><strong>Protein:</strong> 2.2 grams</p>
                        <p><strong>Potassium:</strong> 806 mg</p>
                        <p><strong>Calcium:</strong> 18-20 mg</p>
                        <p><strong>Vitamin C:</strong> 20.8 mg</p>
                        <p><strong>Water Content:</strong> 150-160 grams</p>
                    </div>
                </div>
                <!-- Add more fruits items here -->
            </div>
            <p>NOTE : These values can vary slightly depending on the exact variety and preparation of the food.</p>
        </div>

        <p style="margin-top: 50px; font-size: 30px;"><strong><u>High Nutrition Vegetables</u></strong></p>
        <p >According to the web, here are the top vegetables having high nutritions. The nutrition values are calculated on the basis of reliable source USDA (U.S. Department of Agriculture).</p>
        <div class="vegetablescontainer">
            <!-- First Vegetable Item -->
            <div class="food-item">
                <img src="images/vegetables_photo/brocolli.jpg" alt="Brocolli Photo" class="food-image">
                <div class="food-details">
                    <h2>Brocolli</h2> <h4>(Per 200 grams)</h4>
                    <p><strong>Calories:</strong> 68 kcal</p>
                    <p><strong>Carbohydrates:</strong> 13.2 grams</p>
                    <p><strong>Protein:</strong> 5.6 grams</p>
                    <p><strong>Potassium:</strong> 638 mg</p>
                    <p><strong>Calcium:</strong> 86 mg</p>
                    <p><strong>Vitamin C:</strong> 181 mg</p>
                    <p><strong>Iron:</strong> 1.4 mg</p>
                </div>
            </div>

             <!-- Second Vegetable Item -->
             <div class="food-item">
                <img src="images/vegetables_photo/carrots.jpg" alt="Carrot Photo" class="food-image">
                <div class="food-details">
                    <h2>Carrots</h2> <h4>(Per 200 grams)</h4>
                    <p><strong>Calories:</strong> 82 kcal</p>
                    <p><strong>Carbohydrates:</strong> 19 grams</p>
                    <p><strong>Protein:</strong> 1.5 grams</p>
                    <p><strong>Potassium:</strong> 500 mg</p>
                    <p><strong>Calcium:</strong> 54 mg</p>
                    <p><strong>Vitamin C:</strong> 8.4 mg</p>
                    <p><strong>Iron:</strong> 0.6 mg</p>
                </div>
            </div>

             <!-- Third Vegetable Item -->
             <div class="food-item">
                <img src="images/vegetables_photo/mushroom.webp" alt="Mushroom Photo" class="food-image">
                <div class="food-details">
                    <h2>Mushroom</h2> <h4>(Per 200 grams)</h4>
                    <p><strong>Calories:</strong> 34 kcal</p>
                    <p><strong>Carbohydrates:</strong> 6.6 grams</p>
                    <p><strong>Protein:</strong> 3.2 grams</p>
                    <p><strong>Potassium:</strong> 561 grams</p>
                    <p><strong>Calcium:</strong> 6 mg</p>
                    <p><strong>Iron:</strong> 0.6 mg</p>
                    <p><strong>Water Content:</strong> Approx 180 grams</p>
                </div>
            </div>

             <!-- Fourth Vegetable Item -->
             <div class="food-item">
                <img src="images/vegetables_photo/tomatoes.jpg" alt="Tomato Photo" class="food-image">
                <div class="food-details">
                    <h2>Tomatoes</h2> <h4>(Per 200 grams)</h4>
                    <p><strong>Calories:</strong> 36 kcal</p>
                    <p><strong>Carbohydrates:</strong> 7.6 grams</p>
                    <p><strong>Protein:</strong> 1.6 grams</p>
                    <p><strong>Potassium:</strong> 429 mg</p>
                    <p><strong>Calcium:</strong> 24 mg</p>
                    <p><strong>Vitamin C:</strong> 22.2 mg</p>
                    <p><strong>Iron:</strong> 0.7 mg</p>
                </div>
            </div>

            <!-- Fifth Vegetable Item -->
            <div class="food-item">
                <img src="images/vegetables_photo/spinach.png" alt="Spinach Photo" class="food-image">
                <div class="food-details">
                    <h2>Spinach</h2> <h4>(Per 200 grams)</h4>
                    <p><strong>Calories:</strong> 46 kcal</p>
                    <p><strong>Carbohydrates:</strong> 7.4 grams</p>
                    <p><strong>Protein:</strong> 5.4 grams</p>
                    <p><strong>Potassium:</strong> 558 mg</p>
                    <p><strong>Calcium:</strong> 146 mg</p>
                    <p><strong>Vitamin C:</strong> 28.1 mg</p>
                    <p><strong>Iron:</strong> 3.5 mg</p>
                </div>
            </div>

             <!-- Add more vegetable items here -->
             
        </div>
        <p>NOTE : These values can vary slightly depending on the exact variety and preparation of the food.</p>

        <p style="margin-top: 50px; font-size: 30px;"><strong><u>High Nutrition Non-Veg Foods</u></strong></p>
            <p>According to the web, here are the top non-veg foods having high nutritions. The nutrition values are calculated on the basis of reliable source USDA (U.S. Department of Agriculture).</p>
        <div class="non_vegcontainer">
            <!-- First Meat Item -->
            <div class="food-item">
                <img src="images/non_veg_photos/salmon.jpg" alt="Salmon Photo" class="food-image">
                <div class="food-details">
                    <h2>Salmon</h2> <h4>(Per 200 grams)</h4>
                    <p><strong>Calories:</strong> 367 kcal</p>
                    <p><strong>Total Fat:</strong> 23.0 grams</p>
                    <p><strong>Protein:</strong> 39.4 grams</p>
                    <p><strong>Potassium:</strong> 708 mg</p>
                    <p><strong>Calcium:</strong> 21 mg (2% Daily Value)</p>
                    <p><strong>Magnesium:</strong> 53 mg (13% Daily Value)</p>
                    <p><strong>Iron:</strong> 0.8 mg </p>
                </div>
            </div>

             <!-- Second Meat Item -->
             <div class="food-item">
                <img src="images/non_veg_photos/chickenbreast.webp" alt="Chickenbreast Photo" class="food-image">
                <div class="food-details">
                    <h2>Chicken Breast</h2> <h4>(Per 200 grams)</h4>
                    <p><strong>Calories:</strong> 330 kcal</p>
                    <p><strong>Total Fat:</strong> 7.4 grams</p>
                    <p><strong>Protein:</strong> 62.8 grams</p>
                    <p><strong>Potassium:</strong> 618 mg</p>
                    <p><strong>Calcium:</strong> 14 mg</p>
                    <p><strong>Cholesterol:</strong> 164 mg</p>
                    <p><strong>Iron:</strong> 1.2 mg</p>
                </div>
            </div>

             <!-- Third Meat Item -->
             <div class="food-item">
                <img src="images/non_veg_photos/eggs.jpg" alt="Eggs Photo" class="food-image">
                <div class="food-details">
                    <h2>Chicken Eggs</h2> <h4>(Per 200 grams)</h4>
                    <p><strong>Calories:</strong> 286 kcal</p>
                    <p><strong>Total Fat:</strong> 20.0 grams</p>
                    <p><strong>Protein:</strong> 25.6 grams</p>
                    <p><strong>Potassium:</strong> 278 mg</p>
                    <p><strong>Calcium:</strong> 114 mg</p>
                    <p><strong>Cholesterol:</strong> 744 mg</p>
                    <p><strong>Iron:</strong> 3.0 mg</p>
                </div>
            </div>

             <!-- Fourth Meat Item -->
             <div class="food-item">
                <img src="images/non_veg_photos/turkey.jpg" alt="Turkey Photo" class="food-image">
                <div class="food-details">
                    <h2>Turkey(cooked)</h2> <h4>(Per 200 grams)</h4>
                    <p><strong>Calories:</strong> 254 kcal</p>
                    <p><strong>Total Fat:</strong> 13.4 grams</p>
                    <p><strong>Protein:</strong> 30.8 grams</p>
                    <p><strong>Potassium:</strong> 578 mg</p>
                    <p><strong>Calcium:</strong> 14 mg</p>
                    <p><strong>Cholesterol:</strong> 103 mg</p>
                    <p><strong>Iron:</strong> 1.8 mg</p>
                </div>
            </div>

            <!-- Fifth Meat Item -->
            <div class="food-item">
                <img src="images/non_veg_photos/tuna.jpg" alt="TunaFish Photo" class="food-image">
                <div class="food-details">
                    <h2>Tuna</h2> <h4>(Per 200 grams)</h4>
                    <p><strong>Calories:</strong> 224 kcal</p>
                    <p><strong>Total Fat:</strong> 1.6 grams</p>
                    <p><strong>Protein:</strong> 48.6 grams</p>
                    <p><strong>Potassium:</strong> 620 mg</p>
                    <p><strong>Calcium:</strong> 10 mg</p>
                    <p><strong>Cholesterol:</strong> 95 mg</p>
                    <p><strong>Iron:</strong> 1.0 mg</p>
                </div>
            </div>

             <!-- Add more non-vegetable, meat items here -->
        </div>
        <p>NOTE : These values can vary slightly depending on the exact variety and preparation of the food and any additional ingredients used.
        </p>

        <p style="margin-top: 50px; font-size: 30px;"><strong><u>Daily Water Intake For A Healthy Life</u></strong></p>
        <p>"The human body can last weeks without food, but only days without water."</p>
        <div class="watercontainer">
            <div class="age-group">
                <div class="glass">
                    <div class="water" style="height: 20%;"></div>
                </div>
                <h3>1-3 Years (Children)</h3>
                <p>1.3 - 2.1 liters (per day)</p>
            </div>
            
            <div class="age-group">
                <div class="glass">
                    <div class="water" style="height: 30%;"></div>
                </div>
                <h3>4-8 Years (Children)</h3>
                <p>1.7 - 2.4 liters (per day)</p>
            </div>
            
            <div class="age-group">
                <div class="glass">
                    <div class="water" style="height: 40%;"></div>
                </div>
                <h3>9-13 Years (Adolescents)</h3>
                <p>2.4 - 3.3 liters (per day)</p>
            </div>
            
            <div class="age-group">
                <div class="glass">
                    <div class="water" style="height: 70%;"></div>
                </div>
                <h3>14-18 Years (Teen Boys)</h3>
                <p>3.3 - 3.7 liters (per day)</p>
            </div>
            
            <div class="age-group">
                <div class="glass">
                    <div class="water" style="height: 40%;"></div>
                </div>
                <h3>14-18 Years (Teen Girls)</h3>
                <p>2.3 - 2.7 liters (per day)</p>
            </div>
            
            <div class="age-group">
                <div class="glass">
                    <div class="water"></div>
                </div>
                <h3>Adults (Men)</h3>
                <p>3.7 liters (per day)</p>
            </div>
            
            <div class="age-group">
                <div class="glass">
                    <div class="water"></div>
                </div>
                <h3>Adults (Women)</h3>
                <p>2.7 liters (per day)</p>
            </div>
        </div>
        <p>NOTE : The above data are collected from reliable sources from the web. The daily water intake can vary depending upon the weather you live in, your lifestyle, how active you are, etc. For example, a pregnant or breastfeeding woman will require more amount of water intake daily than any normal adult woman.
        </p>
    </section>

    <section id="contact" class="contact">
        <h2>Contact Us</h2>
               <div class="contact-info">
                   <h2>Find Me <i class="uil uil-corner-right-down"></i></h2>
                   <p><i class="uil uil-envelope"></i> Email: anish.khatri.135@gmail.com</p>
                   <p><i class="uil uil-phone"></i> Mob: 9810134686</p>
               </div>
        
        <p>Have questions? Reach out to us at <b>anish.khatri.135@gmail.com</b></p>
    </section>

    <section id="signup" class="signup">
        <!-- starting php session to store the username and password variables in session -->
        <?php 
        // session_start();
        $message='';
        if(isset($_SESSION['alert_message']))
    {
        $message = 'Username and Password Already Exists ! \nThe email or username you inserted is already in use.\nPlease Try again. ' ;
    }
    
    ?>
        <h2>Get Started</h2>
        <p>Sign up today to begin your journey to better health !</p>
       
        <!-- <h3 align="center"> <?php // echo $message ;?> </h3><br> --> 
         
            <!-- Display JavaScript alert if there's a message -->
            <?php 
                if (!empty($message)): // colon indicates the beginning of the block.
                // this block ensures the alert is only shown if there is a message. this triggers the script
            ?>
        <script>
            alert("<?php echo $message; ?>");
        </script>
                <?php 
                    endif; 
                    // endif keyword is used to close the conditional block.
                ?>

        <form action ="registercode.php" method ="POST"  id="myForm">
            <input type="text" name="uname" id="username" placeholder="Enter your username" required style="border: 1px solid black;"><br>
            <input type="password" name="pwd" id="password" placeholder="Enter your password" required style="border: 1px solid black;"><br>
            <input type="password" name="confirm_pwd" id="con_password" placeholder="Re-enter your password" required style="border: 1px solid black;"><br>
            <input type="email" name="email" id="email" placeholder="Enter your valid email" required style="border: 1px solid black;"><br>
            <input type="number" name="phone" id="phone" placeholder="Enter your phone number" required style="border: 1px solid black;">
            <button type="submit" name ="submit" value="submit">Sign Up</button>  
        </form>  
   
        <!-- Closing the Session in php -->
        <?php 
            unset($_SESSION['alert_message']);
        ?>

    </section>

    <p style="text-align: center; margin-top: -20px;">Already have an account ?</p>
<div class="centerbutton">
        <a href="User_Login.php" class="userbutton">Login as User</a>
        <a href="Admin_Login.php" class="adminbutton">Login as Admin</a>
</div>

    <footer>
        <p>2024 Health Diet Recommendation System. Copyright &copy;&nbsp;<a href="#home" style="color:aquamarine">Anish Khatri</a>&nbsp;&nbsp;- All rights reserved. </p>
    </footer>
</body>
</html>

