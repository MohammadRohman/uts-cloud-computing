<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);



// Connect to RDS database
$host = "produkdb-instance.ctcessy8wp74.ap-southeast-2.rds.amazonaws.com";
$user = "admin";
$pass = "Moris_0404";
$db   = "produkdb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query produk
$sql = "SELECT * FROM produk";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Produk Kami</h1>";
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row['nama'] . "</h2>";
        echo "<p>Harga: Rp" . number_format($row['harga'], 0, ',', '.') . "</p>";
        echo "<img src='https://my-uts-bucket.s3.amazonaws.com/" . $row['gambar'] . "' width='200' />";
        echo "</div><br>";
    }
} else {
    echo "Tidak ada produk.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <header class="bg-blue-600 text-white p-4 text-center">
        <h1 class="text-2xl font-semibold">Product List</h1>
    </header>

    <main class="p-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Available Products</h2>
            
            <?php if ($result->num_rows > 0): ?>
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">Product Name</th>
                            <th class="py-2 px-4 border-b text-left">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['price']); ?> USD</td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center py-4">No products found.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="bg-blue-600 text-white p-4 text-center">
        <p>&copy; <?php echo date("Y"); ?> My Company</p>
    </footer>

    <?php $conn->close(); ?>
</body>
</html>