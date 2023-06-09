<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
   
    // Set column headers
    $sheet->setCellValue('A1', 'code');
    $sheet->setCellValue('B1', 'image');
    $sheet->setCellValue('C1', 'file_name');
    $sheet->setCellValue('D1', 'uploaded');
    $sheet->setCellValue('E1', 'short_desc');
    $sheet->setCellValue('F1', 'price');
    $sheet->setCellValue('G1', 'long_desc');
    $sheet->setCellValue('H1', 'title');
    $sheet->setCellValue('I1', 'brand');
    $sheet->setCellValue('J1', 'category_id');
    $sheet->setCellValue('K1', 'subcategory_id');
    // Populate the spreadsheet with data
   

    // Save the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $filename = 'defaultupload.xlsx';
    $writer->save($filename);
    if (isset($_POST['defaultexcel'])) {
        // Connect to the database using the $db variable from the header file
        require_once 'templates/dbConfig.php';
    
        // Call the function to generate and download the Excel file, passing the $db connection
        generateExcelFile($db);
    }
    ?>

