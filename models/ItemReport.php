<?php

require_once '../config/db.php';

class ItemReportModel {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getItemReport() {
        $sql = "
            SELECT 
                i.item_name,
                ic.category AS item_category,
                isc.sub_category AS item_subcategory,
                i.quantity AS item_quantity
            FROM 
                item i
            JOIN 
                item_category ic ON i.item_category = ic.id
            JOIN 
                item_subcategory isc ON i.item_subcategory = isc.id
            GROUP BY 
                i.item_name, ic.category, isc.sub_category, i.quantity
            ORDER BY 
                i.item_name
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        $result = $stmt->get_result();
        $items = [];

        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        return $items;
    }
}

?>
