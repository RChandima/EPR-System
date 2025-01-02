<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../libs/fpdf/fpdf.php';
include_once '../config/db.php';
include_once '../models/InvoiceReport.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['start_date'] ?? null;
    $endDate = $_POST['end_date'] ?? null;

    if ($startDate && $endDate) {
        $database = new Database();
        $conn = $database->getConnection();
        $invoiceReport = new InvoiceReport($conn);

        $invoices = $invoiceReport->getInvoicesWithCustomerDetails($startDate, $endDate);

        if ($invoices && count($invoices) > 0) {
            $pdf = new FPDF();
            $pdf->AddPage();  

            // Set title
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(200, 10, 'Invoice Report', 0, 1, 'C');

            // Add the date range
            $pdf->SetFont('Arial', '', 12);
            $pdf->Ln(10);  // Line break
            $pdf->Cell(200, 10, "Date Range: $startDate to $endDate", 0, 1, 'C');

            // Table headers
            $pdf->Ln(10);
            $pdf->Cell(30, 10, 'Invoice No', 1, 0, 'C');
            $pdf->Cell(30, 10, 'Date', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Customer Name', 1, 0, 'C');
            $pdf->Cell(30, 10, 'District', 1, 0, 'C');
            $pdf->Cell(30, 10, 'Item Count', 1, 0, 'C');
            $pdf->Cell(30, 10, 'Amount', 1, 1, 'C');

            // Add table rows
            $pdf->SetFont('Arial', '', 12);
            foreach ($invoices as $invoice) {
                $pdf->Cell(30, 10, $invoice['invoice_no'], 1, 0, 'C');
                $pdf->Cell(30, 10, $invoice['date'], 1, 0, 'C');
                $pdf->Cell(50, 10, $invoice['customer'], 1, 0, 'C');
                $pdf->Cell(30, 10, $invoice['district'], 1, 0, 'C');
                $pdf->Cell(30, 10, $invoice['item_count'], 1, 0, 'C');
                $pdf->Cell(30, 10, number_format($invoice['amount'], 2), 1, 1, 'C');
            }

            $pdf->Output();
            exit;
        } else {
            echo "No invoices found for the given date range.";
        }
    } else {
        echo "Invalid date range provided.";
    }
}
?>
