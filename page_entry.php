<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ入力</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/data_entry.css">
</head>

<body>
    <h1>家計簿アプリ</h1>
    <form id="expense-form" method="post" action="php/data_entry.php">
        <label for="date">日付:</label>
        <input type="date" id="date" name="date" value="<?php echo date('Y-m-j');?>" required><br>
        <select id="item" name="item" class="input">
            <option value="0">支出</option>
            <option value="1">収入</option>
        </select><br>
        <label for="category">カテゴリー:</label>
        <input type="text" id="category" name="category" required><br>
        <label for="amount">金額:</label>
        <input type="number" min="1" max="10000000" id="amount" name="amount" required><br>
        <label for="description">説明:</label>
        <input type="text" id="description" name="description"><br>
        <button type="submit">追加</button>
    </form>

    <div id="expenses"></div>
    <!-- <a href="page_display.php">データを表示</a> -->
    <script src="js/script.js"></script>

    <button onclick="window.location.href='index.html';" class="button">ホームへ戻る</button>
    <button onclick="window.location.href='page_display.php';" class="button">データを見る</button>
</body>

</html>