<?php
try {
    $db = new SQLite3('.../data/budget.db');
} catch (Exception $e) {
    echo "エラー: " . $e->getMessage();
}

$results = $db->query("
    SELECT STRFTIME('%Y-%m', date) AS month, COUNT(*) AS count
    FROM expenses
    GROUP BY STRFTIME('%Y-%m', date)
");

while ($row = $results->fetchArray()) {
    echo "月: " . $row['month'] . ", 件数: " . $row['count'] . "<br>";
}
?>
