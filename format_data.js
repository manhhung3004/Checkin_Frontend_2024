// Model để biến đổi dữ liệu
class SeatStatus {
    constructor(data) {
        this.id = data.id;
        this.uidCard = data.uid_card;
        this.hoTen = data.ho_ten;
        this.mssv = data.mssv;
        this.chiDoan = data.chi_doan;
        this.soGhe = data.so_ghe;
        this.chucVu = data.chuc_vu;
        this.diemDanh = data.diem_danh;
        this.ghiChu = data.ghi_chu;
        this.thoiGianDen = new Date(data.thoi_gian_den);
    }

    formatThoiGianDen() {
        // Format thời gian đến thành chuỗi dễ đọc
        const options = {
            year: "numeric",
            month: "numeric",
            day: "numeric",
            hour: "numeric",
            minute: "numeric",
            second: "numeric",
        };
        return this.thoiGianDen.toLocaleDateString("vi-VN", options);
    }
}

// Function để update status và hiển thị dữ liệu đã được format
function updateStatus() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var statusData = JSON.parse(this.responseText);
            // Biến đổi dữ liệu thành các object SeatStatus
            var seatStatusList = statusData.map((data) => new SeatStatus(data));
            // Hiển thị dữ liệu đã được format
            displayFormattedData(seatStatusList);
            displayFormattedData_Detail(seatStatusList);
        }
    };
    xmlhttp.open("POST", "update_status.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("apikey=tPmAT5Ab3j7F9");
}

// Function để hiển thị dữ liệu đã được format
function displayFormattedData(seatStatusList) {
    var formattedStatus = seatStatusList.map((seatStatus) => {
        return (
            `ID: ${seatStatus.id}, UID Card: ${seatStatus.uidCard}, Họ và Tên: ${seatStatus.hoTen}, MSSV: ${seatStatus.mssv}, ` +
            `Chi đoàn: ${seatStatus.chiDoan}, Số ghế: ${seatStatus.soGhe}, Chức vụ: ${seatStatus.chucVu}, ` +
            `Điểm danh: ${seatStatus.diemDanh}, Ghi chú: ${seatStatus.ghiChu
            }, Thời gian đến: ${seatStatus.formatThoiGianDen()}`
        );
    });
    //  document.getElementById("status").innerHTML = formattedStatus.join("<br>");
}

// Function để hiển thị dữ liệu đã được format
function displayFormattedData_Detail(seatStatusList) {
    seatStatusList.forEach((seatStatus) => {
        // Lấy giá trị của từng thuộc tính từ seatStatus
        var id = seatStatus.id;
        var uidCard = seatStatus.uidCard;
        var hoTen = seatStatus.hoTen;
        var mssv = seatStatus.mssv;
        var chiDoan = seatStatus.chiDoan;
        var soGhe = seatStatus.soGhe;
        var chucVu = seatStatus.chucVu;
        // var diemDanh = seatStatus.diemDanh;
        var ghiChu = seatStatus.ghiChu;
        var thoiGianDen = seatStatus.formatThoiGianDen();

        // Hiển thị từng giá trị lên HTML
        // document.getElementById("id").innerText = id;
        document.getElementById("hoTen").innerText = hoTen;
        document.getElementById("mssv").innerText = mssv;
        document.getElementById("chiDoan").innerText = chiDoan;
        document.getElementById("soGhe").innerText = soGhe;
        document.getElementById("chucVu").innerText = chucVu;
        // document.getElementById("diemDanh").innerText = diemDanh;
        document.getElementById("ghiChu").innerText = ghiChu;
        document.getElementById("thoiGianDen").innerText = thoiGianDen;
    });
}

// Gọi hàm updateStatus() sau mỗi khoảng thời gian nhất định (ví dụ: mỗi 5 giây)
setInterval(updateStatus, 1000); // Cập nhật mỗi 2.5 giây
