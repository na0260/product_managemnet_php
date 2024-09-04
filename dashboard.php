<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Product Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <h1>Product Dashboard</h1>
    <a href="./logout.php" class="btn btn-logout">Logout</a>
    <a href="./create_product.php" class="btn">Add New Product</a>
    <div class="table-container">
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <!-- PHP code to fetch and display products -->
            <?php
            include 'config.php';

            $result = $conn->query("SELECT * FROM products");

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_product.php?id=" . $row['id'] . "' class='btn'>Edit</a> ";
                    echo "<a href='delete_product.php?id=" . $row['id'] . "' class='btn' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' >No products found.</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</div>
</body>
</html>
