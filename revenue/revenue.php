<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <?php
    include 'db-connect.php'; // assumes this file sets up $conn (mysqli connection)

    $query = "SELECT * FROM tb_revenue ORDER BY fld_index_revenue ASC";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    ?>

    <h2>Revenue Table</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
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
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['fld_revenue_id']) ?></td>
                    <td><?= htmlspecialchars($row['fld_date_revenue']) ?></td>
                    <td><?= htmlspecialchars($row['fld_calf_id']) ?></td>
                    <td><?= htmlspecialchars($row['fld_product']) ?></td>
                    <td><?= htmlspecialchars($row['fld_quantity_sold']) ?></td>
                    <td>₱<?= number_format($row['fld_unit_price_product'], 2) ?></td>
                    <td>₱<?= number_format($row['fld_total_revenue'], 2) ?></td>
                    <td>₱<?= number_format($row['fld_cost_of_goods_sold'], 2) ?></td>
                    <td><?= htmlspecialchars($row['fld_payment_method']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>