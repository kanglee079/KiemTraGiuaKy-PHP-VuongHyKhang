<?php
class Db
{
    protected static $connection;

    public function connect() {
        if (!isset(self::$connection)) {
            // Đọc cấu hình từ file config.ini
            $config = parse_ini_file("config.ini"); 
            self::$connection = new mysqli($config["host"], $config["username"], $config["password"], $config["databasename"]);
        }

        // Kiểm tra kết nối thành công hay không
        if (self::$connection === false) {
            // Xử lý lỗi kết nối tại đây
            return false;
        }
        return self::$connection;
    }

    public function checkConnection() {
        $connection = $this->connect();
        return $connection !== false;
    }

    public function query_execute($queryString)
    {
        $connection = $this->connect();
        if ($connection === false) {
            return false;
        }

        $result = $connection->query($queryString);
        if ($result === false) {
        }
        return $result;
    }

    public function select_to_array($queryString)
    {
        $rows = [];
        $result = $this->query_execute($queryString);
        if ($result === false) {
            return false;
        }

        while ($item = $result->fetch_assoc()) { 
            $rows[] = $item;
        }
        return $rows;
    }

    public function escape_string($value) {
        $connection = $this->connect();
        return $connection->real_escape_string($value);
    }

}
