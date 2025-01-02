<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/db.php';
require_once '../models/Customer.php';

class CustomerController {

    private $conn;
    private $customer;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();

        $this->customer = new Customer($this->conn);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'add':
                        $this->addCustomer();
                        break;
                    case 'update':
                        $this->updateCustomer();
                        break;
                    case 'delete':
                        $this->deleteCustomer();
                        break;
                    default:
                        echo "<script>alert('Invalid action.');</script>";
                        break;
                }
            }
        }
    }

    public function addCustomer() {
        $title = $_POST['title'] ?? null;
        $first_name = $_POST['first_name'] ?? null;
        $middle_name = $_POST['middle_name'] ?? null;
        $last_name = $_POST['last_name'] ?? null;
        $contact_no = $_POST['contact_no'] ?? null;
        $district = $_POST['district'] ?? null;

        if (empty($title) || empty($first_name) || empty($last_name) || empty($contact_no) || empty($district)) {
            echo "<script>alert('Error: All required fields must be filled out.');</script>";
            return;
        }

        $this->customer->setTitle($title);
        $this->customer->setFirstName($first_name);
        $this->customer->setMiddleName($middle_name);
        $this->customer->setLastName($last_name);
        $this->customer->setContactNo($contact_no);
        $this->customer->setDistrict($district);

        if ($this->customer->addCustomer()) {
            echo "<script>alert('Customer added successfully!'); window.location.href='../views/dashboard.php';</script>";
        } else {
            echo "<script>alert('Error: Could not add customer.');</script>";
        }
    }

    public function updateCustomer() {
        $customer_id = $_POST['customer_id'] ?? null;
        $title = $_POST['title'] ?? null;
        $first_name = $_POST['first_name'] ?? null;
        $middle_name = $_POST['middle_name'] ?? null;
        $last_name = $_POST['last_name'] ?? null;
        $contact_no = $_POST['contact_no'] ?? null;
        $district = $_POST['district'] ?? null;
    
        if (empty($customer_id)) {
            echo "<script>alert('Error: Customer ID is required to update.');</script>";
            return;
        }
    
        // Set the customer properties
        $this->customer->setCustomerId($customer_id);
        $this->customer->setTitle($title);
        $this->customer->setFirstName($first_name);
        $this->customer->setMiddleName($middle_name);
        $this->customer->setLastName($last_name);
        $this->customer->setContactNo($contact_no);
        $this->customer->setDistrict($district);
    
        // Perform the update
        if ($this->customer->updateCustomer($customer_id)) {
            echo "<script>alert('Customer updated successfully!'); window.location.href='../views/dashboard.php';</script>";
        } else {
            echo "<script>alert('Error: Could not update customer.');</script>";
        }
    }
    

    public function deleteCustomer() {
        $customer_id = $_POST['customer_id'] ?? null;

        if (empty($customer_id)) {
            echo "<script>alert('Error: Customer ID is required to delete.');</script>";
            return;
        }

        $this->customer->setCustomerId($customer_id);

        if ($this->customer->deleteCustomer($customer_id)) {
            echo "<script>alert('Customer deleted successfully!'); window.location.href='../views/dashboard.php';</script>";
        } else {
            echo "<script>alert('Error: Could not delete customer.');</script>";
        }
    }

    public function showAllCustomers() {
        $customers = $this->customer->getAllCustomers();
        var_dump($customers);
        echo 'Before including the customer view...';
        require_once 'http://localhost/CsquareProject/views/customer.php';
    }
}

new CustomerController();

