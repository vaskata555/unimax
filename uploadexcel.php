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
            $productQuery = "INSERT INTO images3 (code, image, file_name, uploaded, short_desc, price, long_desc, title, brand, category_id, subcategory_id) VALUES ('$code', '$image', '$filename', '$uploaded', '$short_desc', '$price', '$long_desc', '$title','$brand', '$category_id', '$subcategory_id')";

            $result = mysqli_query($db, $productQuery);
        }

        $_SESSION['message'] = "Successfully Imported";
        header('Location: upload.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Invalid File";
        header('Location: upload.php');
        exit(0);
    }
}
?>