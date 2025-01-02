<?php

require_once '../config/db.php';
require_once '../models/ItemReport.php';

$database = new Database();
$conn = $database->getConnection();

$itemReportModel = new ItemReportModel($conn);

$items = $itemReportModel->getItemReport();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .container {
            display: flex;
            flex-direction: column;
            max-width: 1200px;
            height: 100%;
            margin: 0 auto;
            padding: 0;
        }

        h2 {
            margin-top: 10px;
            text-align: center;
        }

        .table-container {
            flex-grow: 1;
            overflow-y: auto;
            max-height: 500px;
        }

        .table {
            margin-bottom: 20px;
            height: auto;
        }

        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Item Report Header -->
        <h2>Item Report</h2>

        <!-- Table for Item Report -->
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($items) && count($items) > 0) {
                        foreach ($items as $item) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($item['item_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['item_category']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['item_subcategory']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['item_quantity']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No items found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
