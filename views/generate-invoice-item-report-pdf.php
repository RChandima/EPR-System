<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../libs/fpdf/fpdf.php';
include_once '../config/db.php';     
include_once '../models/InvoiceItemReport.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $startDate = $_POST['start_date'] ?? null;
    $endDate = $_POST['end_date'] ?? null;

    if ($startDate && $endDate) {
        $database = new Database();
        $conn = $database->getConnection();
        $invoiceItemReport = new InvoiceItemReport($conn);

        $report = $invoiceItemReport->getInvoicesWithItemDetails($startDate, $endDate);

        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(200, 10, 'Invoice Item Report', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(10);  // Line break
        $pdf->Cell(200, 10, "Date Range: $startDate to $endDate", 0, 1, 'C');

        // Table headers
        $pdf->Ln(10);
        $pdf->Cell(30, 10, 'Invoice No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Date', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Customer Name', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Item Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Item Code', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Category', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Unit Price', 1, 1, 'C');

        // Table rows (populate with fetched invoice item data)
        $pdf->SetFont('Arial', '', 12);
        foreach ($report as $row) {
            $pdf->Cell(30, 10, $row['invoice_no'], 1, 0, 'C');
            $pdf->Cell(30, 10, $row['invoiced_date'], 1, 0, 'C');
            $pdf->Cell(50, 10, $row['customer_name'], 1, 0, 'C');
            $pdf->Cell(40, 10, $row['item_name'], 1, 0, 'C');
            $pdf->Cell(30, 10, $row['item_code'], 1, 0, 'C');
            $pdf->Cell(30, 10, $row['item_category'], 1, 0, 'C');
            $pdf->Cell(30, 10, number_format($row['unit_price'], 2), 1, 1, 'C');
        }

        // Output the PDF to the browser
        $pdf->Output();
        exit;
    } else {
        echo "Invalid date range provided.";
    }
}
?>
