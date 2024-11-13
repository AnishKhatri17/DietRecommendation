<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harris-Benedict Formula Information</title>
    <style>
         /*Css for the Calcorie Calculation Information div. */
         .algorithminfo
            {
                width: 100%;
                margin-left: 5%;
                /* float: center; */
                /* border: 1px solid black; */
                margin-top: 20px;
                margin-right: 30px;
                font-size: 16px;
                line-height: 1.5;
                font-family: 'Roboto', sans-serif;
                text-align: justify;
            }
            .container2
            {
                 margin-top: 0px;
                 margin-bottom: 0px;
                 display: flex;
                 justify-content: space-between;
                 align-items: flex-start;
                 max-width: 100%;
                 height: fit-content;
                 margin: 50px auto;
                 padding: 20px;
                 background-color: #fff;
                 box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                 border-radius: 8px;
            }

    </style>
</head>
<body>
    <div class="container2">
        <div class="algorithminfo">
            <p>
                <h2 style="text-align: center;"><u>Harris-Benedict Equation for Calorie Calculation</u></h2> 
                       The Harris-Benedict Equation is a widely used formula. It estimates an individual's Basel Motabolism Rate(BMR). This equation predicts the energy to maintain their body weight while at rest. It is in calories. It considers many factors such as age, gender and weight. It is key to understanding motabolic rate and daily energy use.<br>
                       The Harris-Benedict equation is thought to be the most accurate of all the BMR equations. However, you need to remember that calculating your BMR with a calculator is only a rough estimation and may differ from your actual bodily needs. The Harris-Benedict equation provides estimates, which can vary based on individual factors like body composition and metabolic rate. The equation doesn't account for differences in body composition or changes in metabolism with age. It is best suitable for age range between 18 - 60.
            </p><br>
    
            <p style="margin-top: 30px;">
                <h3 style="text-align: center; font-size: 20px;"><u>Basal Metabolic Rate (BMR)</u></h3>
                <strong>What is BMR ?</strong><br>
                Basal Metabolic Rate(BMR) is the number of calories your body needs to perform basic, life sustaining functions such as breathing, circulation, cell production and nutrient processing while at rest. It represents the minimum amount of energy required to keep your body functioning.<br><ul style="margin-bottom: 2px; margin-left: -40px;"><b>Importance of BMR : </b></ul>
                <li><strong>Weight management</strong> : Knowing your BMI helps you understand how many calories your body needs at rest. This is crucial for managing weight through diet and exercise.</li>
                <li><strong>Nutritional Planning</strong> : Helps in creating personalized diet plans to meet specific health goals like weight maintenance, weight loss and weight gain.</li>
                <li><strong>Energy Expenditure</strong> : BMR accounts for the largest portion of your total energy expenditure, making it a key factor in overall metabolism.</li><br>
                <strong>How to calculate BMR ?</strong><br>
                <b>For a Man : </b><br>
                For example:<br>
                <li>Weight : 70 kg </li>
                <li>Height : 175 cm </li>
                <li>Age : 30 years </li><br>
                BMR = 88.362 + (13.397× weight in kg) + (4.799× heigth in cm) − (5.677× age in years)<br>
                BMR = 88.362+937.79 + 839.825 − 170.31 = 1695.667 kcal/day. <br><br>
    
                <b>For a Woman : </b><br>
                For example:<br>
                <li>Weight : 60 kg </li>
                <li>Height : 160 cm </li>
                <li>Age : 25 years </li><br>
                BMR = 447.593 + (9.247× weight in kg)+(3.098× heigth in cm)−(4.330× age in years)<br>
                BMR = 447.593 + 554.82 + 495.68 − 108.25 = 1389.843 kcal/day.<br><br>
                The result gives you the number of calories your body requires per day to function at rest. To estimate your total daily energy expenditure (TDEE), you can multiply the BMR by an activity factor based on your lifestyle.
            </p><br>
    
            <p style="margin-top: 30px;">
                <h3 style="text-align: center; font-size: 20px;"><u>Total Daily Energy Expenditure (TDEE)</u></h3>
            <p style="margin-top: -15px;">To estimate daily calorie needs, multiply BMR by the activity factor:</p>
            <ul >
                <li><strong>Sedentary (little or no exercise):</strong> BMR × 1.2</li>
                <p style="margin-top: 0px; text-align: justify;" >Minimal physical activity, such as a desk job with no exercise or very little movement throughout the day.<br>Daily Routine : Most of the day is spent sitting, with occasional standing or slow walking.</p>
    
                <li><strong>Lightly Active (light exercise/sports 1-3 days/week):</strong> BMR × 1.375</li>
                <p style="margin-top: 0px; text-align: justify;">Engages in light exercise or sports 1-3 times per week, such as walking, light jogging, or casual sports.
                    <br>Daily Routine : Somewhat active with periods of light exercises, but still includes significant amounts of sitting and standings.</p>
                    
                <li><strong>Moderately Active (moderate exercise/sports 3-5 days/week):</strong> BMR × 1.55</li>
                <p style="margin-top: 0px; text-align: justify;">Performs moderate exercise or sports 3-5 times per week, such as regular gym sessions, cycling, or active sports.<br>Daily Routine : A balanced mix of activity and rest, with consistent moderate exercise several days a week.
                </p>
    
                <li><strong>Very Active (hard exercise/sports 6-7 days a week):</strong> BMR × 1.725</li>
                <p style="margin-top: 0px; text-align: justify;">Engages in hard exercise or sports almost every day of the week, such as intensive workouts, running, or competitive sports.<br>Daily Routine : Highly active with rigious workouts or physical exertion nearly everyday.
                </p>
    
                <li><strong>Extra Active (very hard exercise/physical job):</strong> BMR × 1.9</li>
                <p style="margin-top: 0px; text-align: justify;">Involves very intense exercise or has a physically demanding job, such as construction work, heavy lifting, or high-level athletic training.<br>Daily Routine : Extremely active with sustained high levels of physical activity throughout the day.
                </p>
            </ul>
            </p>
    
        </div>
    </div>

    <button style="background-color: rgb(46, 237, 224); border-radius: 10px; margin-left: 50%; width: 200px; height: fit-content; height: 50px; cursor: pointer; margin-top: -50px; font-size: 14px;"> <a href="\ProjectII\User_Dashboard.php#Calorie"> Click Here to goto Homepage</a></button>
</body>
</html>