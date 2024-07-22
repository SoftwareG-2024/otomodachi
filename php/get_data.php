<?php
$db = new PDO('sqlite:../data/statistics.db');

$result = $db->query('SELECT * FROM stats');

$data = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

echo json_encode($data);
?>
