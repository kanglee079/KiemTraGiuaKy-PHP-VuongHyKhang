<?php
require_once __DIR__ . '/../config/db.class.php';

class Employee
{
    private $maNV;
    private $tenNV;
    private $phai;
    private $noiSinh;
    private $tenPhong;
    private $luong;

    // Hàm khởi tạo cho class
    public function __construct($maNV, $tenNV, $phai, $noiSinh, $tenPhong, $luong) {
        $this->maNV = $maNV;
        $this->tenNV = $tenNV;
        $this->phai = $phai;
        $this->noiSinh = $noiSinh;
        $this->tenPhong = $tenPhong;
        $this->luong = $luong;
    }

    // Các getter khác...
    public function getMaNV() {
        return $this->maNV;
    }

    public function getTenNV() {
        return $this->tenNV;
    }

    public function getPhai() {
        return $this->phai;
    }

    public function getNoiSinh() {
        return $this->noiSinh;
    }

    public function getTenPhong() {
        return $this->tenPhong;
    }

    public function getLuong() {
        return $this->luong;
    }

    // Hàm lấy ảnh giới tính
    public function getGenderImage() {
        return $this->phai === 'NU' ? 'Woman.jpg' : 'Man.jpg';
    }

    // Hàm lấy danh sách nhân viên với phân trang
    public static function getList($skip, $limit) {
        $db = new Db();
        $sql = "SELECT NV.Ma_NV, NV.Ten_NV, NV.Phai, NV.Noi_Sinh, PB.Ten_Phong, NV.Luong FROM NHANVIEN NV INNER JOIN PHONGBAN PB ON NV.Ma_Phong = PB.Ma_Phong LIMIT $skip, $limit";
        $result = $db->select_to_array($sql);
    
        $employees = [];
        foreach ($result as $row) {
            $employee = new Employee(
                $row['Ma_NV'],
                $row['Ten_NV'],
                $row['Phai'],
                $row['Noi_Sinh'],
                $row['Ten_Phong'],
                $row['Luong']
            );
            $employees[] = $employee;
        }
        return $employees;
    }
    

    // Hàm lấy tổng số nhân viên
    public static function countAll() {
        $db = new Db();
        $sql = "SELECT COUNT(*) as count FROM NHANVIEN";
        $result = $db->select_to_array($sql);
        return $result[0]['count'] ?? 0;
    }

    // Thêm các hàm khác nếu cần...
}

