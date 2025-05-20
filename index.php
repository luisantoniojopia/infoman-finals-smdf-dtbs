<?php
include('header.php');
include('navigation.php');

$pages = [
    'dashboard' => 'dashboard.php',
    'revenue' => 'revenue/revenue.php',
    'expense' => 'expense/expense.php',
    'profit' => 'profit/profit.php'
];

echo '<div class="content">';
if (isset($_GET['page']) && isset($pages[$_GET['page']])) {
    include $pages[$_GET['page']];
} else {
    echo "<p>Welcome to SMDF Database. Use the menu to navigate. </p>";
}

echo '</div>';
?>