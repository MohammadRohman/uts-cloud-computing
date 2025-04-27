<?php
// Database connection
$servername = "myuts-db.ctcessy8wp74.ap-southeast-2.rds.amazonaws.com";
$username = "admin";  // replace with your username
$password = "Moris_0404";  // replace with your RDS password
$dbname = "myuts-db";  // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch product details (example)
$sql = "SELECT product_name, price, image_name FROM products WHERE product_id = 1"; // Example product
$result = $conn->query($sql);
$product = $result->fetch_assoc();

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
</head>
<body>
    <h1>Product: <?php echo $product['product_name']; ?></h1>
    <img src="https://your-bucket-name.s3.amazonaws.com/<?php echo $product['image_name']; ?>" alt="Product Image">
    <p>Price: $<?php echo $product['price']; ?></p>
</body>
</html>
