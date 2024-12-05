<?php
$servername = "localhost"; 
$username = "root";       
$password = "";            
$dbname = "portal";        

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$order_type = $_POST['order_type'] ?? '';
$language = $_POST['language'] ?? '';
$delivery_method = $_POST['delivery_method'] ?? '';

if (!empty($order_type) && !empty($language) && !empty($delivery_method)) {  
    $sql = "INSERT INTO orders (type, language, delivery_method) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $order_type, $language, $delivery_method);
        if ($stmt->execute()) {
            header('Location: success_page.html');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Please fill in all fields.";
}
$conn->close();
?>

