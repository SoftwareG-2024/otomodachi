<?php
try {
    $db = new SQLite3('budget.db');
} catch (Exception $e) {
    echo "エラー: " . $e->getMessage();
    $db = new SQLite3('budget.db');
    $db->exec("CREATE TABLE IF NOT EXISTS expenses (
        id INTEGER PRIMARY KEY,
        date TEXT,
        category TEXT,
        amount REAL,
        description TEXT
    )");
    echo "新しいデータベースとテーブルが作成されました";
}

$date = $_POST['date'];
$category = $_POST['category'];
$amount = $_POST['amount'];
$description = $_POST['description'];

$stmt = $db->prepare("INSERT INTO expenses (date, category, amount, description) VALUES (?, ?, ?, ?)");
if ($stmt) {
    $stmt->bindValue(1, $date, SQLITE3_TEXT);
    $stmt->bindValue(2, $category, SQLITE3_TEXT);
    $stmt->bindValue(3, $amount, SQLITE3_FLOAT);
    $stmt->bindValue(4, $description, SQLITE3_TEXT);
    $stmt->execute();
    echo "データが挿入されました";
} else {
    echo "エラー: " . $db->lastErrorMsg();
}
?>
