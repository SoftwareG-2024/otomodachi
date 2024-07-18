<?php
$db = new SQLite3('budget.db');

$date = $_POST['date'];
$category = $_POST['category'];
$amount = $_POST['amount'];
$description = $_POST['description'];

$stmt = $db->prepare("INSERT INTO expenses (date, category, amount, description) VALUES (?, ?, ?, ?)");
$stmt->bindValue(1, $date, SQLITE3_TEXT);
$stmt->bindValue(2, $category, SQLITE3_TEXT);
$stmt->bindValue(3, $amount, SQLITE3_FLOAT);
$stmt->bindValue(4, $description, SQLITE3_TEXT);
$stmt->execute();

$result = $db->query("SELECT * FROM expenses");

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "日付: " . $row['date'] . " - カテゴリー: " . $row['category'] . " - 金額: " . $row['amount'] . " - 説明: " . $row['description'] . "<br>";
}
?>
