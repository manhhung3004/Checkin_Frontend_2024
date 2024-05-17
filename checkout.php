<?php
// setup connect to esp8266
$servername = 'localhost';
$dbname = 'DiemDanh';
$username = 'root';
$password = '';
$api_key_value = "tPmAT5Ab3j7F9";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify API key
    $api_key = test_input($_POST["apikey"]);
    $id_card = test_input($_POST["idcard"]);
    if ($api_key == $api_key_value) {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Sanitize input and perform query
        $id_card = $conn->real_escape_string($id_card);
        $query = "SELECT * FROM `users` WHERE uid_card='$id_card'";
        $result = $conn->query($query);
        if ($result === false) {
            echo "Query failed: " . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                // Thẻ đã được tìm thấy trong cơ sở dữ liệu
                $row = $result->fetch_assoc();
                $diem_danh_status = $row["diem_danh"];
                if ($diem_danh_status == 1) {
                    // Cập nhật giá trị 'diem_danh' thành 1 và 'thoi_gian_den' thành thời gian hiện tại
                    $update_query = "UPDATE `users` SET `diem_danh` = '0',`ghi_chu` = 'Đã ra', `thoi_gian_den` = NOW() WHERE `uid_card`='$id_card'";
                    $update_result = $conn->query($update_query);
                    if ($update_result === true) {
                        echo "Check out thành công";
                    } else {
                        echo "Check out không thành công: \n" . $conn->error;
                    }
                } else {
                    // Thẻ chưa được điểm danh trước đó
                    echo "No Data \n";
                }
            } else {
                // Thẻ không được tìm thấy trong cơ sở dữ liệu
                $data = "-1";
                // Hiển thị dữ liệu trực tiếp trên HTML
                echo "$data: Thẻ không có trong database" . $conn->error;
                exit();
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