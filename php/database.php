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
    ?>
    
    <div class='button-group'>
        <button onclick="window.location.href='../index.html';" class="button">Back</button>
    </div>
</body>
</html>
