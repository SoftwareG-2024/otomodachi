<?php
try {
    $db = new SQLite3('budget.db');
    $db->exec("CREATE TABLE IF NOT EXISTS expenses (
        id INTEGER PRIMARY KEY,
        date TEXT,
        category TEXT,
        amount REAL,
        description TEXT
    )");
    echo "データベースとテーブルが作成されました";
} catch (Exception $e) {
    echo "エラー: " . $e->getMessage();
}
?>
