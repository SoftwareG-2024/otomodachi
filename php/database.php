<?php
try {
    $db = new SQLite3('budget.db');
    $db->exec("CREATE TABLE IF NOT EXISTS expenses (
        id INTEGER PRIMARY KEY,
        date TEXT,
        item INTEGER,
        category TEXT,
        amount INTEGER,
        description TEXT
    )");
    echo "データベースとテーブルが作成されました";
} catch (Exception $e) {
    echo "エラー: " . $e->getMessage();
}
echo "<a href='../index.html'>back</a>";
?>
