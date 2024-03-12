<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <!-- DataTables CDN links -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- Bootstrap -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<style>
    *{
        font-family: 'Kanit', sans-serif;
    }
</style>

<body>

    <!-- Bootstrap -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#transactionTable').DataTable();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const servicesDropdownBtn = document.getElementById('servicesDropdownBtn');
            const servicesDropdown = document.getElementById('servicesDropdown');

            servicesDropdownBtn.addEventListener('click', function() {
                servicesDropdown.classList.toggle('hidden');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const servicesDropdownBtn = document.getElementById('servicesDropdownBtn2');
            const servicesDropdown = document.getElementById('servicesDropdown2');

            servicesDropdownBtn.addEventListener('click', function() {
                servicesDropdown.classList.toggle('hidden');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const servicesDropdownBtn = document.getElementById('servicesDropdownBtn3');
            const servicesDropdown = document.getElementById('servicesDropdown3');

            servicesDropdownBtn.addEventListener('click', function() {
                servicesDropdown.classList.toggle('hidden');
            });
        });
    </script>



</body>

</html>