
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
    $db = new SQLite3('../data/budget.db');

    $result = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='expenses'");

    if ($result->fetchArray()) {
        echo "テーブル 'expenses' が存在します";
    } else {
        echo "テーブル 'expenses' が存在しません";
    }
    ?>

    <div class='button-group'>
        <button onclick="window.location.href='../index.html';" class="button">Back</button>
    </div>
</body>
</html>