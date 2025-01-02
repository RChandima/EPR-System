<?php
include_once '../config/db.php';

class InvoiceItemReport {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    //Method(Create Invoice Item Reports based on Start and End date)
    public function getInvoicesWithItemDetails($startDate, $endDate) {
        $query = "
            SELECT 
                i.invoice_no,
                i.date AS invoiced_date,
                CONCAT(c.title, ' ', c.first_name, ' ', c.middle_name, ' ', c.last_name) AS customer_name,
                im.item_id,
                it.item_name,
                it.item_code,
                it.item_category,
                it.unit_price
            FROM 
                invoice i
            JOIN 
                customer c ON i.customer = c.id
            JOIN 
                invoice_master im ON i.invoice_no = im.invoice_no
            JOIN 
                item it ON im.item_id = it.id
            WHERE 
                i.date BETWEEN ? AND ?
        ";

        if ($stmt = $this->conn->prepare($query)) {

            $stmt->bind_param('ss', $startDate, $endDate);
            
            $stmt->execute();
            
            $result = $stmt->get_result();

            $report = [];
            while ($row = $result->fetch_assoc()) {
                $report[] = [
                    'invoice_no' => $row['invoice_no'],
                    'invoiced_date' => $row['invoiced_date'],
                    'customer_name' => $row['customer_name'],
                    'item_name' => $row['item_name'],
                    'item_code' => $row['item_code'],
                    'item_category' => $row['item_category'],
                    'unit_price' => $row['unit_price'],
                ];
            }

            return $report;
        } else {
            return ['error' => 'Failed to prepare the query.'];
        }
    }
}

?>
