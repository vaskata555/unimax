<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Function to generate and download the Excel file
function generateExcelFilebrand($db)
{
    // Fetch data from the SQL tables using JOIN
    $query = "SELECT * FROM brands";
    $result = mysqli_query($db, $query);
    $data = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    // Create a new Excel spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $sheet->setCellValue('A1', 'id');
    $sheet->setCellValue('B1', 'brand');
    

    // Populate the spreadsheet with data
    $rowIndex = 2;
    foreach ($data as $rowData) {
        $sheet->setCellValue('A' . $rowIndex, $rowData['id']);
        $sheet->setCellValue('B' . $rowIndex, $rowData['brand']);
       
        $rowIndex++;
    }

    // Save the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $filename = 'outputbrands.xlsx';
    $writer->save($filename);



    // Delete the temporary file
    
}

// Check if the button is clicked
if (isset($_POST['generate_excel_brand'])) {
    // Connect to the database using the $db variable from the header file
    require_once 'templates/dbConfig.php';

    // Call the function to generate and download the Excel file, passing the $db connection
    generateExcelFilebrand($db);
}
?>