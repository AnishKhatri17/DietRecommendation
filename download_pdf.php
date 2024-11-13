<?php
require 'vendor/autoload.php'; // Ensure Dompdf is loaded

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['meal_plan_html'])) 
{
    $htmlContent = $_POST['meal_plan_html'];

    // Get the current date and time
    $current_datetime = date("l, F j, Y"); // Output: Wednesday, November 13, 2024 - 03:45 PM
    // We can change the format if needed

    // Add the current date and time at the top of the meal plan content
    $htmlContent = "<h2>Diet Recommendation Generated on: $current_datetime</h2>" . $htmlContent;

    // Initialize Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);

    // Load HTML content into Dompdf
    $dompdf->loadHtml($htmlContent);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Send the generated PDF to the browser for download
    $dompdf->stream("Meal_Plan.pdf", ["Attachment" => true]);
    exit;
}
?>
