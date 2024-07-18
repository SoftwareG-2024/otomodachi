<?php
$db = new SQLite3('budget.db');

$result = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='expenses'");

if ($result->fetchArray()) {
    echo "テーブル 'expenses' が存在します";
} else {
    echo "テーブル 'expenses' が存在しません";
}
?>
