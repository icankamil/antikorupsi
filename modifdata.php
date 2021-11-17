<?php
require "koneksi.php";
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


$responden = getData("responden","idResponden");
$hasil = [];
foreach ($responden as $key => $data1) {
	$responden[$key]['hasil'] = getData("hasil","*","","WHERE idResponden = '".$data1['idResponden']."'");
}

mysqli_query($conn, "DELETE FROM hasil");

foreach ($responden as $res) {
	foreach ($res['hasil'] as $key => $hasil) {
		$sql = "INSERT INTO hasil VALUES ('". $hasil['idSession'] ."', '". $hasil['nilaiPertanyaan'] ."', '". $hasil['dateCreate'] ."', '". $hasil['idResponden'] ."', '". ($key+=1) ."'".")";
		mysqli_query($conn, $sql);
	}
}
//print_r(getData("hasil","*","","WHERE idResponden = 'resp6076464ac5391'"));
print_r($sql);
?>