<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>データ表示</title>
    <link rel="stylesheet" type="text/css" href="../css/data_display.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    $db = new SQLite3('../data/budget.db');

    $year = isset($_POST['year']) ? $_POST['year'] : date('Y');
    $month = isset($_POST['month']) ? str_pad($_POST['month'], 2, '0', STR_PAD_LEFT) : date('m');

    $result = $db->query("SELECT * FROM expenses WHERE strftime('%Y', date) = '$year' AND strftime('%m', date) = '$month' ORDER BY date DESC");

    $numRows = 0;
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $numRows++;
    }

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

    <div class="button-group">
        <button id="loadData" class="button">データを読み込む</button>
    </div>

    <canvas id="myChart"></canvas>
    <script>
        fetch('../php/get_data.php')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(row => row.month),
                        datasets: [{
                            label: 'Total',
                            data: data.map(row => row.total),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }, {
                            label: 'Income',
                            data: data.map(row => row.income),
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../js/graph_display.js"></script>

    <div class='link'>
        <a href='../page_entry.php'>データを入力する</a>
        <a href='../index.html'>ホームへ戻る</a>
    </div>
</body>
</html>
