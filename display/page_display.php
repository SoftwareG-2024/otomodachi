<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>データ表示</title>
    <link rel="stylesheet" type="text/css" href="../css/data_display.css">
</head>
<body>
    <h1>家計簿データ</h1>
    <!-- ユーザーからの入力を受け取るフォームを追加します -->
    <form action="" method="post">
        <label for="year">年:</label>
        <input type="number" id="year" name="year" min="2000" max="2099" step="1" value="<?php echo date('Y'); ?>" required />
        <label for="month">月:</label>
        <input type="number" id="month" name="month" min="1" max="12" step="1" value="<?php echo date('m'); ?>" required />
        <input type="submit" value="表示" />
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // statistics/test.php を実行
        $output = null;
        $retval = null;
        $command = 'display.exe 2>&1';
        $output = shell_exec($command);
        
        if (empty($output)) {
            echo "成功しました";
        } else {
            echo "Returned with output:\n";
            echo "<pre>";
            echo htmlspecialchars($output);
            echo "</pre>";
        }
    }
    ?>

    <?php
    // データベースに接続します
    $db = new SQLite3('../data/budget.db');

    // フォームから送信された年と月を取得します
    $year = isset($_POST['year']) ? $_POST['year'] : date('Y');
    $month = isset($_POST['month']) ? str_pad($_POST['month'], 2, '0', STR_PAD_LEFT) : date('m');

    // SQLクエリを更新して、指定した年と月のデータだけを取得します
    $result = $db->query("SELECT * FROM expenses WHERE strftime('%Y', date) = '$year' AND strftime('%m', date) = '$month' ORDER BY date DESC");

    // データの数を数えます
    $numRows = 0;
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $numRows++;
    }

    // データが0の場合はメッセージを表示します
    if ($numRows == 0) {
        echo "<p>指定した年月のデータはありません。</p>";
    } else {
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
    }
    ?>

    <div class='link'>
        <a href='../page_entry.php'>データを入力する</a>
        <a href='../index.html'>ホームへ戻る</a>
    </div>
</body>
</html>
