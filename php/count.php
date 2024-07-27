<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>データベースの確認</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
</head>
<body>
    <h1>家計簿データ</h1>

    <?php
    try {
        $db = new SQLite3('../data/budget.db');
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
    <div class='button-group'>
        <button onclick="window.location.href='../index.html';" class="button">Back</button>
    </div>
</body>
</html>
