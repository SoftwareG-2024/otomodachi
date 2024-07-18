<?php
$db = new SQLite3('budget.db');

$db->exec("CREATE TABLE IF NOT EXISTS expenses (
    id INTEGER PRIMARY KEY,
    date TEXT,
    category TEXT,
    amount REAL,
    description TEXT
)");

echo "テーブルが作成されました";
?>
