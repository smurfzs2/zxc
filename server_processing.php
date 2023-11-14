<?php
require_once('./../connection.php');
 
$query = $db->query("SELECT * FROM `tbl_jeramay` INNER JOIN `hr_department` ON tbl_jeramay.departmentId=hr_department.departmentId");
$totalRecords = $query->fetch_row()[0];
 
$length = $_GET['length'];
$start = $_GET['start'];
 
$sql = "SELECT * FROM tbl_jeramay";
 
if (isset($_GET['search']) && !empty($_GET['search']['value'])) {
    $search = $_GET['search']['value'];
    $sql .= " WHERE firstName like '%$search%' OR lastName like '%$search%'";
}
 
$sql .= " LIMIT $start, $length";
 
$query = $db->query($sql);
$result = [];

if($result = $mysqli->query($query)){
while ($row = $query->fetch_assoc()) {
    $result[] = [
        $row['firstName'],
        $row['lastName'],
        $row['birthday'],
        $row['address'],
        $row['gender'],
        $row['departmentId'],
    ];
}
}
 
echo json_encode([
    'draw' => $_GET['draw'],
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $totalRecords,
    'data' => $result,
]);