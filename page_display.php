<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>データ表示</title>
    <link rel="stylesheet" type="text/css" href="css/data_display.css">
</head>
<body>
    <h1>家計簿データ</h1>

    <?php
    $db = new SQLite3('data/budget.db');

    $result = $db->query("SELECT * FROM expenses ORDER BY date DESC");

    echo "<table>";
    echo "<tr><th>ID</th><th>日付</th><th>収支</th><th>カテゴリー</th><th>金額</th><th>説明</th></tr>";

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td class='id'>" . $row['id'] . "</td>";
        echo "<td class='date'>" . $row['date'] . "</td>";
        if ($row['item'] == 1) {
            echo "<td class='income item'>" . "収入" . "</td>";
        } else if ($row['item'] == 0) {
            echo "<td class='expense item'>" . "支出" . "</td>";
        } else {
            echo "<td class='item'>" . "入力エラー" . "</td>";
        }
        echo "<td class='category'>" . $row['category'] . "</td>";
        echo "<td class='amount'>" . number_format($row['amount']) . " 円</td>";
        echo "<td class='description'>" . $row['description'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>

    <div class='link'>
        <a href='page_entry.php'>データを入力する</a>
        <a href='index.html'>ホームへ戻る</a>
    </div>
</body>
</html>
