<?php
try {
    $db = new SQLite3('../data/budget.db');
} catch (Exception $e) {
    echo "エラー: " . $e->getMessage();
}

$db->exec("CREATE TABLE IF NOT EXISTS expenses (
    id INTEGER PRIMARY KEY,
    date TEXT,
    item INTEGER,
    category TEXT,
    amount REAL,
    description TEXT
)");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $item = $_POST['item'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    $stmt = $db->prepare("INSERT INTO expenses (date, item, category, amount, description) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bindValue(1, $date, SQLITE3_TEXT);
        $stmt->bindValue(2, $item, SQLITE3_INTEGER);
        $stmt->bindValue(3, $category, SQLITE3_TEXT);
        $stmt->bindValue(4, $amount, SQLITE3_FLOAT);
        $stmt->bindValue(5, $description, SQLITE3_TEXT);
        $stmt->execute();
        echo "データが挿入されました";
    } else {
        echo "エラー: " . $db->lastErrorMsg();
    }
}
?>
