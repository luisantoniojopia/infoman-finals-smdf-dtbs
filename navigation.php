<div class="container">
    <nav class="sidebar">
        <ul>
            <li><a href="index.php?page=dashboard" class="<?= $currentPage === 'dashboard' ? 'active-page' : '' ?>">Dashboard</a></li>
            <li><a href="index.php?page=revenue" class="<?= $currentPage === 'revenue' ? 'active-page' : '' ?>">Revenue</a></li>
            <li><a href="index.php?page=expense" class="<?= $currentPage === 'expense' ? 'active-page' : '' ?>">Expense</a></li>
            <li><a href="index.php?page=profit" class="<?= $currentPage === 'profit' ? 'active-page' : '' ?>">Profit</a></li>
        </ul>
    </nav>
</div>