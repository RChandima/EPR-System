<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/db.php';
require_once '../models/Item.php';

class ItemController {

    private $conn;
    private $item;

    public function __construct() {
        // Set up database connection
        $db = new Database();
        $this->conn = $db->getConnection();

        $this->item = new Item($this->conn);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Handle form submissions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'add':
                        $this->addItem();
                        break;
                    case 'update':
                        $this->updateItem();
                        break;
                    case 'delete':
                        $this->deleteItem();
                        break;
                    default:
                        echo "<script>alert('Invalid action.');</script>";
                        break;
                }
            }
        }
    }

    public function addItem() {
        $item_code = $_POST['item_code'] ?? null;
        $item_name = $_POST['item_name'] ?? null;
        $item_category = $_POST['item_category'] ?? null;
        $item_subcategory = $_POST['item_subcategory'] ?? null;
        $quantity = $_POST['quantity'] ?? null;
        $unit_price = $_POST['unit_price'] ?? null;

        // Validate required fields
        if (empty($item_code) || empty($item_name) || empty($item_category) || empty($item_subcategory) || empty($quantity) || empty($unit_price)) {
            echo "<script>alert('All fields must be filled out.'); window.location.href='../views/dashboard.php';</script>";
            return;
        }

        // Set item properties
        $this->item->setItemCode($item_code);
        $this->item->setItemName($item_name);
        $this->item->setCategory($item_category);
        $this->item->setSubcategory($item_subcategory);
        $this->item->setQuantity($quantity);
        $this->item->setUnitPrice($unit_price);

        // Call addItem method in the Item model
        if ($this->item->addItem()) {
            echo "<script>alert('Item added successfully!'); window.location.href='../views/dashboard.php';</script>";
        } else {
            echo "<script>alert('Error: Could not add item.');</script>";
        }
    }

    public function updateItem() {
        $item_id = $_POST['item_id'] ?? null;
        $item_code = $_POST['item_code'] ?? null;
        $item_name = $_POST['item_name'] ?? null;
        $item_category = $_POST['item_category'] ?? null;
        $item_subcategory = $_POST['item_subcategory'] ?? null;
        $quantity = $_POST['quantity'] ?? null;
        $unit_price = $_POST['unit_price'] ?? null;

        // Validate required fields
        if (empty($item_id) || empty($item_code) || empty($item_name) || empty($item_category) || empty($item_subcategory) || empty($quantity) || empty($unit_price)) {
            echo "<script>alert('All fields must be filled out.');</script>";
            return;
        }

        // Set item properties
        $this->item->setItemId($item_id);
        $this->item->setItemCode($item_code);
        $this->item->setItemName($item_name);
        $this->item->setCategory($item_category);
        $this->item->setSubcategory($item_subcategory);
        $this->item->setQuantity($quantity);
        $this->item->setUnitPrice($unit_price);

        // Call updateItem method in the Item model
        if ($this->item->updateItem()) {
            echo "<script>alert('Item updated successfully!'); window.location.href='../views/dashboard.php';</script>";
        } else {
            echo "<script>alert('Error: Could not update item.');</script>";
        }
    }

    public function deleteItem() {
        $item_id = $_POST['item_id'] ?? null;

        if (empty($item_id)) {
            echo "<script>alert('Item ID is required to delete.');</script>";
            return;
        }

        // Set item ID
        $this->item->setItemId($item_id);

        // Call deleteItem method in the Item model
        if ($this->item->deleteItem()) {
            echo "<script>alert('Item deleted successfully!'); window.location.href='../views/dashboard.php';</script>";
        } else {
            echo "<script>alert('Error: Could not delete item.');</script>";
        }
    }
}
new ItemController();

?>
