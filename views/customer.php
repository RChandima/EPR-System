<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/customer_styles.css">
    <style>
        body {
            overflow: hidden;
        }

        .custom-container {
            margin: auto;
            padding-top: 10px;
            height: 110vh;
        }

        .tab-pane {
            max-height: 600px;
            overflow-y: auto;
            padding-top: 20px;
            scroll-behavior: smooth;
        }

        .tab-content {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="container custom-container">
        <ul class="nav nav-tabs" id="customerTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="add-tab" data-bs-toggle="tab" data-bs-target="#addCustomerForm"
                    type="button" role="tab">Add Customer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="update-tab" data-bs-toggle="tab" data-bs-target="#updateCustomerForm"
                    type="button" role="tab">Update Customer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="delete-tab" data-bs-toggle="tab" data-bs-target="#deleteCustomerForm"
                    type="button" role="tab">Delete Customer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="show-tab" data-bs-toggle="tab" data-bs-target="#showAllCustomers"
                    type="button" role="tab">Show All Customers</button>
            </li>
        </ul>

        <!-- Tab content for each form -->
        <div class="tab-content" id="customerTabsContent">
            <!-- Add Customer Form -->
            <div class="tab-pane fade show active" id="addCustomerForm" role="tabpanel">
                <h4 class="mt-4">Add New Customer</h4>
                <form method="POST" action="http://localhost/CsquareProject/controllers/CustomerController.php">
                    <input type="hidden" name="action" value="add">
                <div class="mb-3">
                    <label for="addTitle" class="form-label">Title</label>
                    <select class="form-select" id="addTitle" name="title" required>
                        <option value="" selected disabled>Select Title</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Miss">Miss</option>
                    </select>
                </div>
                    <div class="mb-3">
                        <label for="addFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="addFirstName" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="addMiddleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="addMiddleName" name="middle_name">
                    </div>
                    <div class="mb-3">
                        <label for="addLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="addLastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="addContactNo" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="addContactNo" name="contact_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="addDistrict" class="form-label">District</label>
                        <select class="form-select" id="addDistrict" name="district" required>
                        <option value="" selected disabled>Select District</option>
                            <option value="1">Ampara</option>
                            <option value="2">Anuradhapura</option>
                            <option value="3">Badulla</option>
                            <option value="4">Batticaloa</option>
                            <option value="5">Colombo</option>
                            <option value="6">Galle</option>
                            <option value="7">Gampaha</option>
                            <option value="8">Hambantota</option>
                            <option value="9">Jaffna</option>
                            <option value="10">Kalutara</option>
                            <option value="11">Trincomalee</option>
                            <option value="12">Kandy</option>
                            <option value="13">Kegalle</option>
                            <option value="14">Kilinochchi</option>
                            <option value="15">Kurunegala</option>
                            <option value="16">Mannar</option>
                            <option value="17">Matale</option>
                            <option value="18">Matara</option>
                            <option value="19">Moneragala</option>
                            <option value="20">Mullaitivu</option>
                            <option value="21">Nuwara Eliya</option>
                            <option value="22">Polonnaruwa</option>
                            <option value="23">Puttalam</option>
                            <option value="24">Rathnapura</option>
                            <option value="25">Vavuniya</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Save Customer</button>
                </form>

            </div>

            <!-- Update Customer Form -->
            <div class="tab-pane fade" id="updateCustomerForm" role="tabpanel">
                <h4 class="mt-4">Update Customer</h4>
                <form method="POST" action="http://localhost/CsquareProject/controllers/CustomerController.php">
                    <input type="hidden" name="action" value="update">
                    <div class="mb-3">
                        <label for="updateId" class="form-label">Customer ID</label>
                        <input type="text" class="form-control" id="updateId" name="customer_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateTitle" class="form-label">Title</label>
                        <select class="form-select" id="updateTitle" name="title">
                            <option value="" selected disabled>Select Title</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Miss">Miss</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="updateFirstName" name="first_name">
                    </div>
                    <div class="mb-3">
                        <label for="updateMiddleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="updateMiddleName" name="middle_name">
                    </div>
                    <div class="mb-3">
                        <label for="updateLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="updateLastName" name="last_name">
                    </div>
                    <div class="mb-3">
                        <label for="updateContactNo" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="updateContactNo" name="contact_no">
                    </div>
                    <div class="mb-3">
                        <label for="updateDistrict" class="form-label">District</label>
                        <select class="form-select" id="updateDistrict" name="district" required>
                        <option value="" selected disabled>Select District</option>
                            <option value="1">Ampara</option>
                            <option value="2">Anuradhapura</option>
                            <option value="3">Badulla</option>
                            <option value="4">Batticaloa</option>
                            <option value="5">Colombo</option>
                            <option value="6">Galle</option>
                            <option value="7">Gampaha</option>
                            <option value="8">Hambantota</option>
                            <option value="9">Jaffna</option>
                            <option value="10">Kalutara</option>
                            <option value="11">Trincomalee</option>
                            <option value="12">Kandy</option>
                            <option value="13">Kegalle</option>
                            <option value="14">Kilinochchi</option>
                            <option value="15">Kurunegala</option>
                            <option value="16">Mannar</option>
                            <option value="17">Matale</option>
                            <option value="18">Matara</option>
                            <option value="19">Moneragala</option>
                            <option value="20">Mullaitivu</option>
                            <option value="21">Nuwara Eliya</option>
                            <option value="22">Polonnaruwa</option>
                            <option value="23">Puttalam</option>
                            <option value="24">Rathnapura</option>
                            <option value="25">Vavuniya</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Customer</button>
                </form>
            </div>

            <!-- Delete Customer Form -->
            <div class="tab-pane fade" id="deleteCustomerForm" role="tabpanel">
                <h4 class="mt-4">Delete Customer</h4>
                <form method="POST" action="http://localhost/CsquareProject/controllers/CustomerController.php">
                <input type="hidden" name="action" value="delete">
                    <div class="mb-3">
                        <label for="deleteId" class="form-label">Customer ID</label>
                        <input type="text" class="form-control" id="deleteId" name="customer_id" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Delete Customer</button>
                </form>
            </div>

            <!-- Show All Customers Section -->
            <div class="tab-pane fade" id="showAllCustomers" role="tabpanel">
    <h4 class="mt-4">All Customers</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Contact No</th>
                <th>District</th>
            </tr>
        </thead>
        <tbody>
        <?php
            require_once '../config/db.php';
            require_once '../models/Customer.php';

            $database = new Database();
            $conn = $database->getConnection();

            $customerModel = new Customer($conn);

            $customers = $customerModel->getAllCustomers();

            if (isset($customers) && !empty($customers)) {
                foreach ($customers as $customer) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($customer->getTitle() ?? 'N/A') . "</td>";
                    echo "<td>" . htmlspecialchars($customer->getFirstName() ?? 'N/A') . "</td>";
                    echo "<td>" . htmlspecialchars($customer->getMiddleName() ?? 'N/A') . "</td>";
                    echo "<td>" . htmlspecialchars($customer->getLastName() ?? 'N/A') . "</td>";
                    echo "<td>" . htmlspecialchars($customer->getContactNo() ?? 'N/A') . "</td>";
                    echo "<td>" . htmlspecialchars($customer->getDistrict() ?? 'N/A') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No customers found</td></tr>";
            }
        ?>



</tbody>

    </table>
</div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
