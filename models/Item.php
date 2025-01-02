<?php

class Item {

    private $conn;

    private $item_id;
    private $item_code;
    private $item_name;
    private $category;
    private $subcategory;
    private $quantity;
    private $unit_price;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Setters for the item properties
    public function setItemId($id) {
        $this->item_id = $id;
    }

    public function setItemCode($code) {
        $this->item_code = $code;
    }

    public function setItemName($name) {
        $this->item_name = $name;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setSubcategory($subcategory) {
        $this->subcategory = $subcategory;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setUnitPrice($price) {
        $this->unit_price = $price;
    }

    public function addItem() {
        $query = "INSERT INTO item (item_code, item_category, item_subcategory, item_name, quantity, unit_price)
                  VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->conn->error);
        }

        $stmt->bind_param("ssssss", $this->item_code, $this->category, $this->subcategory, $this->item_name, $this->quantity, $this->unit_price);

        return $stmt->execute();
    }

    public function updateItem() {
        $query = "UPDATE item 
                  SET item_code = ?, item_name = ?, item_category = ?, item_subcategory = ?, quantity = ?, unit_price = ? 
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        // Convert quantity and unit_price to correct types
        $quantity = (int) $this->quantity;
        $unit_price = (float) $this->unit_price;

        // Bind parameters to the query
        $stmt->bind_param("ssssidi", $this->item_code, $this->item_name, $this->category, $this->subcategory, $quantity, $unit_price, $this->item_id);

        return $stmt->execute();
    }

    // Delete an item from the database
    public function deleteItem() {
        $query = "DELETE FROM item WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->item_id);

        return $stmt->execute();
    }


    public function getAllItems() {
        $query = "SELECT item_code, item_name, item_category, item_subcategory, quantity, unit_price FROM item";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC); 
    }
}
?>
