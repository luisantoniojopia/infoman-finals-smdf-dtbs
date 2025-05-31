<?php
require_once 'db-connect.php';

$query = "
    SELECT 
        r.fld_index_revenue,
        r.fld_revenue_id,
        r.fld_date_revenue,
        c.fld_calf_id,
        p.fld_product AS product_name,
        r.fld_quantity_sold,
        up.fld_unit_product AS unit,
        up.fld_unit_price_product,
        r.fld_total_revenue,
        r.fld_cost_of_goods_sold,
        pm.fld_payment_method
    FROM tb_revenue r
    JOIN tb_calf c ON r.fld_calf_id = c.fld_index_calf
    JOIN tb_product p ON r.fld_product = p.fld_index_product
    JOIN tb_unit_price_product up ON r.fld_unit_price_product = up.fld_index_unit
    JOIN tb_payment_method pm ON r.fld_payment_method = pm.fld_index_pay
    ORDER BY r.fld_date_revenue ASC
";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Report</title>
</head>
<body class="revenue">
    <div class="container-fluid">
        <!-- Header with User Info -->
        <header class="d-flex justify-content-between align-items-center py-3 mb-4 border-bottom">
            <div class="d-flex align-items-center">
                <div class="user-icon me-3">
                    <i class="fas fa-user-circle fa-2x"></i>
                </div>
                <span class="username">Username</span>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <!-- Title and Action Buttons -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="m-0">Revenue</h1>
                <div class="action-buttons">
                    <button class="btn btn-primary me-2">
                        <i class="fas fa-plus me-1"></i> Create Record
                    </button>
                    <button class="btn btn-outline-secondary me-2">
                        <i class="fas fa-edit me-1"></i> Edit Record
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="fas fa-trash me-1"></i> Delete Record
                    </button>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="search-filter-container p-3 mb-4 bg-light rounded">
                <div class="row align-items-center">
                    <!-- Search Input -->
                    <div class="col-md-5 mb-2 mb-md-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for category, name, company, etc.">
                        </div>
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select class="form-select">
                            <option selected>Category</option>
                            <option>All</option>
                            <option>Data</option>
                        </select>
                    </div>
                    
                    <!-- Data Filter -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select class="form-select">
                            <option selected>Data</option>
                            <option>All</option>
                            <option>Recent</option>
                            <option>Oldest</option>
                        </select>
                    </div>
                    
                    <!-- Search Button -->
                    <div class="col-md-1">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Revenue Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Transaction ID</th>
                            <th>Date</th>
                            <th>Calf ID</th>
                            <th>Product</th>
                            <th>Quantity Sold</th>
                            <th>Unit Price</th>
                            <th>Total Revenue</th>
                            <th>Cost of Goods Sold</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['fld_index_revenue']); ?></td>
                                <td><?php echo htmlspecialchars($row['fld_revenue_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['fld_date_revenue']); ?></td>
                                <td><?php echo htmlspecialchars($row['fld_calf_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['fld_quantity_sold'] . ' ' . $row['unit']); ?></td>
                                <td>₱<?php echo number_format($row['fld_unit_price_product'], 2); ?></td>
                                <td>₱<?php echo number_format($row['fld_total_revenue'], 2); ?></td>
                                <td>₱<?php echo number_format($row['fld_cost_of_goods_sold'], 2); ?></td>
                                <td><?php echo htmlspecialchars($row['fld_payment_method']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>