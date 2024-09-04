<?php
// dashboard.php
include 'config.php';

$result = $conn->query("SELECT * FROM products");

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Price</th><th>Description</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>";
        echo "<a href='edit_product.php?id=" . $row['id'] . "'>Edit</a> | ";
        echo "<a href='delete_product.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}

$conn->close();
