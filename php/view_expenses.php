<?php
$db = new SQLite3('budget.db');

$result = $db->query("SELECT * FROM expenses");

echo "<h1>家計簿データ</h1>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>日付</th><th>カテゴリー</th><th>金額</th><th>説明</th></tr>";

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['category'] . "</td>";
    echo "<td>" . $row['amount'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "</tr>";
}

echo "</table>";

echo "<a href='../index.html'>ホームへ戻る</a>";
echo "<a href='../input.html'>データを入力する</a>";
?>
