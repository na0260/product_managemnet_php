<?php
// edit_product.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, description=? WHERE id=?");
    $stmt->bind_param("sdsi", $name, $price, $description, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    include 'config.php';

    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Display form with product's current data
    } else {
        echo "Product not found.";
    }

    $stmt->close();
    $conn->close();
}
