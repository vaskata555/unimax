<?php
session_start();
require_once 'templates/dbConfig.php';

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = IOFactory::load($inputFileNamePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];
        $headerRow = $worksheet->getRowIterator(1)->current();
        $columnTitles = [];
        foreach ($headerRow->getCellIterator() as $cell) {
            $columnTitles[] = $cell->getValue();
        }

        $rowData = [];
        $skippedCount = 0;
        foreach ($worksheet->getRowIterator(2) as $row) {
            $rowData[] = array_combine($columnTitles, iterator_to_array($row->getCellIterator()));
        }

        foreach ($rowData as $row) {
            $code = $row['code'];
            $image = $row['image'];
            $filename = $row['file_name'];
            $uploaded = $row['uploaded'];
            $short_desc = $row['short_desc'];
            $price = $row['price'];
            $long_desc = $row['long_desc'];
            $title = $row['title'];
            $brand = $row['brand'];
            $category_id = $row['category_id'];
            $subcategory_id = $row['subcategory_id'];

            // Check if the code exists in the database
            $checkQuery = "SELECT * FROM images3 WHERE code = '$code'";
            $checkResult = mysqli_query($db, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                // If the code exists, update the corresponding row
                $updateQuery = "UPDATE images3 SET image = '$image', file_name = '$filename', uploaded = '$uploaded', short_desc = '$short_desc', price = '$price', long_desc = '$long_desc', title = '$title', brand = '$brand', category_id = '$category_id', subcategory_id = '$subcategory_id' WHERE code = '$code'";
                $result = mysqli_query($db, $updateQuery);
            } else {
                // If the code doesn't exist, increment the skipped count
                $skippedCount++;
            }
        }

        $_SESSION['message'] = "Successfully Imported. Skipped $skippedCount lines.";
        header('Location: upload.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Invalid File";
        header('Location: upload.php');
        exit(0);
    }
}
?>