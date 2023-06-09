<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Function to generate and download the Excel file
function generateExcelFile($db)
{
    // Fetch data from the SQL tables using JOIN
    $query = "SELECT category_subcategory.category_id, category.category_name , category_subcategory.subcategory_id, subcategory.subcategory_name
              FROM category_subcategory
              JOIN category ON category_subcategory.category_id = category.id 
              JOIN subcategory ON category_subcategory.subcategory_id = subcategory.id
              ORDER BY category_subcategory.category_id ";
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
    $sheet->setCellValue('A1', 'category_id');
    $sheet->setCellValue('B1', 'category_name');
    $sheet->setCellValue('C1', 'subcategory_id');
    $sheet->setCellValue('D1', 'subcategory_name');

    // Populate the spreadsheet with data
    $rowIndex = 2;
    foreach ($data as $rowData) {
        $sheet->setCellValue('A' . $rowIndex, $rowData['category_id']);
        $sheet->setCellValue('B' . $rowIndex, $rowData['category_name']);
        $sheet->setCellValue('C' . $rowIndex, $rowData['subcategory_id']);
        $sheet->setCellValue('D' . $rowIndex, $rowData['subcategory_name']);
        $rowIndex++;
    }

    // Save the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $filename = 'output.xlsx';
    $writer->save($filename);



    // Delete the temporary file
    
}

// Check if the button is clicked
if (isset($_POST['generate_excel'])) {
    // Connect to the database using the $db variable from the header file
    require_once 'templates/dbConfig.php';

    // Call the function to generate and download the Excel file, passing the $db connection
    generateExcelFile($db);
}
?>