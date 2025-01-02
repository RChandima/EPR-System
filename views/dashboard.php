<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimpleERP Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        @import url("https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap");

        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: "Montserrat", sans-serif;
        }

        .container-fluid {
            display: flex;
            flex-grow: 1;
        }

        .sidebar {
            background-color: #e0e0e0;
            padding-top: 20px;
            width: 250px;
            flex-shrink: 0;
        }

        .sidebar .tile {
            cursor: pointer;
            color: #000080;
            font-weight: 700;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background 0.3s;
            display: flex;
            align-items: center;
        }

        .sidebar .tile i {
            margin-right: 10px;
        }

        .sidebar .tile:hover {
            background-color: #000080;
            color: white;
        }

        .content-area {
            padding: 20px;
            background-color: #f8f9fa;
            flex-grow: 1;
            overflow-y: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        footer {
            background-color: #000080;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
        }

        .container-fluid {
            height: calc(100vh - 50px);
        }

    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="row" style="flex-grow: 1;">

            <div class="col-md-3 sidebar">
                <div class="tile" onclick="loadContent('customer')">
                    <i class="fas fa-user"></i> Customer
                </div>
                <div class="tile" onclick="loadContent('item')">
                    <i class="fas fa-box"></i> Item
                </div>
                <div class="tile" onclick="loadContent('invoice_report')">
                    <i class="fas fa-file-invoice"></i> Invoice Report
                </div>
                <div class="tile" onclick="loadContent('invoice_item_report')">
                    <i class="fas fa-list"></i> Invoice Item Report
                </div>
                <div class="tile" onclick="loadContent('item_report')">
                    <i class="fas fa-chart-bar"></i> Item Report
                </div>
            </div>

            <div class="col-md-9 content-area" id="content">
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        function loadContent(page) {
            fetch(page + '.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('content').innerHTML = data;
                })
                .catch(error => console.error('Error loading content:', error));
        }

        window.onload = function() {
            loadContent('customer');
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
