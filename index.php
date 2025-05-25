<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SMDF Accounting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="wrapper d-flex">
    <?php
    $currentPage = $_GET['page'] ?? ''; // Needed for navigation highlighting
    include('navigation.php');
    ?>

    <div class="content p-4 flex-grow-1">
        <?php
        $pages = [
            'dashboard' => 'dashboard.php',
            'revenue' => 'revenue/revenue.php',
            'expense' => 'expense/expense.php',
            'profit' => 'profit/profit.php'
        ];

        if (isset($_GET['page']) && isset($pages[$_GET['page']])) {
            include $pages[$_GET['page']];
        } else {
            echo "<p>Welcome to SMDF Database. Use the menu to navigate. </p>";
        }
        ?>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>
</html>