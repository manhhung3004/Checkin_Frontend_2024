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
        // Truy vấn SQL để lấy các hàng có diem_danh = 1 và thoi_gian_den gần với hiện tại nhất
        $query = "SELECT * FROM `users` WHERE diem_danh = 1 ORDER BY thoi_gian_den DESC LIMIT 1";
        $result = $conn->query($query);
        if ($result === false) {
            echo "Query failed: " . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                // Có các hàng có diem_danh = 1
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                // Trả về dữ liệu dưới dạng JSON
                echo json_encode($data);
            } else {
                // Không có hàng nào có diem_danh = 1
                echo "No records found with diem_danh = 1";
            }
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
