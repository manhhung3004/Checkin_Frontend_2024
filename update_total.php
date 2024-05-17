<?php
// require 'vendor/autoload.php';

// Thiết lập kết nối đến cơ sở dữ liệu
$servername = 'localhost';
$dbname = 'DiemDanh';
$username = 'root';
$password = '';
$api_key_value = "tPmAT5Ab3j7F9";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xác minh API key
    $api_key = test_input($_POST["apikey"]);
    if ($api_key == $api_key_value) {
        // Tạo kết nối
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Truy vấn SQL để lấy tổng số user có diem_danh = 1
        $query = "SELECT COUNT(*) as total FROM `users` WHERE diem_danh = 1";
        $result = $conn->query($query);
        if ($result === false) {
            echo "Query failed: " . $conn->error;
        } else {
            $row = $result->fetch_assoc();
            // Trả về tổng số dưới dạng JSON
            echo json_encode(array("total" => $row['total']));
        }
        $conn->close();
    } else {
        echo "Invalid API key";
    }
} else {
    echo "Invalid request method";
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
