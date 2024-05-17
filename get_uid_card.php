<?php
// require 'vendor/autoload.php';

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
        $id_card = $conn->real_escape_string($id_card);
        $query = "SELECT * FROM `check_card` WHERE uid_card='$id_card'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo "double carddddd";
        } else {
            $insert_query = "INSERT INTO `check_card` (`uid_card`) VALUES ('$id_card')";
            $update_result = $conn->query($insert_query);
            echo "Thêm thẻ thành công";
        }
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
