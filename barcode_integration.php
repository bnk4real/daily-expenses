<?php
// barcode_integration.php

// Check if a barcode value is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the barcode value from the request body
    $barcode = $_POST['barcode'];

    // Process the barcode value (e.g., save it to a database or perform further actions)
    // ...

    // Send a response back to the barcode scanner app (optional)
    echo 'Barcode received and processed successfully!';
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Barcode Input</title>
    <!-- Include MDBootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/mdbootstrap@4.19.1/css/mdb.min.css" rel="stylesheet">
</head>

<body>
    <div class="container text-center">
        <h1 class="mt-5">Barcode Input</h1>
        <form action="" method="POST" class="mt-4">
            <div class="form-group">
                <label for="barcode">Scan Barcode:</label>
                <input type="text" id="barcode" name="barcode" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div style='text-align: center;'>
        <!-- insert your custom barcode setting your data in the GET parameter "data" -->
        <img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data=0987-ABCD-12345&code=&translate-esc=true' />
    </div>
    <div style='padding-top:8px; text-align:center; font-size:15px; font-family: Source Sans Pro, Arial, sans-serif;'>
        <!-- back-linking to www.tec-it.com is required -->
        <a href='https://www.tec-it.com' title='Barcode Software by TEC-IT' target='_blank'>
            TEC-IT Barcode Generator<br />
            <!-- logos are optional -->
            <img alt='TEC-IT Barcode Software' border='0' src='http://www.tec-it.com/pics/banner/web/TEC-IT_Logo_75x75.gif'>
        </a>
    </div>

    <!-- Include MDBootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/mdbootstrap@4.19.1/js/mdb.min.js"></script>
</body>

</html>