<?php
require_once "koneksi.php";

function getData($table, $select, $join = '', $where = '') {
    global $conn;

    $statement = "SELECT ".$select." FROM ".$table." ".$join." ".$where;
    $query = mysqli_query($conn, $statement);

    $datas = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($datas, $row);
    }

    return $datas;
}

?>