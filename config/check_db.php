<?php
require_once 'db.class.php';

$db = new Db();
if($db->checkConnection()) {
    echo "Kết nối CSDL thành công!";
} else {
    echo "Kết nối CSDL thất bại!";
}

