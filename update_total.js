// Function để update status và hiển thị tổng số user có diem_danh = 1
function updateStatus() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var statusData = JSON.parse(this.responseText);
            // Hiển thị tổng số user có diem_danh = 1
            displayTotalCount(statusData.total);
        }
    };
    xmlhttp.open("POST", "update_total.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("apikey=tPmAT5Ab3j7F9");
}

// Function để hiển thị tổng số user có diem_danh = 1
function displayTotalCount(total) {
    document.getElementById("totalCount").innerText = total;
}

// Gọi hàm updateStatus() sau mỗi khoảng thời gian nhất định (ví dụ: mỗi 2.5 giây)
setInterval(updateStatus, 2500); // Cập nhật mỗi 2.5 giây
