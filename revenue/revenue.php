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
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Revenue Report</h1>
    
    <table>
        <thead>
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
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>